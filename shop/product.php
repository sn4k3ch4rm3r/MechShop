<?php
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/dbhandler.php");
	
	$dbhandler = new DBHandler();
	$details = $dbhandler->product_details($_GET["slug"])[0];

	$bt = $details["bluetooth"] == 1 ? "Igen" : "Nem";
	$medkeys = $details["mediakeys"] == 1 ? "Igen" : "Nem";
	$size = $details["size"] == 10 ? "Numpad" : ($details["size"] == -1 ? "Egyéb" : $details["size"]."%");

	$context = [
		"name" => $details["displayname"],
		"slug" => $details["slug"],
		"price" => number_format($details["price"], 0, ",", " "),
		"description" => preg_replace("~(<br>){2,}~", "<br><br>", str_replace("\n", "<br>", $details["description"])),
		"usb" => $details["usb"],
		"bluetooth" => $bt,
		"backlight" => $details["backlight"],
		"mediakeys" => $medkeys,
		"size" => $size
	];

	$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/product.html", $context);
	$template->render();
	
?>
