<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/sessioncheck.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/dbhandler.php");
	
	$dbhandler = new DBHandler();

	$cards = "";
	$total = 0;
	foreach (array_keys($_SESSION["cart"]) as $item) {
		$details = $dbhandler->product_details($item)[0];
		$subtotal = $_SESSION["cart"][$item] * $details["price"];
		$total += $subtotal;
		$context = array(
			"name" => $details["displayname"],
			"slug" => $item,
			"description" => $details["description"],
			"count" => $_SESSION["cart"][$item],
			"subtotal" => number_format($subtotal, 0, ",", " "),
		);
		$card = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/cart-card.html", $context);
		$cards .= $card;
	}
	// die;
	$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/cart.html", array("cards" => $cards, "total" => number_format($total, 0, ",", " ")));
	$template->render();
?>