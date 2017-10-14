<?php
/* @var $this JournaldtController */
/* @var $model Voucherdetail */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>


<script type="text/javascript">
    function rateMultiply(){

        var exchangeRate = Math.round((document.getElementById("currencyid").value) * 100) / 100;
        var primeAmt = Math.round((document.getElementById("am_primeamt").value) * 100) / 100;

        var baseAmt = Math.round((exchangeRate * primeAmt) * 100) / 100;

        document.getElementById("am_baseamt").value = baseAmt;
    }

    function primeMultiply(){

        var exchangeRate = Math.round((document.getElementById("currencyid").value) * 100) / 100;
        var primeAmt = Math.round((document.getElementById("am_primeamt").value) * 100) / 100;

        var baseAmt = Math.round((exchangeRate * primeAmt) * 100) / 100;

        document.getElementById("am_baseamt").value = baseAmt;
    }
</script>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'voucherdetail-form',
	'enableAjaxValidation'=>false,
)); ?>

    <h1 style="background: #FFCCFF; padding: 5px; width: 90%; font-weight: bold; text-align: center;">
        Fill in Voucher Detail Information
    </h1>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'am_vouchernumber'); ?>
		<?php echo $form->textField($model,'am_vouchernumber',array('readonly'=>true)); ?>
		<?php echo $form->error($model,'am_vouchernumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_accountcode'); ?>
		<?php // echo $form->textField($model,'am_accountcode',array('size'=>50,'maxlength'=>50)); ?>
        <?php   $coa = Chartofaccounts::model()->findAll();
                $data = array();
                foreach ($coa as $coa)
                    $data[$coa->am_accountcode] = $coa->am_accountcode . ' - '. $coa->am_description;

        echo $form->dropDownList($model, 'am_accountcode', $data ,array('prompt' => '- Select Account -', 'required'=>TRUE,));

        //echo $form->dropDownList($model, 'am_accountcode', CHtml::listData(Chartofaccounts::model()->findAll(),'am_accountcode','am_description'));
        ?>
		<?php echo $form->error($model,'am_accountcode'); ?>
	</div>

	<!-- <div class="row">
		<?php //echo $form->labelEx($model,'am_subacccode'); ?>
		<?php //echo $form->textField($model,'am_subacccode',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'am_subacccode'); ?>
	</div> -->

	<div class="row">
		<?php echo $form->labelEx($model,'am_currency'); ?>
		<?php //echo $form->textField($model,'am_currency',array('size'=>10,'maxlength'=>10)); ?>
        <?php $currency = CHtml::listData(Currency::model()->findAll('cm_active = 1'),'cm_currency','cm_description');
        echo $form->dropDownList($model, 'am_currency', $currency,
            array('empty'=>'- Select Currency -','required'=>true,

                'ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('journaldt/GetExchangeRate' ),
                        //'success'=>'js:function(data){$("#currencyid").val(data);}',
                        'update' => '#currencyid',
                        'data'=>array('store'=>'js:this.value',),
                        'success'=> 'function(data) {$("#currencyid").empty();
                        $("#currencyid").val(data);
                        } ',
                ),

        ));?>
		<?php echo $form->error($model,'am_currency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_exchagerate'); ?>
		<?php echo $form->textField($model,'am_exchagerate',array('id'=>'currencyid', 'placeholder'=>'1.00', 'required'=>true, 'onchange'=>"rateMultiply()")); ?>
		<?php echo $form->error($model,'am_exchagerate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_primeamt'); ?>
		<?php echo $form->textField($model,'am_primeamt',array('id'=>'am_primeamt','placeholder'=>'0','required'=>true, 'onchange'=>"primeMultiply()")); ?>
		<?php echo $form->error($model,'am_primeamt'); ?>
	</div>
    <span style="color: coral; float: left; margin-left: 28%; font-weight: bold;">
            For credit add minus sign(-) before numeric digit(s).
    </span>

	<div class="row">
		<?php echo $form->labelEx($model,'am_baseamt'); ?>
		<?php echo $form->textField($model,'am_baseamt',array('id'=>'am_baseamt','placeholder'=>'0', 'readonly'=>true, 'style'=>'background: #ddd;')); ?>
		<?php echo $form->error($model,'am_baseamt'); ?>
         <span style="color: coral; float: left; margin-left: 28%; font-weight: bold;">
                Local currency conversion appears here.
         </span>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'am_branch'); ?>
		<?php //echo $form->textField($model,'am_branch',array('size'=>50,'maxlength'=>50)); ?>
        <?php //echo $form->dropDownList($model, 'am_branch', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'));?>
		<?php //echo $form->error($model,'am_branch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_note'); ?>
		<?php echo $form->textArea($model,'am_note',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'am_note'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add New Detail' : 'Update Voucher Dt.', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->