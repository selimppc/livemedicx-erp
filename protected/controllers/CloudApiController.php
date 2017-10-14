<?php

class CloudApiController extends CController
{
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

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
	 * Fetch Order data from cloud and store into the ERP system
	 *
	 */
	public function actionFetchJsonData(){

		$query_date = date("Y-m-d", time() - 60 * 60 * 24);
		#$query_date = "2016-01-12";
		$area = 4;   /* area : 1=NL, 2=Burundi,3=Rwanda,4=DRC,5=Uganda,6=Haiti */
		$url =   'http://37.230.100.79/hefpromanager/api/read/orders?query_date='.$query_date.'&area='.$area;
		$output = Yii::app()->curl->get($url);
		$result = CJSON::decode($output);
		unset($result["count"]);


		if(count($result)>0){
			foreach($result as $hd){
				$record= Smheader::model()->find(array(
				  'select'=>'sm_refe_code',
				  'condition'=>'sm_refe_code=:sm_refe_code',
				  'params'=>array(':sm_refe_code'=>$hd['sm_refe_code']))
				);

				if( count($record)>0 ){
					// Do Nothing ...
					echo ("Data already exists !");
					#return true;
					
				}else{

					$customer_code = Customermst::model()->findByAttributes(array('gerant_id'=>$hd['cm_cuscode']));
					if($customer_code){

						$model = new Smheader;
						$model->sm_number = $this->actionInvoiceNo();
						$model->sm_date = $hd['sm_date'];
						$model->cm_cuscode = $customer_code->cm_cuscode;
						$model->sm_doc_type = $hd['sm_doc_type'];
						$model->sm_rsm = rand(0, 5);
						$model->sm_payterms = $hd['sm_payterms'];
						$model->sm_currency = $hd['sm_currency'];
						$model->sm_storeid = $hd['sm_storeid'];
						$model->sm_disc_rate = $hd['sm_disc_rate'];
						$model->sm_refe_code = $hd['sm_refe_code'];
						$model->sm_stataus = $hd['sm_stataus'];
						$model->inserttime = date("Y-m-d H:i");
						$model->insertuser = "onTab";
						//batch per transaction
						#$batch = $model->sm_rsm;  //rand(0,5);

						try {
							$transaction = Yii::app()->db->beginTransaction();
							if ($model->save()) {
								$sl_dt = (object)$hd['details'];
								//details
								foreach ($sl_dt as $dt) {
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

									echo "Product added " . $dt['cm_code']."<br>";
								}
								$transaction->commit();
							}
						}catch(Exception $e){
							$transaction->rollback();
							#print_r($e->getMessage());
							echo ("Mismatched Product Code from Cloud to ERP.")."<br>";
						}
					}else{
						echo ("Grant Id missing !");
					}
				}
			}
		}else{
			echo ("Order/ Sales Data not found");
		}
	}



	/*
	 * Post all sales status into cloud server
	 *
	 */
	public function actionPostToCloud(){
		$batch = 1;
		$output = Smheader::model()->findAllByAttributes(array('sm_rsm'=>$batch));

		foreach ($output as $item) {
			// sales detail
			$sales_status [] = array(
				'invoice_number'=>$item->sm_number, // generated as above
				'order_id'=>$item->sm_refe_code,  // product code
				'status'=>$item->sm_stataus,
			);
		}

		$data['jsondata'] = CJSON::encode($sales_status) ;
		$url = 'http://37.230.100.79/hefpromanager/api/orderupdate';
		$output = Yii::app()->curl->post($url, $data);  // $data - data that will be POSTed

		if($output == TRUE){
			echo ('Successfully Uploaded !');
		}else{
			echo ('Invalid Request. Please try again!');
		}

	}




}