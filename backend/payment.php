<?php
require_once __DIR__ . '/lib/Stripe.php';
require_once __DIR__ . '/config.loader.php';
require_once __DIR__ . '/secure.functions.php';
require_once __DIR__ . '/stripe.cusid.functions.php';

Stripe::setApiKey($config['stripe_sk']);

if (isset($_POST['token'])) {
	$token = $_POST['token'];
	$amount = $_POST['amount'];
	$email = $_POST['email'];

	// Create the charge on Stripe's servers - this will charge the user's card
	try {

		$stripecusid = customerHasStripeAccont($email);
		$customer = null;

		//check if the customer has stripe account with our db
		if ($stripecusid === null) {
			$customer = Stripe_Customer::create(array(
				// "source" => $token ,
				"email" => $email,
				"source" => $token,
			));
			$stripecusid = $customer->id;
		} else {

			$customerdeltedatStripe = false;
			try
			{
				// our db has customer account check same with stripe account
				$customer = Stripe_Customer::retrieve($stripecusid);
				$customerdeltedatStripe = $customer->deleted;
				$stripecusid = null;
			} catch (Stripe_InvalidRequestError $e) {
				$customerdeltedatStripe = true;
			}
			if ($customerdeltedatStripe) {
				// our db has account but stripe dont have account reference
				$customer = Stripe_Customer::create(array(
					"email" => $email,
					"source" => $token,
				));
				$stripecusid = $customer->id;
				//delte all ol refences to the customer
				deleteStripeAccountReferences($email);
			}
		}

		addStripeCustomerToDB($email, $customer->id);

		// $stripecusid is only set when a new cousmore is added
		if ($stripecusid == null) {
			//add a source for that customer adds duplicate cards in th stripe db 
            // TODO: try to check exitsing sources if not add one
			$cardid = $customer->sources->create(array("source" => $token));
			//set default source
			$customer->default_source = $cardid->id;
			$customer->save();
		}

		$charge = Stripe_Charge::create(array(
			'amount' => $amount,
			'currency' => 'usd',
			'customer' => $customer->id,
			'description' => 'elementary OS download',
			'receipt_email' => $email,
		));

		// var_dump($charge['paid']);
		if ($charge['paid'] == true) {
			echo 'PAID';
			// Set an insecure, HTTP only cookie for 10 years in the future.
			setcookie('has_paid_' . $config['os-codename'] . '', $amount, time() + 315360000, '/', '.elementary.io', 0, 1);

			//securing email in cookies for privacy protection
			setcookie('paid_' . $config['os-codename'] . '_by', encrypt($email), time() + 315360000, '/', '.elementary.io', 0, 1);
		} else {
			echo 'OK';
		}
	} catch (Exception $e) {
		echo 'error';
	}
} else {
	echo $config['stripe_pk'];
}
