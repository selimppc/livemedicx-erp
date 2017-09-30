<?php
class TestController extends CController {

    /*
     * Testing one. two, three .....
     */
	public function actionTesting() {
        try {
          $testcomponent = new TestComponent();
          } catch(CException $e) {
          echo $e->getMessage();
        }
    }


    /*
     * Staic Sales Data Format
     */
    public function actionSalesJson(){

        $model = new Smheader();
        $model2 = new Smdetail();

        //Generate Invoice Number
        $sm_number = $this->actionInvoiceNo();

        //sales head data
        $sales_head = array(
            'sm_number'=>$sm_number, // generate sales number from Function (DB)
            'sm_date' => '2014-11-22', // current date or customized
            'cm_cuscode'=>'DRC-BUK-0079', //
            'sm_doc_type'=>'sales', //
            'sm_payterms'=>'Cash', //
            'sm_currency'=>'USD',
            'sm_storeid'=>'RUSIZI',  // branch
            'sm_disc_rate'=>'0.00',
            'sm_refe_code'=>'',  // order from app
            'sm_stataus' =>'Open',

		);


        $items = $_POST ? $_POST['cm_code'] : array("");
        foreach ($items as $item) {
            // sales detail
            $sales_detail [] = array(
                'sm_number'=>$sm_number, // generated as above
                'cm_code'=>'C1001AMO-10',  // product code
                'sm_rate'=>'5.55',
                'sm_tax_rate'=>'0.00',
                'sm_unit'=>'1', // sell unit pack
                'sm_unit_qty'=>'55', // order qty
			);
        }

        $data = array(
            'sales_head' => $sales_head,
            'sales_details' => $sales_detail,
		);

        // return in JSON format
        return CJSON::encode($data);

    }


    /*
     * Get Real Data from External Link and store to sales module in ERP System
     *
     */
    public function actionReadJson(){

        $query_date ='2014-07-25';// Smheader::model()->find(array('order'=>'inserttime DESC'))->sm_date;
        $area = 2;   /* area : 1=NL, 2=Burundi,3=Rwanda,4=DRC,5=Uganda,6=Haiti */

        $url =   'http://37.230.100.79/hefpromanager/api/read/orders?query_date='.$query_date.'&area='.$area;
        #$params = array($query_date, $area);
        $output = Yii::app()->curl->get($url);
        $result = CJSON::decode($output);
		#$sm_number = 'IN--00000832'; // $this->actionInvoiceNo();  //Generate Sales Invoice Number "sm_number"


		#$transaction=$model->dbConnection->beginTransaction();
		try{
			foreach($result as $hd){
				$model = new Smheader;
				$model->sm_number = $this->actionInvoiceNo();
				$model->sm_date = $hd['sm_date'];
				$model->cm_cuscode = 'DRC-BUK-0079'; //$hd['cm_cuscode'];
				$model->sm_doc_type = $hd['sm_doc_type'];
				$model->sm_rsm = rand(0, 5);
				$model->sm_payterms = $hd['sm_payterms'];
				$model->sm_currency = $hd['sm_currency'];
				$model->sm_storeid = $hd['sm_storeid'];
				$model->sm_disc_rate = $hd['sm_disc_rate'];
				$model->sm_refe_code = $hd['sm_refe_code'];
				$model->sm_stataus = $hd['sm_stataus'];
				#$model->sm_date = date("Y-m-d");
				$model->inserttime = date("Y-m-d H:i");
				$model->insertuser = "onTab";

				//batch per transaction
				$batch = $model->sm_rsm;  //rand(0,5);

				if ($model->save()) {
					$sl_dt = (object) $hd['details'];
					foreach($sl_dt as $dt){
						$models_dt = new Smdetail();
						$models_dt->sm_number = $model->sm_number;
						$models_dt->cm_code = $dt['cm_code'];
						$models_dt->sm_unit = $dt['sm_unit'];
						$models_dt->sm_unit_qty = $dt['sm_unit_qty'];
						$models_dt->sm_rate = $dt['sm_rate'];
						$models_dt->sm_bonusqty = '0';
						$models_dt->sm_quantity = $dt['sm_unit_qty'];
						$models_dt->sm_tax_rate = $dt['sm_tax_rate'];
						$models_dt->sm_tax_amt = '0.00';
						$models_dt->sm_lineamt = $dt['sm_rate'];
						$models_dt->inserttime = date("Y-m-d H:i");
						$models_dt->isNewRecord = true;
						$models_dt->save();
					}

				}

			}

			#$transaction->commit();
		}catch(Exception $e){
			#$transaction->rollback();
			exit($e->getMessage());
		}

		return true;

    }


    /*
	 * Generate Invoice Number: for sales module
	 */
    private function actionInvoiceNo(){
        $sql="SELECT Fu_GetTrn('Invoice No','IN--',8,0) ";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();

        return $result;
    }

    /*
     *
     * Response data to live server
     *
     */
    public function actionOrderUpdate(){
		$batch = 1;
		#print_r($batch);exit;
		$output = Smheader::model()->findAllByAttributes(array('sm_rsm'=>$batch));
		#Productmaster::model()->findByAttributes(array('cm_code' => $this->cm_code));

		foreach ($output as $item) {
			// sales detail
			$datas [] = array(
					'invoice_number'=>$item->sm_number, // generated as above
					'order_id'=>$item->sm_refe_code,  // product code
					'status'=>$item->sm_stataus,
			);
		}

		$data = CJSON::encode($datas) ;
		#print_r($data);exit;

        // POST methid through curl
        $url = 'http://37.230.100.79/hefpromanager/api/orderupdate';
        $output = Yii::app()->curl->post($url, $data);  // $data - data that will be POSTed

		print_r($output);exit;
        return $output;
		exit;

    }




    public function actionResponseJson(){
		$batch = 1;
		$output = Smheader::model()->findAllByAttributes(array('sm_rsm'=>$batch));

		#$sales_status = array();
		foreach ($output as $item) {
			// sales detail
			$sales_status [] = array(
					'invoice_number'=>$item->sm_number, // generated as above
					'order_id'=>$item->sm_refe_code,  // product code
					'status'=>$item->sm_stataus,
			);
		}
		#return CJSON::encode($sales_status);
		#print_r($sales_status)   ;exit;

		/*$data = [
				'order_status' => $sales_status
		];*/
		#$data= CJSON::encode($sales_status);
		$data['jsondata'] = CJSON::encode($sales_status) ;
		$url = 'http://37.230.100.79/hefpromanager/api/orderupdate';
		$output = Yii::app()->curl->post($url, $data);  // $data - data that will be POSTed

		print_r($output);exit;

    }
}

