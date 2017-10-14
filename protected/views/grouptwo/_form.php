<?php
/* @var $this GrouptwoController */
/* @var $model Grouptwo */
/* @var $form CActiveForm */
?>

<div style="width: 98%; float: left;"> 
	<div style="width: 45%; float: left;"> 
	
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grouptwo-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'am_grouptwo'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'am_groupone'); ?>
		<?php // echo $form->textField($model,'am_groupone', array('readonly'=>'readonly')); ?>
        <?php echo $form->dropDownList($model,'am_groupone', CHtml::listData(Groupone::model()->findAll("am_groupone='$group1'"), 'am_groupone', 'am_description') ); ?>
		<?php echo $form->error($model,'am_groupone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_grouptwo'); ?>
		<?php echo $form->textField($model,'am_grouptwo', array($model->isNewRecord ? '' : "readonly"=>True)); ?>
		<?php echo $form->error($model,'am_grouptwo'); ?>
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
		<?php // echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Enter Sub Group ' : 'Update Sub Group', array('class'=>'btn_btn', 'name' => 'submit')); ?>
				<?php // echo CHtml::submitButton($model->isNewRecord ? 'Proceed' : 'Proceed', array('class'=>'action-btn', 'id'=>'action-btn-1', 'name' => 'proceed')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>

<div style="width: 50%; float: left; margin-left: 5%; line-height: 6px;">
    <h1 style="background: #FFCCFF; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
        Sub Group Details
    </h1>

	
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'grouptwo-grid',
			'dataProvider'=>Grouptwo::model()->search($group1),
			//'filter'=>$model,
			'columns'=>array(
				//'id',
				'am_groupone',
                //array( 'name'=>'group_one_search', 'value'=>'Grouptwo::model()->am_description' ),
				'am_grouptwo',
				'am_description',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'label'=>'update',

                            'url'=>'Yii::app()->createUrl("grouptwo/update/", array("id"=>$data->id, "group1"=>$data->am_groupone))',
                            //'click'=>'function(){var rowIdx=$(this).closest("tr").attr("sectionRowIndex");var rowId=$("#"+$(this).closest("div.grid-view").attr("id")+" > div.keys > span:eq("+rowIdx+")").text();alert(rowId);}',

                        ),

                    ),
                ),
			),
		)); ?>
	</div>

</div>