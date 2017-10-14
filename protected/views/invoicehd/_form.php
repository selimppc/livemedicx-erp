<?php
/* @var $this InvoicehdController */
/* @var $model Smheader */
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
	'id'=>'smheader-form',
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
		<?php echo $form->textField($model,'sm_number', array('readonly'=>'readonly', 'style'=>'background:#ccc;')); ?>
		<?php echo $form->error($model,'sm_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_date'); ?>
		<?php // echo $form->textField($model,'sm_date', array('readonly'=>'readonly')); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'sm_date', //attribute name
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
                'value'=>CTimestamp::formatDate('Y-m-d'),
            )
        ));?>
        <?php echo $form->error($model,'sm_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_cuscode'); ?>
        <?php echo CHtml::activeDropDownList($model, 'cm_cuscode', CHtml::listData(Customermst::model()->findAll(array('order'=>'cm_name ASC')), 'cm_cuscode', 'cm_name'),  array('empty'=>'- Select Customer -', 'required'=>TRUE) ); ?>
		<?php echo $form->error($model,'cm_cuscode'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'sm_payterms'); ?>
        <?php echo $form->dropDownList($model,'sm_payterms', array('Cash'=>'Cash','Credit'=>'Credit')); ?>
		<?php echo $form->error($model,'sm_payterms'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'sm_currency'); ?>
        <?php $currency= CHtml::listData(Currency::model()->findAll('cm_active = 1'), 'cm_currency', 'cm_description');
        echo $form->dropDownList($model,'sm_currency', $currency, array('empty'=>'- Choose Currency -', 'required'=>TRUE,

            'ajax' => array(
                'type'=>'POST',
                'url'=>CController::createUrl('purchaseordhd/GetExchangeRate' ),
                //'success'=>'js:function(data){$("#currencyid").val(data);}',
                'update' => '#exchange_rate',
                'data'=>array('store'=>'js:this.value',),
                'success'=> 'function(data) {$("#exchange_rate").empty();
                    $("#exchange_rate").val(data);
                    } ',
            ),

        ));  ?>
		<?php echo $form->error($model,'sm_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sm_exchrate'); ?>
        <?php echo $form->textField($model,'sm_exchrate',array('id'=>'exchange_rate', 'placeholder'=>'0.00' )); ?>
        <?php echo $form->error($model,'sm_exchrate'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'sm_doc_type'); ?>
        <?php echo $form->hiddenField($model,'sm_doc_type',array('value'=>'Sales', 'id'=>'sm_doc_type')); ?>
		<?php // echo $form->error($model,'sm_doc_type'); ?>
	</div>



	<div class="row">
		<label>Warehouse </label>
        <?php echo $form->dropDownList($model,'sm_storeid', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('id'=>'warehouse', 'required'=>TRUE)); ?>
		<?php echo $form->error($model,'sm_storeid'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'sm_disc_rate'); ?>
        <?php echo $form->textField($model,'sm_disc_rate', array('value'=>'0', 'required'=>true)); ?>
        <?php echo $form->error($model,'sm_disc_rate'); ?>
    </div>


    <div class="row">
        <?php //echo $form->labelEx($model,'sm_stataus'); ?>
        <?php echo $form->hiddenField($model,'sm_stataus',array('value'=>'Open','readonly'=>'readonly')); ?>
        <?php //echo $form->error($model,'sm_stataus'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'sm_sign'); ?>
        <?php echo $form->hiddenField($model,'sm_sign'); ?>
        <?php //echo $form->error($model,'sm_sign'); ?>
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
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Invoice Header' : 'Update Invoice', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->