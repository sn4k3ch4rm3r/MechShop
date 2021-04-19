<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/helpers/template.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/helpers/dbhandler.php");
	
	$cards = "";

	$dbhandler = new DBHandler();
	$products = $dbhandler->get_products($_GET);

	foreach($products as $product) {
		$card = new Template($_SERVER['DOCUMENT_ROOT']."/templates/product-card.html", [
			"name" => $product["displayname"],
			"price" => number_format($product['price'], 0, ",", " "),
			"description" => $product["description"],
			"slug" => $product["slug"],
		]);
		$cards .= strval($card); 
	}

	$template = new Template($_SERVER['DOCUMENT_ROOT']."/templates/shop.html", ["products" => $cards]);
	$template->render();
?>
