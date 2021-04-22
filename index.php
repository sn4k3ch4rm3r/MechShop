<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		error_reporting(E_ALL ^ E_WARNING);
		session_start();

		$_SESSION['name'] = $_POST["name"];
		$_SESSION['email'] = $_POST["email"];
		$_SESSION['phone'] = $_POST["phone"];
		$_SESSION['postcode'] = $_POST["postcode"];
		$_SESSION['city'] = $_POST["city"];
		$_SESSION['address'] = $_POST["address"];

		require_once($_SERVER['DOCUMENT_ROOT']."/helpers/sessioncheck.php");

		header("Location: /shop/");
	}
	else {
		require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
		$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/landing.html");
		$template->render();
	}
?>
