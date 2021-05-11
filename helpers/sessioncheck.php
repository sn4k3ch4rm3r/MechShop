<?php
	if(!isset($_SESSION)) session_start();
	$required_fields = array("fullname", "email", "phone", "postcode", "city", "address");
	foreach($required_fields as $field) {
		if(!isset($_SESSION[$field]) || empty($_SESSION[$field])) {
			http_response_code(401);
			require_once($_SERVER["DOCUMENT_ROOT"]."/error.php");
			exit;
		}
	}
?>
