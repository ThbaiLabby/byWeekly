<?php
session_start();
$total = 0.0;
$db = new MySQLi('localhost', 'root', '', 'shopping');

if (isset($_GET['checkout'])) {
	if ($_GET['checkout'] == 1) {
		
		echo "<p>Total Price: $_SESSION[total]</p>";
		echo '<a href="cart.php?confirm=1">Cornfirm purchase</a>';
		exit;	
	}
}

if (isset($_GET['confirm'])){
	if ($_GET['confirm'] == 1) {
		$order = '';
		foreach ($_SESSION['cart'] as $item) {
			$order .= $item;
		}
		$order .= $_SESSION['total'];
		unset($_SESSION['cart']);
		$db->query("INSERT INTO `order` (details) VALUES ('$order')");
		echo "Thank you for buying";
		exit;	
	}
}

foreach ($_SESSION['cart'] as $item) {
	$result = $db->query("SELECT * FROM product WHERE id=$item");
	if ($result) {
		$row = $result->fetch_assoc();
		echo "<p>Name: $row[name] (Price: $row[price])</p>";
		$total += $row['price'];
	}
}
$_SESSION['total'] = $total;
echo "<p>Total: $total</p>";
echo '<a href="cart.php?checkout=1">Checkout</a>';

?>