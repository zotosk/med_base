<?php

if(isset($_POST['submit']))
{
	//$secret = $_POST["secret"];
	$secretKey = "6LczemkUAAAAAB0oov74bAYjLyQYTx5h1FFMcABS";
	$responseKey = $_POST['g-recaptcha-response'];
	//$userIP = $_SERVER['REMOTE ADDR'];

	//Communication with google's site verification api
	$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";//remoteip=$userIP";
	$response= file_get_contents($url);

	//captcha verification success or fail 
	$response = json_decode($response, true);
	if ($response['success'] === true) 
	{
		$captchaTrue = "verification captcha success!";
	}
	else
	{
		$captchaFail = "verification captcha failed.Try again";
	}
};
//end of verification

?>