<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/helpers/template.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/helpers/dbhandler.php");

	$template = new Template($_SERVER['DOCUMENT_ROOT']."/templates/base.html");
	$template->set("imports", '
		<link rel="stylesheet" href="/stylesheets/shop.css">
	');
	$template->set("title", "Vásárlás");
	$shop_template = new Template($_SERVER['DOCUMENT_ROOT']."/templates/shop.html");
	
	$cards = "";

	$dbhandler = new DBHandler();
	$products = $dbhandler->get_products();

	foreach($products as $product) {
		$card = new Template($_SERVER['DOCUMENT_ROOT']."/templates/product-card.html");
		$card->set("name", $product["displayname"]);
		$card->set("price", number_format($product['price'], 0, ",", " "));
		$card->set("description", $product["description"]);
		$card->set("slug", $product["slug"]);
		$cards .= $card->toString(); 
	}
	$shop_template->set("products", $cards);
	
	$template->set("body", $shop_template->toString());
	$template->render();
?>
