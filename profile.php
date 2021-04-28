<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/helpers/sessioncheck.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/dbhandler.php");

	if(isset($_GET["action"]) && $_GET["action"] === "logout") {
		session_destroy();
		header("Location: /");
		exit;
	}

	$context = $_SESSION;
	unset($context["cart"]);
	$context["letter"] = $_SESSION["fullname"][0];

	$dbhandler = new DBHandler();

	$history = $dbhandler->get_history($_SESSION["email"]);
	$cards = "";
	foreach($history as $order) {
		$order["total"] = number_format($order["total"], 0, ",", " ");
		$card = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/history-card.html", $order);
		$cards .= $card;
	}
	$context["cards"] = $cards;

	$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/profile.html", $context);
	$template->render();
?>