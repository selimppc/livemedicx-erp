<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'productmaster-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'focus'=>array($model,'cm_code'),
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div style="float: left; width: 50%;">


    <div class="row">
        <?php echo $form->labelEx($model,'cm_code'); ?>
        <?php echo $form->textField($model,'cm_code', array($model->isNewRecord ? '' : 'readonly'=>True,'required'=>TRUE,)); ?>
        <span style="color: #FF6600; float: left; margin-bottom: 5px;">
			<?php echo $model->isNewRecord ? 'Product code must be unique' : 'Product Code Can not be changed '?>
		</span>
        <?php echo $form->error($model,'cm_code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_name'); ?>
        <?php echo $form->textField($model,'cm_name',array('size'=>60,'maxlength'=>200, 'required'=>TRUE,)); ?>
        <?php echo $form->error($model,'cm_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_description'); ?>
        <?php echo $form->textField($model,'cm_description',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'cm_description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'image'); ?>( URL )
        <?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'image'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_class'); ?>
        <?php  echo $form->dropDownList($model,'cm_class', CHtml::listData(Codesparam::model()->findAll('cm_type="Product Class"'), 'cm_code', 'cm_code'), array('empty'=>'- Select Product Class -', 'required'=>TRUE,) ); ?>
        <?php echo $form->error($model,'cm_class'); ?>
    </div>


    <div class="row"> <!--AMIT. HERE I SWITCH GROUP DOWN CATEGORY UP-->
        <?php echo $form->labelEx($model,'cm_category'); ?>
        <?php echo $form->dropDownList($model,'cm_category', CHtml::listData(Codesparam::model()->findAll('cm_type="Product Category"'), 'cm_code', 'cm_code'), array('empty'=>'- Select Product Category -', 'required'=>TRUE,)); ?>
        <?php echo $form->error($model,'cm_category'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_group'); ?>
        <?php echo $form->dropDownList($model,'cm_group', CHtml::listData(Codesparam::model()->findAll('cm_type="Product Group"'), 'cm_code', 'cm_code'), array('empty'=>'- Select Product Group -', 'required'=>TRUE,)); ?>
        <?php echo $form->error($model,'cm_group'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'currency'); ?>
        <?php //echo $form->dropDownList($model,'pp_currency', CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description'), array('empty'=>'- Select Currency -', 'required'=>true, )); ?>
        <?php $currency= CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description');
        echo $form->dropDownList($model,'currency', $currency, array('empty'=>'- Select Currency -', 'required'=>TRUE,

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
        <?php echo $form->error($model,'currency'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'exchange_rate'); ?>
        <?php echo $form->textField($model,'exchange_rate',array('id'=>'exchange_rate', 'placeholder'=>'0.00' )); ?>
        <?php echo $form->error($model,'exchange_rate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_sellrate'); ?>
        <?php echo $form->textField($model,'cm_sellrate', array('required'=>TRUE ) ); ?>
        <?php echo $form->error($model,'cm_sellrate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_costprice'); ?>
        <?php echo $form->textField($model,'cm_costprice',array('required'=>TRUE )); ?>
        <?php echo $form->error($model,'cm_costprice'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_sellunit'); ?>
        <?php echo $form->dropDownList($model,'cm_sellunit', CHtml::listData(Codesparam::model()->findAll('cm_type="Unit Of Measurement"'), 'cm_code', 'cm_code'), array('empty'=>'- Select Sell Unit -', 'required'=>TRUE,)); ?>
        <?php echo $form->error($model,'cm_sellunit'); ?>
    </div>

</div>


<div style="float: left; width: 50%;">

    <div class="row">
        <?php echo $form->labelEx($model,'cm_sellconfact'); ?>
        <?php echo $form->textField($model,'cm_sellconfact',array('required'=>TRUE, 'placeholder'=>'Quantity should not be blank or zero')); ?>
        <?php echo $form->error($model,'cm_sellconfact'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_purunit'); ?>
        <?php echo $form->dropDownList($model,'cm_purunit', CHtml::listData(Codesparam::model()->findAll('cm_type="Unit Of Measurement"'), 'cm_code', 'cm_code'), array('empty'=>'- Select Purchase Unit -', 'required'=>TRUE,)); ?>
        <?php echo $form->error($model,'cm_purunit'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_purconfact'); ?>
        <?php echo $form->textField($model,'cm_purconfact',array('required'=>TRUE, 'placeholder'=>'Quantity should not be blank or zero')); ?>
        <?php echo $form->error($model,'cm_purconfact'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_stkunit'); ?>
        <?php echo $form->dropDownList($model,'cm_stkunit', CHtml::listData(Codesparam::model()->findAll('cm_type="Unit Of Measurement"'), 'cm_code', 'cm_code'), array('empty'=>'- Select Stock Unit -', 'required'=>TRUE,)); ?>
        <?php echo $form->error($model,'cm_stkunit'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'cm_stkconfac'); ?>
        <?php echo $form->textField($model,'cm_stkconfac',array('required'=>TRUE, 'placeholder'=>'Quantity should not be blank or zero')); ?>
        <?php echo $form->error($model,'cm_stkconfac'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_packsize'); ?>
        <?php echo $form->textField($model,'cm_packsize',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'cm_packsize'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_stocktype'); ?>
        <?php echo $form->dropDownList($model,'cm_stocktype', (array('Stock N Sell'=>'Stock N Sell','Non Stock'=>'Non Stock'))); ?>
        <?php echo $form->error($model,'cm_stocktype'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_generic'); ?>
        <?php echo $form->textField($model,'cm_generic',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'cm_generic'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_supplierid'); ?>
        <?php echo $form->textField($model,'cm_supplierid',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'cm_supplierid'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_mfgcode'); ?>
        <?php echo $form->textField($model,'cm_mfgcode',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'cm_mfgcode'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'cm_maxlevel'); ?>
        <?php //echo $form->textField($model,'cm_maxlevel'); ?>
        <?php //echo $form->error($model,'cm_maxlevel'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_minlevel'); ?>
        <?php echo $form->textField($model,'cm_minlevel'); ?>
        <?php echo $form->error($model,'cm_minlevel'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'cm_reorder'); ?>
        <?php //echo $form->textField($model,'cm_reorder'); ?>
        <?php //echo $form->error($model,'cm_reorder'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'inserttime'); ?>
        <?php echo $form->hiddenField($model,'inserttime'); ?>
        <?php //echo $form->error($model,'inserttime'); ?>
    </div>

    <div class="row">
        <?php // echo $form->labelEx($model,'updatetime'); ?>
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

</div>



            <?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
       

<?php $this->endWidget(); ?>

</div><!-- form -->


