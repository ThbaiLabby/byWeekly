<?php

class Cart{
	
	public function addItem($id) {
		array_push($_SESSION['cart'], $id);
	}
	
	public function checkItem($id) {
		$counter = 0;
		foreach ($_SESSION['cart'] as $item) {
			if ($item == $id)
				return true;	
			$counter++;
		}
		return false;	
	}
	
	public function removeItem($id) {
		$counter = 0;
		foreach ($_SESSION['cart'] as $item) {
			if ($item == $id)
				$_SESSION['cart'][$counter] = NULL;	
			$counter++;
		}
	}
	
}



?>