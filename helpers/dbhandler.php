<?php
	class DBHandler {
		private $conn;
		function __construct() {
			$this->conn = new mysqli("localhost", "root", "", "mechshop");
		}

		function get_products($filter = array()) {
			$sql_filter = "";

			if(array_key_exists("q", $filter)) {
				$sql_filter .= "displayname LIKE '%".$this->conn->real_escape_string($filter["q"])."%'";
			}

			if(array_key_exists("size", $filter)) {
				if($sql_filter !== "") $sql_filter .= " AND ";
				$size_filter = "";
				foreach(explode(",", $filter["size"]) as $size) {
					if($size_filter !== "") $size_filter .= " OR ";
					$size_filter .= "size = ".$this->conn->real_escape_string($size);
				}
				$sql_filter .= "(".$size_filter.")";
			}

			if(array_key_exists("extras", $filter)) {
				if($sql_filter !== "") $sql_filter .= " AND ";
				$extras_filter = "";
				foreach(explode(",", $filter["extras"]) as $extra) {
					if($extras_filter !== "") $extras_filter .= " AND ";
					if($extra === "backlit") $extras_filter .= "NOT backlight = 'n/a'";
					else $extras_filter .= $this->conn->real_escape_string($extra)." = 1";
				}
				$sql_filter .= "(".$extras_filter.")";
			}

			if($sql_filter !== "") {
				$sql_filter = " WHERE ".$sql_filter;
			}

			return $this->result_to_array($this->conn->query("SELECT slug, displayname, price, `description` FROM products".$sql_filter));
		}

		function product_details($slug) {
			return $this->result_to_array($this->conn->query("SELECT * FROM products WHERE slug='$slug'"));
		}

		function create_order($details) {
			$cart = $details["cart"];
			unset($details["cart"]);

			$details["date"] = date("Y-m-d");

			$keys = array();
			$values = array();
			foreach($details as $key => $value) {
				array_push($keys, $key);	
				array_push($values, $this->conn->real_escape_string($value));
			}
			$keys = implode("`, `", $keys);
			$values = implode("', '", $values);
			$this->conn->query("INSERT INTO `orders` (`".$keys."`) VALUES ('". $values ."')");
			echo $this->conn->error;
			$orderid = $this->conn->insert_id;
			foreach($cart as $slug => $amount) {
				$this->conn->query("INSERT INTO `orderitems` (`orderid`, `productid`, `amount`) VALUES (".$orderid.", '".$slug."', ".$amount.")");
			}
			$this->conn->close();
			return $orderid;
		}

		function get_history($email) {
			return $this->result_to_array(
				$this->conn->query("
					SELECT orders.id, date, SUM(orderitems.amount) AS count, SUM(products.price * orderitems.amount) AS total
					FROM ((orders
					INNER JOIN orderitems ON orders.id = orderitems.orderid)
					INNER JOIN products ON orderitems.productid = products.slug)
					WHERE email = '".$email."'
					GROUP BY orders.id"
				)
			);
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