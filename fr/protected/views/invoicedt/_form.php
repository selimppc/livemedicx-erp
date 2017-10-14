<?php
/* @var $this InvoicedtController */
/* @var $model Smdetail */
/* @var $form CActiveForm */
?>
<style>
    .row input {
        width: 58%;
        padding: 6px;
        margin-bottom: 5px;
    }
    .row select {
        width: 60%;
        padding: 6px;
        margin-bottom: 5px;
    }

</style>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'smdetail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_number'); ?>
		<?php echo $form->textField($model,'sm_number',array('readonly'=>TRUE,'style'=>'background: #ccc;')); ?>
		<?php echo $form->error($model,'sm_number'); ?>
	</div>

    <div  class="row">
        <label> Warehouse </label>
        <span> <?php echo $sm_storeid; ?> </span>
        <input type="hidden" id="warehouse" value="<?php echo $sm_storeid; ?>">
        <input type="hidden" id="date" value="<?php echo $sm_date; ?>">
    </div>

    <div  class="row">
        <label> Product Name </label>
        <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            //'name'=>'product_name',
            'attribute'=>'product_name',
            'model'=>$model,
            //'source'=>CController::createUrl('/smheader/autocompleteTestNew'),
            'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('invoicedt/autocompleteTestNew').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                        date: $("#date").val(),
                                        warehouse: $("#warehouse").val(),
                                    },
                                    success: function (data) {
                                            response(data);
                                    }
                                })
                             }',
            'options'=>array(
                'minLength'=>'1',
                'select'=>'js:function( event, ui ) {
										$("#product_name").text(ui.item.label);
										$("#code").val(ui.item.code);
										$("#sell_rate").val(ui.item.rate);
										$("#tax_rate").val(ui.item.tax);
										$("#unit_a").val(ui.item.unit);
										$("#sell_unit").val(ui.item.sellunit);
										$("#unit_qty").val(ui.item.unit_qty);
										$("#available").text(ui.item.available);

			                         }',
            ),
            'htmlOptions'=>array(
                'id'=>'product_name',
                'placeholder'=>'search by product name or code',
                'required'=>TRUE,
                //'style' => 'width: 96%; padding: 8px; margin-bottom: 10px; border: 1px solid orange;',
                //'onClick' => 'document.getElementById("cm_code").value= ""',
            ),
        ));?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php echo $form->textField($model,'cm_code',array('id'=>'code', 'readonly'=>TRUE,)); ?>
		<?php echo $form->error($model,'cm_code'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'sm_rate'); ?>
		<?php echo $form->textField($model,'sm_rate',array('id'=>'sell_rate', 'required'=>TRUE,)); ?>
		<?php echo $form->error($model,'sm_rate'); ?>
	</div>

	<div class="row">
		<label>TAX Rate (%)</label>
		<?php echo $form->textField($model,'sm_tax_rate',array('id'=>'tax_rate', 'required'=>TRUE,)); ?>
		<?php echo $form->error($model,'sm_tax_rate'); ?>
	</div>

    <div class="row">
        <label>Sell Unit</label>
        <?php echo $form->textField($model,'sm_unit',array('id'=>'unit_a', 'readonly'=>TRUE,)); ?>
        <?php echo $form->error($model,'sm_unit'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_unit_qty'); ?>
		<?php echo $form->textField($model,'sm_unit_qty',array('id'=>'unit_qty','readonly'=>TRUE,
)); ?>
		<?php echo $form->error($model,'sm_unit_qty'); ?>
	</div>

	<div class="row">
		<label>Order Quantity</label>
		<?php echo $form->textField($model,'sm_quantity',array('required'=>TRUE, 'id'=>'cQty', 'onchange'=>"checkQty()")); ?>
		<?php echo $form->error($model,'sm_quantity'); ?><br/>

	</div>
    <div class="row">
        <span style="font-weight: bold; color: orangered;">Available Quantity is: <b id="available"></b></span>
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
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1', 'style'=>'padding-top: 25px;')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Invoice Detail' : 'Update Invoice Detail.', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->



<script type="text/javascript">
    function checkQty(){
        var av = document.getElementById("available").innerHTML;
        var cv = document.getElementById("cQty").value;
        if(parseInt(cv) > parseInt(av)){
            alert("Order Quantity must be less than available");
            document.getElementById("cQty").value = "";
            return false;
        }else{
            return true;
        }
    }
</script>