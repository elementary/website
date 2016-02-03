<?php
// commund data base related fuctions  cab be added here 

//load common cofigurations 
require_once __DIR__.'/config.loader.php';
require_once __DIR__.'/secure.functions.php';

// @description : fuction to check whether the customer has already paid and has the stripe Customer account 
// @param :  $email of a customer 
// @return returns the Stripe customer id of the customer if found else null will be returned  
function customerHasStripeAccont($email){
	global $config;
	$retId=NUll;
	//try db operation if anything goes wrong return null 
	try {
		 
		  # MS SQL Server and Sybase with PDO_DBLIB
		  $DBH = new PDO($config['stripe_cusid_dsn']);
		
		}
		catch(Exception $e) {
		    // echo $e->getMessage();
		    error_log($e->getMessage());
		}

	return $retId; 
}

// @description : fuction to add the customer's Stripe cus_ID to database 
// @param : $eamail of a customer ,customer's Stripe cus_ID $cusid of the  customer 
function addStripeCustomerToDB($email,$cusid){
	return null;
}

// tets scripts by developer
var_dump(customerHasStripeAccont('raj@olark.com'));