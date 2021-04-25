<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
	
	$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/cart.html");
	$template->render();
?>