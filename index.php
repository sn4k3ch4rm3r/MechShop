<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		print_r($_POST);

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
		require_once("helpers/template.php");
		$template = new Template("templates/base.html");
		$template->set("imports", '
			<link rel="stylesheet" href="/stylesheets/landing.css">
			<script src="/javascript/landing.js"></script>
		');
		$template->set("title", "Kezdőlap");
		$template->set("body", file_get_contents("templates/landing.html"));
		$template->render();
	}
?>