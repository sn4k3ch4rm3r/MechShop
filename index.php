<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		print_r($_POST);

		session_start();

		$_SESSION['name'] = $_POST["name"];
		$_SESSION['email'] = $_POST["email"];
		$_SESSION['phone'] = $_POST["phone"];
		$_SESSION['postcode'] = $_POST["postcode"];
		$_SESSION['city'] = $_POST["city"];
		$_SESSION['address'] = $_POST["address"];

		header("Location: /shop.php");
	}
?>
<!DOCTYPE html>
<html lang="hu">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="/stylesheets/outlined-textfield.css">
		<link rel="stylesheet" href="/stylesheets/button.css">
		<link rel="stylesheet" href="/stylesheets/ripple.css">
		<link rel="stylesheet" href="/stylesheets/style.css">
		<link rel="stylesheet" href="/stylesheets/landing.css">

		<script src="/javascript/main.js"></script>
		<script src="/javascript/landing.js"></script>
		
		<title>MechShop</title>
	</head>
	<body>
		<div class="container">
			<h1>MechShop</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer dictum sem vel sodales pharetra. Nunc sit amet lobortis diam, vitae pretium dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a ligula ut sapien aliquet ultricies. Mauris scelerisque sem in arcu pretium pulvinar. Sed aliquet augue orci, vitae aliquam tellus pellentesque id.</p>
			<form method="POST" id="form">
				<h2>Bejelentkezés</h2>
				<div class="material-outlined-textfield">
					<input type="text" name="name" id="name" placeholder="Teljes neve" required>
					<label for="name">
						Név
					</label>
				</div>
				<div class="material-outlined-textfield">
					<input type="email" name="email" id="email" placeholder="example@gmail.com" required pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$">
					<label for="email">
						Email cím
					</label>
				</div>
				<div class="material-outlined-textfield">
					<input type="tel" name="phone" id="phone" placeholder="+36 12 345 6789" required pattern="^(\+36|06)[\s-]?[0-9]{1,2}[\s-]?[0-9]{3}[\s-]?[0-9]{3,4}$">
					<label for="phone">
						Telefonszám
					</label>
				</div>
				<div class="city-wrapper">
					<div class="material-outlined-textfield postcode">
						<input type="number" name="postcode" id="postcode" placeholder="2600" required min="1000" max="9999">
						<label for="postcode">
							Irányítószám
						</label>
					</div>
					<div class="material-outlined-textfield city">
						<input type="text" name="city" id="city" placeholder="Vác" required>
						<label for="city">
							Település
						</label>
					</div>
				</div>
				<div class="material-outlined-textfield">
					<input type="text" name="address" id="address" placeholder=" " required>
					<label for="address">
						Lakcím
					</label>
				</div>
				<button type="submit" class="material-button" onclick="checkForm()">Belépés</button>
			</form>
		</div>
		<script src="/javascript/ripple.js"></script>
	</body>
</html>