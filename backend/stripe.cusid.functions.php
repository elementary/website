<?php
// commund data base related fuctions  cab be added here

//load common cofigurations
require_once __DIR__ . '/config.loader.php';
require_once __DIR__ . '/secure.functions.php';

// @description : fuction to check whether the customer has already paid and has the stripe Customer account
// @param :  $email of a customer
// @return returns the Stripe customer id of the customer if found else null will be returned
function customerHasStripeAccont($email) {
	global $config;
	$retId = NUll;
	//try db operation if anything goes wrong return null
	try {

		# SQL LITE  Server and Sybase with PDO_DBLIB
		$db = new PDO($config['stripe_cusid_dsn']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		_createtableifnotexists();
		if ($stmt = $db->prepare('SELECT * FROM stripe_cusid where EMAIL=:email')) {
			$stmt->bindValue(':email', $email);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				// var_dump($row);
				$retId = $row['CUSID'];
			}
		}
	} catch (Exception $e) {
		// echo $e->getMessage();
		error_log($e->getMessage());
	}

	return $retId;
}

// @description : fuction to add the customer's Stripe cus_ID to database
// @param : $eamail of a customer ,customer's Stripe cus_ID $cusid of the  customer
function addStripeCustomerToDB($email, $cusid) {
	global $config;
	$retId = NUll;
	//try db operation if anything goes wrong return null
	try {
		# SQL LITE  Server and Sybase with PDO_DBLIB
		$db = new PDO($config['stripe_cusid_dsn']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		_createtableifnotexists();
		if ($stmt = $db->prepare("INSERT INTO stripe_cusid (CUSID, EMAIL) VALUES (:cusid,:email);")) {
			$stmt->bindValue(':email', $email);
			$stmt->bindValue(':cusid', $cusid);
			$res = $stmt->execute();
			// var_dump($res);
			if ($res) {
				$retId = $cusid;
			}
		}
	} catch (Exception $e) {
		//check if already exists in db
		if (stripos($e->getMessage(), 'UNIQUE') === false) {
			error_log($e->getMessage());
		}

		$retId = $cusid;
	}

	return $retId;
}

// @description : fuction to delete all references to the customer 
// @param :  $email of a customer
// @return null if failed else true 
function deleteStripeAccountReferences($email) {
	global $config;
	$ret = NUll;
	//try db operation if anything goes wrong return null
	try {

		# SQL LITE  Server and Sybase with PDO_DBLIB
		$db = new PDO($config['stripe_cusid_dsn']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		_createtableifnotexists();
		if ($stmt = $db->prepare('DELETE FROM stripe_cusid where EMAIL=:email')) {
			$stmt->bindValue(':email', $email);
			$res=$stmt->execute();
			$ret=$res;
		}
	} catch (Exception $e) {
		// echo $e->getMessage();
		error_log($e->getMessage());
	}
	return $ret;
}


function _createtableifnotexists() {
	global $config;
	try {
		# MS SQL Server and Sybase with PDO_DBLIB
		$db = new PDO($config['stripe_cusid_dsn']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//create table if does not exists
		$sql = 'CREATE TABLE IF NOT EXISTS stripe_cusid (
            CUSID TEXT PRIMARY KEY  NOT NULL,
            EMAIL  TEXT  NOT NULL);';
		$db->exec($sql);

	} catch (Exception $e) {
		// echo $e->getMessage();
		error_log($e->getMessage());
	}
}

// tets scripts by developer
// var_dump(customerHasStripeAccont('raj@olark.com'));
// var_dump(deleteStripeAccountReferences('raj@tmbox.com'));
// var_dump(addStripeCustomerToDB('raj@olark.com', 'cus_7plnGAMA54e3u9'));