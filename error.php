<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");

	$response_codes = array(
		400 => "Hibás kérés",
		401 => "Bejelentkezés szükséges",
		403 => "Hozzáférés megtagadva",
		404 => "Az oldal nem található",
		500 => "Hiba történt a szerveren"
	);

	$ctx = array(
		"code" => http_response_code(),
		"message" => $response_codes[http_response_code()],
		"info" => ""
	);

	$template = new Template($_SERVER['DOCUMENT_ROOT']."/templates/error.html", $ctx);
	$template->render();
?>
