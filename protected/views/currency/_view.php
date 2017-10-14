<?php
/* @var $this CurrencyController */
/* @var $data Currency */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_currency')); ?>:</b>
	<?php echo CHtml::encode($data->cm_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_description')); ?>:</b>
	<?php echo CHtml::encode($data->cm_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_exchangerate')); ?>:</b>
	<?php echo CHtml::encode($data->cm_exchangerate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_active')); ?>:</b>
	<?php echo CHtml::encode($data->cm_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inserttime')); ?>:</b>
	<?php echo CHtml::encode($data->inserttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatetime')); ?>:</b>
	<?php echo CHtml::encode($data->updatetime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('insertuser')); ?>:</b>
	<?php echo CHtml::encode($data->insertuser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateuser')); ?>:</b>
	<?php echo CHtml::encode($data->updateuser); ?>
	<br />

	*/ ?>

</div>