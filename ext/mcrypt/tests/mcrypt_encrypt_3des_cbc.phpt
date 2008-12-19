--TEST--
Test mcrypt_encrypt() function : TripleDES functionality 
--XFAIL--
Bug #46834
--SKIPIF--
<?php 
if (!extension_loaded("mcrypt")) {
	print "skip - mcrypt extension not loaded"; 
}	 
?>
--FILE--
<?php
/* Prototype  : string mcrypt_encrypt(string cipher, string key, string data, string mode, string iv)
 * Description: OFB crypt/decrypt data using key key with cipher cipher starting with iv 
 * Source code: ext/mcrypt/mcrypt.c
 * Alias to functions: 
 */

echo "*** Testing mcrypt_encrypt() : TripleDES functionality ***\n";

//test CBC, ECB modes
//test encrypt decrypt
//test tripledes, aes
//test different lengths of key, iv
//test no iv being passed on CBC, ECB 
//test upto 32 bytes with unlimited strength

$cipher = MCRYPT_TRIPLEDES;
$mode = MCRYPT_MODE_CBC;
$data = b'This is the secret message which must be encrypted';

// tripledes uses keys upto 192 bits (24 bytes)
$keys = array(
   b'12345678', 
   b'12345678901234567890', 
   b'123456789012345678901234', 
   b'12345678901234567890123456'
);
// tripledes is a block cipher of 64 bits (8 bytes)
$ivs = array(
   b'1234', 
   b'12345678', 
   b'123456789'
);


$iv = b'12345678';
echo "\n--- testing different key lengths\n";
foreach ($keys as $key) {
   echo "\nkey length=".strlen($key)."\n";
   var_dump(bin2hex(mcrypt_encrypt($cipher, $key, $data, $mode, $iv)));
}

$key = b'1234567890123456';  
echo "\n--- testing different iv lengths\n";
foreach ($ivs as $iv) {
   echo "\niv length=".strlen($iv)."\n";
   var_dump(bin2hex(mcrypt_encrypt($cipher, $key, $data, $mode, $iv)));
}

?>
===DONE===
--EXPECTF--
*** Testing mcrypt_encrypt() : TripleDES functionality ***

--- testing different key lengths

key length=8
unicode(112) "082b437d039d09418e20dc9de1dafa7ed6da5c6335b78950968441da1faf40c1f886e04da8ca177b80b376811e138c1bf51cb48dae2e7939"

key length=20
unicode(112) "0627351e0f8a082bf7981ae2c700a43fd3d44b270ac67b00fded1c5796eea935be0fef2a23da0b3f5e243929e62ac957bf0bf463aa90fc4f"

key length=24
unicode(112) "b85e21072239d60c63a80e7c9ae493cb741a1cd407e52f451c5f43a0d103f55a7b62617eb2e44213c2d44462d388bc0b8f119384b12c84ac"

key length=26

Warning: mcrypt_encrypt(): Size of key is too large for this algorithm in %s on line %d
unicode(112) "b85e21072239d60c63a80e7c9ae493cb741a1cd407e52f451c5f43a0d103f55a7b62617eb2e44213c2d44462d388bc0b8f119384b12c84ac"

--- testing different iv lengths

iv length=4

Warning: mcrypt_encrypt(): The IV parameter must be as long as the blocksize in %s on line %d
unicode(112) "440a6f54601969b127aad3c217ce7583c7f7b29989693130645569301db0020b29a34a3dcd104b2d0e3ba19d6cbd8a33d352b9c27cc34ef1"

iv length=8
unicode(112) "bac347506bf092c5557c4363c301745d78f047028e2953e84fd66b30aeb6005812dadbe8baa871b83278341599b0c448ddaaa52b5a378ce5"

iv length=9

Warning: mcrypt_encrypt(): The IV parameter must be as long as the blocksize in %s on line %d
unicode(112) "440a6f54601969b127aad3c217ce7583c7f7b29989693130645569301db0020b29a34a3dcd104b2d0e3ba19d6cbd8a33d352b9c27cc34ef1"
===DONE===