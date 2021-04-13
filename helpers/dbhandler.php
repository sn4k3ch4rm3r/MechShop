<?php
	class DBHandler {
		private $conn;
		function __construct() {
			$this->conn = new mysqli("localhost", "root", "", "mechshop");
		}

		function get_products() {
			return $this->result_to_array($this->conn->query("SELECT slug, displayname, price, `description` FROM products"));
		}

		function product_details($slug) {
			return $this->result_to_array($this->conn->query("SELECT * FROM products WHERE slug='$slug'"));
		}

		function result_to_array($result) {
			$array = array();
			while ($row = $result->fetch_assoc()) {
				array_push($array, $row);
			}
			return $array;
		}
	}
?>