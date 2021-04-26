<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/helpers/sessioncheck.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/template.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/helpers/dbhandler.php");

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$_SESSION["cart"][$_GET["slug"]] = $_POST["amount"];
		echo "success";
		die;
	}
	
	$dbhandler = new DBHandler();
	$details = $dbhandler->product_details($_GET["slug"])[0];

	$bt = $details["bluetooth"] == 1 ? "Igen" : "Nem";
	$medkeys = $details["mediakeys"] == 1 ? "Igen" : "Nem";
	$size = $details["size"] == 10 ? "Numpad" : ($details["size"] == -1 ? "Egyéb" : $details["size"]."%");

	$path = "/images/boards/".$details['slug']."/";
	$images = '<div class="small-wrapper selected"><img src="'.$path.'main.png"/></div>';	
	$image_files = glob($_SERVER["DOCUMENT_ROOT"].$path."[0-9]*.png");
	foreach($image_files as $image) {
		$images .= '<div class="small-wrapper"><img src="'.$path.basename($image).'"/></div>';
	}



	$context = [
		"id" => $details["id"],
		"name" => $details["displayname"],
		"slug" => $details["slug"],
		"price" => number_format($details["price"], 0, ",", " "),
		"description" => preg_replace("~(<br>){2,}~", "<br><br>", str_replace("\n", "<br>", $details["description"])),
		"usb" => $details["usb"],
		"bluetooth" => $bt,
		"backlight" => $details["backlight"],
		"mediakeys" => $medkeys,
		"size" => $size,
		"images" => $images,
		"amount" => array_key_exists($details["slug"], $_SESSION["cart"]) ? $_SESSION["cart"][$details["slug"]] : 1,
	];

	$template = new Template($_SERVER["DOCUMENT_ROOT"]."/templates/product.html", $context);
	$template->render();
	
?>
