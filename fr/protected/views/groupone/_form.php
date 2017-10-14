<?php
/* @var $this GrouponeController */
/* @var $model Groupone */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .link-column a{
        text-decoration: none;
        color: #000000;
    }
    .link-column a:hover{
        text-decoration: underline;
        color: blue;
        font-weight: bold;
    }
</style>
<div style="width: 98%; float: left;"> 
	<div style="width: 45%; float: left;"> 

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groupone-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'am_groupone'),
)); ?>

    <h1 style="background: #FFCCFF; padding: 7px; width: 90%; text-align: center;">
        Enter Account Group Information
    </h1>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'am_groupone'); ?>
		<?php echo $form->textField($model,'am_groupone', array($model->isNewRecord ? '' : "readonly"=>True)); ?>
		<?php echo $form->error($model,'am_groupone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_description'); ?>
		<?php echo $form->textField($model,'am_description',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'am_description'); ?>
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

        <div style="width: 90%; float: left;">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'New Account Group ' : 'Update Account Group', array('class'=>'btn_btn', 'name' => 'submit')); ?>
        </div>

        <div style="width: 10%; float: left;">
            <?php //echo CHtml::submitButton($model->isNewRecord ? 'Account Sub-Group ' : 'Account Sub-Group', array('class'=>'btn_btn','name' => 'proceed')); ?>
        </div>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>

<div style="width: 50%; float: left; margin-left: 5%; line-height: 6px;">

    <h1 style="background: #FFCCFF; padding: 15px; width: 93%; text-align: center;">
        Account Group Detail
    </h1>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'groupone-grid',
			'dataProvider'=>Groupone::model()->search(),
			//'filter'=>$model,
			'columns'=>array(
				//'id',
                array(
                    'class'=>'CLinkColumn',
                    'header'=>'Account Group Code ',
                    'labelExpression'=>'$data->am_groupone',
                    'urlExpression'=>'array("grouptwo/create", "group1"=>$data->am_groupone )',
                ),
                array(
                    'class'=>'CLinkColumn',
                    'header'=>'Account Group Name',
                    'labelExpression'=>'$data->am_description',
                    'urlExpression'=>'array("grouptwo/create", "group1"=>$data->am_groupone )',
                ),
                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
                ),
			),
		)); ?>


	</div>

</div>