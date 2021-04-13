<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/helpers/template.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/helpers/dbhandler.php');

	$template = new Template($_SERVER['DOCUMENT_ROOT'].'/templates/base.html');
	$template->set('imports', '
		<link rel="stylesheet" href="/stylesheets/product.css">
	');
	
	$product_template = new Template($_SERVER['DOCUMENT_ROOT'].'/templates/product.html');
	$dbhandler = new DBHandler();
	$details = $dbhandler->product_details($_GET['slug'])[0];

	$template->set('title', $details['displayname']);
	$product_template->set('name', $details['displayname']);
	$product_template->set('slug', $details['slug']);
	$product_template->set('price', number_format($details['price'], 0, ",", " "));
	$product_template->set('description', preg_replace("~(<br>){2,}~", "<br><br>", str_replace("\n", "<br>", $details['description'])));

	$template->set('body', $product_template->toString());

	$template->render();
	

?>