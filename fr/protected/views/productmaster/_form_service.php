<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>
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


	<div class="row">
		<label>Code du Produit *</label>
		<?php echo $form->textField($model,'cm_code', array($model->isNewRecord ? '' : "readonly"=>True)); ?>
		<span style="color: #FF6600; float: left; margin-bottom: 5px;">
			<?php echo $model->isNewRecord ? 'Product code must be unique' : 'Product Code Can not be changed '?>
		</span>
		<?php echo $form->error($model,'cm_code'); ?>
	</div>

	<div class="row">
        <label>Nom du Produit  *</label>
		<?php echo $form->textField($model,'cm_name',array('required'=>TRUE )); ?>
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
		<?php  echo $form->textField($model,'cm_class', array('value'=>'SERVICE', 'readonly'=>TRUE,) ); ?>
		<?php echo $form->error($model,'cm_class'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_category'); ?>
        <?php echo $form->dropDownList($model,'cm_category', CHtml::listData(Codesparam::model()->findAll('cm_type="Product Category"'), 'cm_code', 'cm_code'), array('empty'=>'- Choisir la categorie du produit -', 'required'=>TRUE,)); ?>
        <?php echo $form->error($model,'cm_category'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'cm_group'); ?>
		<?php echo $form->dropDownList($model,'cm_group', CHtml::listData(Codesparam::model()->findAll('cm_type="Product Group"'), 'cm_code', 'cm_code'), array('empty'=>'- Choisir le groupe du produit -', 'required'=>TRUE,)); ?>
		<?php echo $form->error($model,'cm_group'); ?>
	</div>



            <div class="row">
                <?php echo $form->labelEx($model,'currency'); ?>
                <?php //echo $form->dropDownList($model,'pp_currency', CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description'), array('empty'=>'- Select Currency -', 'required'=>true, )); ?>
                <?php $currency= CHtml::listData(Currency::model()->findAll(), 'cm_currency', 'cm_description');
                echo $form->dropDownList($model,'currency', $currency, array('empty'=>'- Choisir le Devise -', 'required'=>TRUE,

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
        <?php echo $form->textField($model,'exchange_rate',array('id'=>'exchange_rate')); ?>
        <?php echo $form->error($model,'exchange_rate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'cm_sellrate'); ?>
        <?php echo $form->textField($model,'cm_sellrate',array('required'=>TRUE)); ?>
        <?php echo $form->error($model,'cm_sellrate'); ?>
    </div>


    <?php echo $form->hiddenField($model,'cm_sellrate', array('value'=>'0')); ?>
    <?php echo $form->hiddenField($model,'cm_costprice', array('value'=>'0')); ?>
    <?php echo $form->hiddenField($model,'cm_sellunit', array('value'=>'0')); ?>
    <?php echo $form->hiddenField($model,'cm_sellconfact', array('value'=>'0')); ?>
    <?php echo $form->hiddenField($model,'cm_purunit', array('value'=>'0')); ?>
    <?php echo $form->hiddenField($model,'cm_purconfact', array('value'=>'0')); ?>
    <?php echo $form->hiddenField($model,'cm_stkunit', array('value'=>'0')); ?>
    <?php echo $form->hiddenField($model,'cm_stkconfac', array('value'=>'0')); ?>


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
                        

        

	<div class="row buttons">
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Enter Service' : 'Update Service', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->