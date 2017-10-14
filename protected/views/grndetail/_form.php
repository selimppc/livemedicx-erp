<?php
/* @var $this GrndetailController */
/* @var $model Grndetail */
/* @var $form CActiveForm */
?>


<script type="text/javascript">
$(document).ready(function(){
	$(".items tr").click(function() {
	    var tableData = $(this).children("td").map(function() {
	        return $(this).text();
	    }).get();

	    //change row color on click 
	    $(".items tr").each(function(index, elem){
	       $(elem).removeClass("active");
	    });
	    $(this).addClass("active");  

	    $("#product-code").val($.trim(tableData[0]));
	    $("#product-name").val($.trim(tableData[1]));
	    $("#unit").val($.trim(tableData[2]));
	    $("#quantity").val($.trim(tableData[3]));
	    $("#unit-quantity").val($.trim(tableData[4]));
	    $("#receive_quantity_limit").val($.trim(tableData[4]));
	    $("#purchase-rate").val($.trim(tableData[5]));
	    $("#total-ammount").val($.trim(tableData[6]));
	});
});

$(function() {
	$("#unit-quantity").change(function(){
	        setTarget();
	});
	    $("#purchase-rate").change(function(){
	        setTarget();
	});
	});

	function setTarget(){
	    var a = $("#unit-quantity").val();
	    var b = $("#purchase-rate").val();
        var c = $("#quantity").val();
	    var data = (a * b * c);
	    $('#total-ammount').val(data);
	}

	function getQuantity(){
			var rcvQty = document.getElementById("receive_quantity_limit").value; 
			var changeQty = document.getElementById("unit-quantity").value; 

			if(parseInt(changeQty) > parseInt(rcvQty) ){
					alert("Received quantity must be Less OR Equal to " + rcvQty);
					document.getElementById("unit-quantity").value = rcvQty; 

				}
		}
	
</script>


<div style="width: 98%; float: left;">

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
		<?php echo $form->textField($model,'cm_code', array('id'=>'product-code', 'readonly' =>TRUE ) ); ?>
            <br> <input type="text" id=product-name value="" disabled/>
            <br>
		<?php echo $form->error($model,'cm_code'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'im_BatchNumber'); ?>
		<?php echo $form->textField($model,'im_BatchNumber', array('placeholder'=>'type batch number', 'required'=>TRUE )); ?>
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
				'value'=>CTimestamp::formatDate('Y-m-d', strtotime("+30 days")),

			)
		));?> 
		<?php echo $form->error($model,'im_ExpireDate'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'im_unit'); ?>
		<?php echo $form->textField($model,'im_unit', array('id'=>'unit', 'readonly'=>TRUE)); ?>
		<?php echo $form->error($model,'im_unit'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'im_unitqty'); ?>
		<?php echo $form->textField($model,'im_unitqty', array('id'=>'quantity', 'readonly'=>TRUE) ); ?> 
		<?php echo $form->error($model,'im_unitqty'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'im_RcvQuantity'); ?>
		<?php echo $form->textField($model,'im_RcvQuantity',  array('id'=>'unit-quantity', 'onchange'=>"getQuantity()") ); ?>
		<input type="hidden" id="receive_quantity_limit" /> 
		<?php echo $form->error($model,'im_RcvQuantity'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'im_costprice'); ?>
		<?php echo $form->textField($model,'im_costprice',array('id'=>'purchase-rate')); ?>
		<?php echo $form->error($model,'im_costprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_rowamount'); ?>
		<?php echo $form->textField($model,'im_rowamount', array('id'=>'total-ammount', 'readonly'=>TRUE )); ?>
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
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Enter GRN Detail' : 'Update GRN Detail', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>



<div style="width: 53%;float: left; margin-left: 2%;">
	<div>

        <h1 style="background: #FFCCFF; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
            Purchase # <?php echo $pp_purordnum; ?> and Details
        </h1>
		
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'grndetail-grid',
			//'rowHtmlOptionsExpression' => 'array("id"=>$data->cm_code)',
			'dataProvider'=>VwPurchasedt::model()->Search($pp_purordnum),
			'columns'=>array(
				//'cm_code',
				array(
					'class'=>'CLinkColumn',
		            'header'=>'Product Code',
		            'labelExpression'=>'$data->cm_code',  
		         ),
		        'cm_name',
				'pp_unit',
				'pp_unitqty',
				'pp_quantity',
				'pp_purchasrate',
				'pp_totalamount',
		        
		
			),
		)); ?>
	</div>

	<br><br>
	<div> 
		<h3>GRN Detail: <?php echo $im_grnnumber; ?></h3>
		
		
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'grndetail-grid-by-grn',
			'dataProvider'=>VwGrndetail::model()->Search($im_grnnumber),
			'columns'=>array(
				'cm_code',
		        'cm_name',
				//'im_BatchNumber',
				'im_ExpireDate',
				'im_RcvQuantity',
				'im_costprice',
				'im_unit',
		        'im_rowamount',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=>array
                    (
                        'delete' => array
                        (
                            'label'=>'Delete',
                            'url'=>'Yii::app()->createUrl("grndetail/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
		
			),
		)); ?>
	</div>
</div>
</div>
