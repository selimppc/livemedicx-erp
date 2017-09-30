<?php
/* @var $this CompanyprofileController */
/* @var $data Companyprofile */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shortdescription')); ?>:</b>
	<?php echo CHtml::encode($data->shortdescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('longdescription')); ?>:</b>
	<?php echo CHtml::encode($data->longdescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::encode($data->photo); ?>
        <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/companyprofile/'.$data->photo, "photo",array("width"=>50)); ?>
	<br />


</div>