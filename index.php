<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$required_fields = array("name", "email", "phone", "postcode", "city", "address");
		foreach($required_fields as $field) {
			if(!isset($_POST[$field]) || empty($_POST[$field])) {
				http_response_code(400);
				require_once($_SERVER["DOCUMENT_ROOT"]."/error.php");
				exit;
			}
		}
		session_start();

		$_SESSION['name'] = $_POST["name"];
		$_SESSION['email'] = $_POST["email"];
		$_SESSION['phone'] = $_POST["phone"];
		$_SESSION['postcode'] = $_POST["postcode"];
		$_SESSION['city'] = $_POST["city"];
		$_SESSION['address'] = $_POST["address"];
		$_SESSION['cart'] = array();

		header("Location: /shop/");
	}
	else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
		session_start();
		if(isset($_SESSION["name"])){
			header("Location: /shop/");
			exit;
		}
		$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/landing.html");
		$template->render();
	}
?>
