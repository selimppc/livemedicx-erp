<?php
class TestComponent extends CApplicationComponent {

	public function __construct() {
    $a=false;
    if ($a) {

    } else
      throw new CException("Custom exception!");
  }
}

