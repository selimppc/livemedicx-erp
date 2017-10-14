<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */
/* @var $form CActiveForm */
?>

<style type="text/css">
table td, th
{
	border: 1px solid #4E8EC2;
}

</style>


<div style="width: 98%; float: left;" >

	<div style="width: 50%; float: left;" >



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'it-imtoap-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	//'focus'=>array($model,'am_vouchernumber'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>




<table>
	<tr> 
		<td colspan="2" style="text-align: center; background: #4085BB; color: white;"> 
			IM to AP
		</td>
	</tr>
	
	<tr>
		<td> 
			Item Group
		</td>
		<td> 
			Supplier Group
		</td>
	</tr>
	<tr>
		<td> 
			<?php echo $form->dropDownList($model,'item_group', CHtml::listData(Codesparam::model()->findAll('cm_type = "Product Group" '),'cm_code','cm_code'), array('style'=>'width: 230px;')); ?>
		</td>
		<td> 
			<?php echo $form->dropDownList($model,'sup_group', CHtml::listData(Codesparam::model()->findAll('cm_type = "Supplier Group" '),'cm_code','cm_code'), array('style'=>'width: 230px;')); ?>
		</td>
	</tr>
	
	<tr>
		<td> 
			Debit Account
		</td>
		<td> 
			<?php // echo $form->textField($model,'debit_account',array('size'=>50,'maxlength'=>50)); ?>
			<?php 
					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'name'=>'debit_account',
						'model'=>$model,
						'attribute'=>'debit_account',
						'source'=>CController::createUrl('/itimtoap/getim'),
						'options'=>array(
							'minLength'=>'1', 
							'select'=>'js:function(event, ui){
								$("#debit_account").val(ui.item.value);
							}'
						),
						'htmlOptions'=>array(
							'id'=>'debit_account',
							'style'=>'width: 230px;',
							'placeholder'=>'search by account..',
						),
					));
				?> 
		</td>
	</tr>

</table>





	<div class="row">
		<?php //echo $form->labelEx($model,'item_group'); ?>
		<?php //echo $form->textField($model,'item_group',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'item_group'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'sup_group'); ?>
		<?php //echo $form->textField($model,'sup_group',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'sup_group'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'debit_account'); ?>
		<?php //echo $form->textField($model,'debit_account',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'debit_account'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'credit_account'); ?>
		<?php //echo $form->textField($model,'credit_account',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'credit_account'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'active'); ?>
		<?php echo $form->hiddenField($model,'active'); ?>
		<?php //echo $form->error($model,'active'); ?>
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
			 <?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
		  </div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

	</div>
	
	<div style="width: 49%; float: left; line-height: 8px;" >



<h1>List (IM to AP)</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'it-imtoap-grid',
	'dataProvider'=>ItImtoap::model()->search(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'item_group',
		'sup_group',
		//'debit_account',
        'am_description',
		//'credit_account',
		'active',

	array(
			'class'=>'CButtonColumn',
			'header' => 'Action',
			'template' => '{update}',
		),
	),
)); ?>


	</div>

</div>