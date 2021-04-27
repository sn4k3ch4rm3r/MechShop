<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/helpers/sessioncheck.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/dbhandler.php");

	$context = $_SESSION;
	unset($context["cart"]);
	$context["letter"] = $_SESSION["name"][0];

	$cards = "";
	for ($i=0; $i < 10; $i++) { 
		$card = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/history-card.html");
		$cards .= $card;
	}
	$context["cards"] = $cards;

	$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/profile.html", $context);
	$template->render();
?>