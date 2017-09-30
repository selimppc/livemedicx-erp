<?php
/* @var $this TransferhdController */
/* @var $model Transferhd */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transferhd-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'im_note'),
)); ?>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'im_transfernum'); ?>
		<?php echo $form->textField($model,'im_transfernum',array('readonly' => true)); ?>
		<?php echo $form->error($model,'im_transfernum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_date'); ?>
		<?php // echo $form->textField($model,'im_date'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'im_date', //attribute name
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
			),
		));?> 
		<?php echo $form->error($model,'im_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_condate'); ?>
		<?php // echo $form->textField($model,'im_condate'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model, //Model object
				'attribute'=>'im_condate', //attribute name
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
				'value'=>CTimestamp::formatDate('Y-m-d', strtotime("tomorrow") ),
			),
		));?> 
		<?php echo $form->error($model,'im_condate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_note'); ?>
		<?php echo $form->textArea($model,'im_note',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'im_note'); ?>
	</div>
    <br>
    <h1 style="background: #FFCCFF; padding: 7px; width: 84%; font-weight: bold;border-radius: 5px;">
        Store, from where the stock will transfer
    </h1>

	<div class="row">
		<?php echo $form->labelEx($model,'im_fromstore'); ?>
		<?php echo $form->dropDownlist($model,'im_fromstore', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'),array('empty'=>'Select From Store ') ); ?>
		<?php //echo $form->textField($model,'im_fromstore', array('readonly'=> true) ); ?>
		<?php echo $form->error($model,'im_fromstore'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'im_fcur'); ?>
        <?php $currency= CHtml::listData(Currency::model()->findAll('cm_active = 1'), 'cm_currency', 'cm_description');
        echo $form->dropDownList($model,'im_fcur', $currency, array('empty'=>'- Choose Currency -',

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
        <?php echo $form->error($model,'im_fcur'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'im_fexchrate'); ?>
        <?php echo $form->textField($model,'im_fexchrate',array('id'=>'exchange_rate', 'placeholder'=>'0.00' )); ?>
        <?php echo $form->error($model,'im_fexchrate'); ?>
    </div>

    <br>
    <h1 style="background: #FFCCFF; padding: 7px; width: 84%; font-weight: bold;border-radius: 5px;">
        Store, Where To transfer
    </h1>

	<div class="row">
		<?php echo $form->labelEx($model,'im_tostore'); ?>
		<?php echo $form->dropDownlist($model,'im_tostore', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'),array('empty'=>'Select TO Store') ); ?>
		<?php echo $form->error($model,'im_tostore'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'im_tcur'); ?>
        <?php $currency= CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description');
        echo $form->dropDownList($model,'im_tcur', $currency, array('empty'=>'- Choose Currency -',

            'ajax' => array(
                'type'=>'POST',
                'url'=>CController::createUrl('purchaseordhd/GetExchangeRate' ),
                //'success'=>'js:function(data){$("#currencyid").val(data);}',
                'update' => '#texchange_rate',
                'data'=>array('store'=>'js:this.value',),
                'success'=> 'function(data) {$("#texchange_rate").empty();
                    $("#texchange_rate").val(data);
                    } ',
            ),

        ));  ?>
        <?php echo $form->error($model,'im_tcur'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'im_texchrate'); ?>
        <?php echo $form->textField($model,'im_texchrate',array('id'=>'texchange_rate', 'placeholder'=>'0.00' )); ?>
        <?php echo $form->error($model,'im_texchrate'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'im_status'); ?>
		<?php echo $form->textField($model,'im_status', array('value'=>'Open', 'readonly'=>TRUE)); ?>
		<?php echo $form->error($model,'im_status'); ?>
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
		<?php // echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
				<?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Transfer Header' : 'Update Transfer Header', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->