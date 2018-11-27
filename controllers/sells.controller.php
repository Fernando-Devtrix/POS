<?php

class SellsController {

	static public function ctrlShowSells($item, $value) {

		$table = "ventas";

		$answer = SellsModel::mdlShowSells($table, $item, $value);

		return $answer;
	}

}