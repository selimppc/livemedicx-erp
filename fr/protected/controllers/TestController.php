<?php
class TestController extends CController {

	public function actionTesting() {
    try {
      $testcomponent = new TestComponent();
      } catch(CException $e) {
      echo $e->getMessage();
    }
  }
  
  
} 