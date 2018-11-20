<?php

class ProductsController {

	static public function ctrlShowProducts($item, $value) {

		$table = "productos";

		$answer = ModelProducts::mdlShowProducts($table, $item, $value); 

		return $answer;

	}
}