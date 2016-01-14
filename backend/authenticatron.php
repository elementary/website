<?php

////	Authenticatron
// v0.7.3 - MIT Licensed - Property of eustasy
// https://github.com/eustasy/authenticatron
// http://labs.eustasy.org/authenticatron/example

// This is a short name to identify your site or service.
$Sitewide['Title'] = 'elementary.io';

// Secret Length defaults to 16.
// Code Length is set to 6.
// Both of these are set with Google Authenticator in mind.
// Any other length is your own problem.

// Where can we find PHPQRCode?
$PHPQRCode = __DIR__.'/phpqrcode_2010100721_1.1.4.php';

////	END CONFIGURATION







// A reference for Base32 valid characters.
$Base32_Chars = array(
	'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', // 8
	'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 16
	'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 24
	'Y', 'Z', '2', '3', '4', '5', '6', '7' // 32
);






////	Create a new Secret
function Authenticatron_Secret($Length = 16) {

	global $Base32_Chars;

	// Use MCRYPT if you can.
	if ( function_exists('mcrypt_create_iv') ) {
		$Random = mcrypt_create_iv($Length, MCRYPT_DEV_URANDOM);

	// Otherwise try to use OpenSSL
	} else if ( function_exists('openssl_random_pseudo_bytes') ) {
		$Random = openssl_random_pseudo_bytes($Length, $Strong);
		if ( !$Strong ) {
			// Fail if not strong.
			return false;
		}

	// Otherwise fail.
	} else {
		return false;
	}

	// For each letter of the secret, generate a random Base32 Characters.
	$Secret = '';
	for ( $i = 0; $i < $Length; $i++ ) {
		$Secret .= $Base32_Chars[ord($Random[$i]) & 31];
	}

	return $Secret;

}







////	Create an OTPAuth URL
function Authenticatron_URL($Account, $Secret, $Issuer = null) {

	global $Sitewide;

	// Override the Issuer if they want
	$Issuer = isset($Issuer) ? $Issuer : $Sitewide['Title'];

	// Strip any colons, they screw things up.
	$Issuer = str_replace (':', '', $Issuer);
	$Account = str_replace (':', '', $Account);
	// It might also be a good idea to strip special characters,
	// like ? as it might break the rest.

	// The Issuer and Account are not encoded as part of the path, but are when they are parameters.
	// This could cause issues with certain characters. Try to keep it alphanumeric.
	return 'otpauth://totp/'.$Issuer.': '.$Account.'?secret='.urlencode($Secret).'&issuer='.urlencode($Issuer);

}







////	Create a Base64 PNG QR Code
function Authenticatron_QR($URL, $Size = 4, $Margin = 0, $Level = 'M') {

	// Require the PHPQRCode Library
	global $PHPQRCode;

	// If the required functions are not loaded, fail.
	// If the file we are about to require doesn't exist or isn't readable, fail.
	if (
		!extension_loaded('gd') ||
		!function_exists('gd_info') ||
		!is_readable($PHPQRCode)
	) {
		return false;

	// Otherwise proceed with PHPQRCode
	} else {

		// We've checked the file exists, so we can require instead of include.
		// Something has gone horribly wrong if this doesn't work.
		require_once $PHPQRCode;

		// Use the object cache to capture the PNG without outputting it.
		// Kind of hacky but the best way I can find without writing a new QR Library.
		ob_start();
		QRCode::png($URL, null, constant('QR_ECLEVEL_'.$Level), $Size, $Margin);
		$QR_Base64 = base64_encode(ob_get_contents());
		ob_end_clean();

		// Return it as a Base64 PNG
		return 'data:image/png;base64,'.$QR_Base64;

	}

}







////	Decode as Base32
function Base32_Decode($Secret) {

	global $Base32_Chars;

	// If there is no secret or it is too small.
	if ( empty($Secret) || strlen($Secret) < 16 ) {
		return false;
	}

	// A reference for converting from Base32
	$Base32_Chars_Flipped = array_flip($Base32_Chars);

	// Remove padding characters (there shouldn't be any)
	$Secret = str_replace('=', '', $Secret);

	// Split into an array
	$Secret = str_split($Secret);

	// Set an empty string.
	$Secret_Decoded = '';
	$Secret_Count = count($Secret);

	// While $i is less than the length of $Secret, 8 bits at a time.
	for ($i = 0; $i < $Secret_Count; $i = $i+8) {

		$String = '';

		// If the letter is not a Base32 Character
		if (!in_array($Secret[$i], $Base32_Chars)) {
			return false;
		}

		// Create 8 letters
		for ($j = 0; $j < 8; $j++) {
			// Convert the characters to numbers, and pad them if necessary.
			$String .= str_pad(base_convert($Base32_Chars_Flipped[$Secret[$i + $j]], 10, 2), 5, '0', STR_PAD_LEFT);
			// Flipped and Secret both had an @ for suppression originally.
		}

		// Turn into an array
		$eightBits = str_split($String, 8);
		$eightBits_Count = count($eightBits);

		// Got each bit, convert the numbers to ASCII codes.
		for ($z = 0; $z < $eightBits_Count; $z++) {
			$Secret_Decoded .= ( ($Convert = chr(base_convert($eightBits[$z], 2, 10))) || ord($Convert) == 48 ) ? $Convert:'';
		}

	}

	return $Secret_Decoded;

}







////	Calculate the current code.
// This function heavily based on the BSD 2 Licensed one found within https://github.com/PHPGangsta/GoogleAuthenticator
function Authenticatron_Code($Secret, $Timestamp = false, $CodeLength = 6) {

	// Set the timestamp to something sensible.
	// You should only over-ride this if you really know why.
	if ( !$Timestamp ) {
		$Timestamp = floor(time() / 30);
	} else {
		$Timestamp = intval($Timestamp);
	}

	// Pack the Timestamp into a binary string
	// N = Unsigned long (always 32 bit, big endian byte order)
	$Timestamp_Packed = chr(0).chr(0).chr(0).chr(0).pack('N*', $Timestamp);

	// Decode (?) the Secret
	$Secret_Decoded = Base32_Decode($Secret);

	// Hash the Timestamp and Secret with HMAC using the SHA1 algorithm
	$HMAC = hash_hmac('SHA1', $Timestamp_Packed, $Secret_Decoded, true);

	// Use last nibble of result as index/offset
	$Offset = ord(substr($HMAC, -1)) & 0x0F;
	// Gives a generated number that varies.

	// Take 4 bytes of the result from the Offset
	$Part = substr($HMAC, $Offset, 4);

	// Unpack the binary value
	$Value = unpack('N', $Part);
	$Value = $Value[1];

	// Make it a 32bit signed value.
	$Value = $Value & 0x7FFFFFFF;

	// Make a Modulo
	// When the $CodeLength is 6, it is
	// equivalent to 10**6, 10^6, or 1,000,000
	$Denominator = pow(10, $CodeLength);

	// This function adds leading zeros (the third parameter) to the left-hand side (the fourth)
	// to the remainder of our unpacked hash-part divided by 10 to the power of the required code length.
	return str_pad($Value % $Denominator, $CodeLength, '0', STR_PAD_LEFT);

}







////	Create an array of all codes within an acceptable range.
//
// The output will look like this.
//
//	array(5) {
//		[-2] => string(6) "398599"
//		[-1] => string(6) "283062"
//		[0] => string(6) "809226"
//		[1] => string(6) "541727"
//		[2] => string(6) "667780"
//	}
//
// Note the indexes, which can be used to determine the time difference,
// and perhaps warn users on the outer bounds. Code generation is expensive,
// so avoid generating any you don't want to check against later.

function Authenticatron_Acceptable($Secret, $Variance = 2) {

	// Create an empty array to be returned.
	$Acceptable = array();

	// From the negative of the variance to the positive equivalent.
	for ($i = -$Variance; $i <= $Variance; $i++) {
		// Add that amount in increments of 30 seconds.
		$LoopTime = floor(time() / 30) + $i;
		// Add the code to the array.
		$Acceptable[$i] = Authenticatron_Code($Secret, $LoopTime);
	}

	// Return the list of codes.
	return $Acceptable;

}








////	Check a given Code against a Secret
function Authenticatron_Check($Code, $Secret, $Variance = false) {

	// Pass the Variance if it is set, allow to default if not.
	if ( $Variance === false ) {
		$Acceptable = Authenticatron_Acceptable($Secret);
	} else {
		$Acceptable = Authenticatron_Acceptable($Secret, $Variance);
	}

	// Return a simple boolean to avoid data-leakage or zero-equivalent code issues.
	if ( in_array($Code, $Acceptable) ) {
		return true;
	} else {
		return false;
	}

}








////	Create a Secret and QR code for a given Member
// Also, add a homepage with this and the wrapper for checking.
function Authenticatron_New($Member_Name) {
	$Return['Secret'] = Authenticatron_Secret();
	$Return['URL'] = Authenticatron_URL($Member_Name, $Return['Secret']);
	$Return['QR'] = Authenticatron_QR($Return['URL']);
	return $Return;
}
