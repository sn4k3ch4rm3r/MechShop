<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/sessioncheck.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/dbhandler.php");

	function getCards() {
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
		return array("cards" => $cards, "total" => number_format($total, 0, ",", " "));
	}

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(isset($_POST["action"]) && $_POST["action"] === "remove") {
			unset($_SESSION["cart"][$_POST["slug"]]);
		}
		else if(isset($_POST["amount"])) {
			$amount = $_POST["amount"];
			if($amount < 1) $amount = 1;
			else if($amount > 100) $amount = 100;
			$_SESSION["cart"][$_POST["slug"]] = $amount;
		}
		echo json_encode(getCards());
		exit;
	}
	
	$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/cart.html", getCards());
	$template->render();
?>