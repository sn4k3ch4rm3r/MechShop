<?php
	require_once("helpers/template.php");

	$template = new Template("templates/base.html");
	$template->set("imports", '
		<link rel="stylesheet" href="/stylesheets/shop.css">
	');
	$template->set("title", "Vásárlás");
	// echo ;
	$shop_template = new Template("templates/shop.html");
	$shop_template->set("navbar", file_get_contents("templates/navbar.html"));
	$cards = "";
	for ($i=0; $i < 45; $i++) { 
		$card = new Template("templates/product-card.html");
		$cards .= $card->toString(); 
	}
	$shop_template->set("products", $cards);
	$template->set("body", $shop_template->toString());
	$template->render();
?>