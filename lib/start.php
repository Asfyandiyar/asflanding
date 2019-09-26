<?php
	mb_internal_encoding("UTF-8");
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	session_start();

	$message = false;
	define("SECRET", "ds9gdafvs");
	define("ADM_LOGIN", "admin");
	define("ADM_PASSWORD", "6804644eaaea009c42bba87611819199");

	define("DB_HOST", "localhost");
	define("DB_USER", "wm78765_root");
	define("DB_PASSWORD", "fie4FJG-32");
	define("DB_NAME", "wm78765_asflanding");

	define("SMS_USER", "asfyandiyarovf@mail.ru");
	define("SMS_PASSWORD", md5("JFo3093Nfgd41pnvlk2"));
	define("SMS_PHONE", "79150905111");

	define("FORMAT_DATE", "Y.m.d H:i:s");

	require_once "/home/wm78765/domains/asflanding.ru/public_html/lib/functions.php";
	require_once "/home/wm78765/domains/asflanding.ru/public_html/lib/request.php";
?>