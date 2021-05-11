<?php

	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/dbhandler.php");

	session_start();

	if($_GET["id"] === "") {
		http_response_code(404);
		include("error.php");
		exit;
	}

	$dbhandler = new DBHandler();
	$order = $dbhandler->get_order($_GET["id"]);

	if(!isset($_SESSION["email"]) || $order["details"]["email"] !== $_SESSION["email"]) {
		http_response_code(403);
		include("error.php");
		exit;
	}

	$context = $order["details"];
	unset($context["cart"]);

	$context["date"] = str_replace("-", ". ", $context["date"]).".";
	$context["rows"] = "";
	$context["total"] = 0;

	foreach($order["items"] as $item) {
		$context["rows"] .= "
			<tr>
				<td>".$item["amount"]." db</td>
				<td>".$item["displayname"]."</td>
				<td>".number_format($item["price"], 0, ",", " ")." Ft</td>
				<td>".number_format($item["subtotal"], 0, ",", " ")." Ft</td>
			</tr>
		";
		$context["total"] += $item["subtotal"];
	}

	$context["total"] = number_format($context["total"], 0, ",", " ")." Ft";

	$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/invoice.html", $context);
	$template->render();
?>
