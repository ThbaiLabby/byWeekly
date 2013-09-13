<?php
session_start();
require_once 'cart.class.php';
$cart = new Cart();

if (!isset($_SESSION['cart'])) {
	$items = array();
	$_SESSION['cart'] = $items;	
}

if (isset($_GET['add_to_cart'])) {
	$cart->addItem($_GET['add_to_cart']);
}

if (!isset($_GET['prod_id'])) {
	header("Location: listProducts.php");
	exit;
}


if (isset($_GET['remove_item'])) {
	$cart->removeItem($_GET['remove_item']);
}


$db = new MySQLi('localhost', 'root', '', 'shopping');
$result = $db->query("SELECT * FROM product WHERE id=$_GET[prod_id]");
$row = $result->fetch_assoc();
echo "<p>Name: $row[name]</p>";
echo "<p>Description: $row[desc]</p>";
echo "<p>R $row[price]</p>";
if (!$cart->checkItem($row['id']))
	echo "<a href=\"product.php?add_to_cart=$row[id]&prod_id=$row[id]\">Add to cart</a><br/>";
else
	echo "<a href=\"product.php?remove_item=$row[id]&prod_id=$row[id]\">Remove from cart</a><br/>";

?>
<a href="cart.php">Cart </a>