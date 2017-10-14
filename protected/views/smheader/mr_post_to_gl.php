<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
	'Money Receipt'=>array('smheader/adminmoneyreceipt'),
	'Post To GL',
);

$this->menu=array(
	array('label'=>'Manage Money Receipt', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/adminmoneyreceipt')),
	array('label'=>'Post to GL', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/post_gl_a.png" /></span>{menu}', 'url'=>array('smheader/mrPostToGl')),
	array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Money Receipt No', 'url'=>array('transaction/managemoneyreceiptno')),
	),
	),
);


?>

<style type="text/css">
#box_input_id{
	width: 99%; 
	float: left; 
	margin-bottom: -1px;
	margin-left: 1%;
}

#part_20 input{
	background: none;
	padding: 5px;
	width: 95%;
	color: #666;
}

#part_20 label, #part_50 label{
	font-size: 14px;
}
#part_50 textarea{
	background: none;
	padding: 3px;
	width: 99%;
	color: #666;
	font-size: 12px;
	height: 43px;
}
#part_20{
	width: 19%; 
	float: left;
	background: #FEFCE3;
	border-right: 1px solid #ccc;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 3px;
	line-height: 22px;
}
#part_20:hover{
	background: white;

}

#part_20 input:focus, #part_50 textarea:focus{ 
			background-color: white;
		}
.hr_input_field{
	width: 99%; 
	float: left; 
	background: none;
	padding: 2.5px;
	color: #666;
}
</style>


<div id="statusMsg">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-success").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-error").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

</div>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">Post To GL</div>
</div>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sm-header-form',
	'enableClientValidation'=>true,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php // echo $form->errorSummary($model); ?>
	
	
<div id="box_input_id">
	<div id="part_20">
		<label>Date: </label>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
			$this->widget('CJuiDateTimePicker',array(
				'model'=>$model,
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
			),
		));?> 
	</div>
	
</div>	
 
<div id="box_input_id">
	<div id="part_20">
		<label>Branch:  </label>
		<?php echo $form->dropDownList($model,'sm_territory', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'), array('class'=>'hr_input_field')); ?>
	</div>
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
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>20,'maxlength'=>20)); ?>
		<?php // echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<div class="row status-container">
          <div class="span4 action-bar">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Proceed' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
		  </div>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
