<?php
	if(!isset($_SESSION)) session_start();
	$required_fields = array("name", "email", "phone", "postcode", "city", "address");
	foreach($required_fields as $field) {
		if(!isset($_SESSION[$field]) || empty($_SESSION[$field])) {
			http_response_code(403);
			require_once($_SERVER["DOCUMENT_ROOT"]."/error.php");
			exit;
		}
	}
?>