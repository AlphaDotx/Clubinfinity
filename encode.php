<?php // base64_encode()/base64_decode() example
$string  = 'Encoding and Decoding Encrypted PHP Code';
//$encoded = base64_encode($string);
$decoded = base64_decode("WmFuZWxlMQ==");
//echo $encoded ."\n";
echo $decoded;
?>