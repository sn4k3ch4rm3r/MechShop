<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		session_start();

		$_SESSION['name'] = $_POST["name"];
		$_SESSION['email'] = $_POST["email"];
		$_SESSION['phone'] = $_POST["phone"];
		$_SESSION['postcode'] = $_POST["postcode"];
		$_SESSION['city'] = $_POST["city"];
		$_SESSION['address'] = $_POST["address"];

		header("Location: /shop/");
	}
	else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
		$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/landing.html");
		$template->render();
	}
?>
