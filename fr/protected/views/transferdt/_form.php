<?php
/* @var $this TransferdtController */
/* @var $model Transferdt */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>
<script type="text/javascript">
    function getQuantity(){
        var rcvQty = document.getElementById("available_quantity").innerHTML;
        var changeQty = document.getElementById("im_quantity").value;

        if(parseInt(changeQty) > parseInt(rcvQty) ){
            alert("Transfer quantity must be Less OR Equal to " + rcvQty);
            document.getElementById("unit-quantity").value = rcvQty;

        }
    }
</script>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'transferdt-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'focus'=>array($model,'cm_code'),
    )); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'im_transfernum'); ?>
		<?php echo $form->textField($model,'im_transfernum',array('readonly'=>true )); ?>
		<?php echo $form->error($model,'im_transfernum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_code'); ?>
		<?php // echo $form->textField($model,'cm_code',array('size'=>50,'maxlength'=>50)); ?>

        <input type="hidden" value="<?php echo $branch;?>" id="branch_name" />

		<?php 
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'name'=>'cm_code',
				'model'=>$model,
				'attribute'=>'cm_code',
				//'source'=>CController::createUrl('/Transferdt/GetCmNames'),
                'source'=>'js: function(request, response) {
                        $.ajax({
                            url: "'.$this->createUrl('/Transferdt/GetCmNames').'",
                            dataType: "json",
                            data: {
                                term: request.term,
                                branch: $("#branch_name").val(),
                            },
                            success: function (data) {
                                    response(data);
                            }
                        })
                     }',
				'options'=>array(
					'minLength'=>'1', 
					'select'=>'js:function(event, ui){
						$("#cm_code").text(ui.item.value);
						$("#productname").text(ui.item.label);
						$("#cm-sktunit").val(ui.item.unit);
						$("#available_quantity").text(ui.item.available);
						
					}'
				),
				'htmlOptions'=>array(
					'id'=>'cm_code',
					'placeholder'=>'Search by Product Name',
                    'readonly'=>$model->isNewRecord ? '' : True,
				),
			));
		?> <br><br><div style="padding-left: 147px;" id="productname"></div>

		<?php echo $form->error($model,'cm_code'); ?>
        Available Quantity: <span id="available_quantity" style="font-weight: bold; color: orangered;"></span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_unit'); ?>
		<?php echo $form->textField($model,'im_unit',array('id'=>'cm-sktunit', 'readonly'=>TRUE)); ?>
		<?php echo $form->error($model,'im_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_quantity'); ?>
		<?php echo $form->textField($model,'im_quantity', array('id'=>'im_quantity', 'placeholder'=>'type transfer quantity', 'onchange'=>"getQuantity()", 'required'=>True )); ?>
		<?php echo $form->error($model,'im_quantity'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'im_rate'); ?>
		<?php echo $form->hiddenField($model,'im_rate', array('placeholder'=>'type rate')); ?>
		<?php //echo $form->error($model,'im_rate'); ?>
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
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Transfer Detail' : 'Update Transfer Detail', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>

	</div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


