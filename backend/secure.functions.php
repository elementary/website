<?php
 // secure fuctions which  can be used through out the we site can will be added here
 // usage add include once  include_once 'secure.functions.php'; in the file and use the fuctions
 // as normally say decrypt();
 
require_once __DIR__.'/config.loader.php';

//  @description : Fuction to encrypt the any text value into cyphred texts uing RIJNDAEL 256 bit  with 32 bit salt
//  @param  : salt  plain text
//  @return : return ciphered text if no param passed it encrypts empty space value (junktext)

function encrypt($plaintext = '',$salt=NULL) {
	global $config;
	if(!$salt)
		$salt=$config['salt'];  
	//return fuction after encryption
	return $ciphertext = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($salt), $plaintext, MCRYPT_MODE_CBC, md5(md5($salt))));
}


// @description : function decrypt ciphered text uses  RIJNDAEL 256 bit  with 32 bit salt
// @param : salt ciphered text
// @return : returns plain text if no param passed it returns decprted value of space (junktext)
// 
function decrypt($ciphertext = '',$salt=NULL) {
	global $config;
	if(!$salt)
		$salt=$config['salt'];
	//return fuction after decryption
	return $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($salt), base64_decode($ciphertext), MCRYPT_MODE_CBC, md5(md5($salt))),
		"\0");
}
