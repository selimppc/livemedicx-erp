<?php
/* @var $this GrndetailController */
/* @var $model Grndetail */
/* @var $form CActiveForm */
?>
<div style="width: 100%; float: left;"> 

<div style="width: 44%; float: left;"> 
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grndetail-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_code'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'im_grnnumber'); ?>
		<?php // echo $form->dropDownList($model,'im_grnnumber',CHtml::listData(Grnheader::model()->findAll(array('order'=>'im_grnnumber DESC', 'limit'=>'1')), 'im_grnnumber', 'im_grnnumber'), array('id'=>"grnnumber")); ?>
		<?php echo $form->textField($model,'im_grnnumber',array('readonly' => 'true') ); ?>
		<?php echo $form->error($model,'im_grnnumber'); ?>
	</div>	


	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php // echo $form->dropDownList($model,'cm_code', CHtml::listData(Purchaseorddt::model()->findAll(" pp_purordnum = '$pp_purordnum' "), 'cm_code', 'cm_code') ); ?>
		
		<?php $storeArray = CHtml::listData(Purchaseorddt::model()->findAll(" pp_purordnum = '$pp_purordnum' "), 'cm_code', 'cm_code');
           echo $form->dropDownList($model,'cm_code', $storeArray, 
                          array(
                          		'empty'=>"Select Product Code",
                                'ajax' => array(
	                                'type'=>'POST',
	                                'url'=>CController::createUrl('grndetail/GetProductCode' ),
	                          		//'success'=>'js:function(data){$("#productname").val(data);}', 
                          			'update' => '#productname',  
									'data'=>array('store'=>'js:this.value',),   
            						'success'=> 'function(data) {$("#productname").empty();
                           		 	$("#productname").val(data);
                           		 	} ', 
                          ),
                 			     
            )); ?> 
            <br> <input type="text" name="productname" id="productname" value="" />
            <br>
		<?php echo $form->error($model,'cm_code'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'im_BatchNumber'); ?>
		<?php echo $form->textField($model,'im_BatchNumber', array('placeholder'=>'type batch number')); ?>
		<?php echo $form->error($model,'im_BatchNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_ExpireDate'); ?>
		<?php // echo $form->textField($model,'im_ExpireDate' ); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'im_ExpireDate', //attribute name
				'language'=> '',
				'mode'=>'date', 
				'options'=>array(
					'dateFormat' => 'yy-mm-dd',
					'showAnim'=>'fold',
					'changeMonth' => 'true',
					'changeYear' => 'true',
					'showOtherMonths' => 'true',
					'selectOtherMonths' => 'true',
					'showOn' => 'both',
					'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
					
			),
			'htmlOptions'=>array(
				'value'=>CTimestamp::formatDate('Y-m-d', strtotime("tomorrow")),

			)
		));?> 
		<?php echo $form->error($model,'im_ExpireDate'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'im_unit'); ?>
		<?php $x = Purchaseorddt::model()->findByAttributes( array('pp_purordnum' => $pp_purordnum));
       		  $y = $x['pp_unit'];
       		  $model->im_unit = $y;
       		  echo $form->textField($model,'im_unit', array('readonly'=>TRUE)); ?>
		<?php echo $form->error($model,'im_unit'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'im_unitqty'); ?>
		<?php $x = Purchaseorddt::model()->findByAttributes( array('pp_purordnum' => $pp_purordnum));
       		  $y = $x['pp_unitqty'];
       		  $model->im_unitqty = $y;
       		  echo $form->textField($model,'im_unitqty', array('readonly'=>TRUE) ); ?> 
		<?php echo $form->error($model,'im_unitqty'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'im_RcvQuantity'); ?>
		<?php //echo $form->textField($model,'im_RcvQuantity',  array('id'=>'rcvquantity') ); ?>
		<?php $x = Purchaseorddt::model()->findByAttributes( array('pp_purordnum' => $pp_purordnum));
       		  $y = $x['pp_quantity'];
       		  $model->im_RcvQuantity = $y;
       		  echo $form->textField($model,'im_RcvQuantity',  array('id'=>'rcvquantity') ); ?> 
       		  <br><div style="font-size: 11px; color: orange; font-style: italic; ">Not More Than <b> <?php echo $y ?> </b> </div>
		<?php echo $form->error($model,'im_RcvQuantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_costprice'); ?>
		<?php $x = Purchaseorddt::model()->findByAttributes( array('pp_purordnum' => $pp_purordnum));
       		  $y = $x['pp_purchasrate'];
       		  $model->im_costprice = $y;
       		  echo $form->textField($model,'im_costprice',array('id'=>'purchasrate')); ?>
		<?php echo $form->error($model,'im_costprice'); ?>
	</div>

<script type="text/javascript">
$(function() {
	$("#rcvquantity").change(function(){
	        setTarget()
	});
	    $("#purchasrate").change(function(){
	        setTarget();
	});
	});

	function setTarget(){
	    var a = $("#rcvquantity").val();
	    var b = $("#purchasrate").val();
	    var data = (a * b);
	    $('#rowamount').val(data);
	}
</script>
	<div class="row">
		<?php echo $form->labelEx($model,'im_rowamount'); ?>
		<?php echo $form->textField($model,'im_rowamount',array('id'=>'rowamount', 'readonly'=>TRUE )); ?>
		<?php echo $form->error($model,'im_rowamount'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'inserttime'); ?>
		<?php echo $form->hiddenField($model,'inserttime'); ?>
		<?php //echo $form->error($model,'inserttime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updatetime'); ?>
		<?php echo $form->hiddenField($model,'updatetime'); ?>
		<?php //echo $form->error($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'insertuser'); ?>
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<div class="row status-container">
                <div class="span4 action-bar">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
				</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>

<?php Yii::app()->clientScript->registerScript('register_script_name', "
    $('#1111 .cmcodedt').click(function(){
       var a = document.getElementById('cmcodedt').innerHTML; 
       var b = document.getElementById('cmnamedt').innerHTML; 
       var c = document.getElementById('ppunitdt').innerHTML; 
       var d = document.getElementById('ppunitqtydt').innerHTML;
       var e = document.getElementById('ppquantity').innerHTML; 
       var f = document.getElementById('pppurchasratedt').innerHTML; 
       var g = document.getElementById('pptotalamountdt').innerHTML; 

 
       document.getElementById('111').value= a;
       document.getElementById('222').value= b;
       document.getElementById('333').value= c;
       document.getElementById('444').value= d;
       document.getElementById('555').value= e;
       document.getElementById('666').value= f;
       document.getElementById('777').value= g;
      return false;
    });
", 
CClientScript::POS_READY); ?>


<div style="width: 53%;float: left; margin-left: 2%;"> 
Purchase Detail by <?php echo $pp_purordnum; ?>
<br>
<input id="111" name="">
<input id="222" name="">
<input id="333" name="">
<input id="444" name="">
<input id="555" name="">
<input id="666" name="">
<input id="777" name="">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	//'id'=>'grndetail-grid',
	'rowHtmlOptionsExpression' => 'array("id"=>$data->cm_code)',
	'dataProvider'=>VwPurchasedt::model()->Search($pp_purordnum),
	'columns'=>array(
		//'pp_purordnum',
		//'cm_code',
		array(
			'class'=>'CLinkColumn',
            'header'=>'Product Code',
            'labelExpression'=>'$data->cm_code',
			//'urlExpression'=>'array("requisitiondt/RequisitionNumber","cm_code"=>$data->cm_code, "pp_purordnum"=>$data->pp_purordnum) ',
			'htmlOptions'=>array('class'=>'cmcodedt'),  
         ),

       array(
          'name'=>'cm_code',
          'value'=>'$data->cm_code',
          'htmlOptions'=>array('id'=>'cmcodedt'), 
       	  //'visible'=>$model->cm_code=="0",
        ),  
        
       array(
          'name'=>'cm_name',
          'value'=>'$data->cm_name',
          'htmlOptions'=>array('id'=>'cmnamedt'), 
        ),
       array(
          'name'=>'pp_unit',
          'value'=>'$data->pp_unit',
          'htmlOptions'=>array('id'=> 'ppunitdt'), 
        ),

        array(
          'name'=>'pp_unitqty',
          'value'=>'$data->pp_unitqty',
          'htmlOptions'=>array('id'=> 'ppunitqtydt'), 
        ),
        array(
          'name'=>'pp_quantity',
          'value'=>'$data->pp_quantity',
          'htmlOptions'=>array('id'=> 'ppquantity'), 
        ),
        
        array(
          'name'=>'pp_purchasrate',
          'value'=>'$data->pp_purchasrate',
          'htmlOptions'=>array('id'=> 'pppurchasratedt'), 
        ),
        array(
          'name'=>'pp_totalamount',
          'value'=>'$data->pp_totalamount',
          'htmlOptions'=>array('id'=> 'pptotalamountdt'), 
        ),

	),
)); ?>
</div>
</div>
