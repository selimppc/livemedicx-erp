<?php
/* @var $this AmdefaultController */
/* @var $data Amdefault */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_offset')); ?>:</b>
	<?php echo CHtml::encode($data->am_offset); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_pnlacount')); ?>:</b>
	<?php echo CHtml::encode($data->am_pnlacount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_year')); ?>:</b>
	<?php echo CHtml::encode($data->am_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_period')); ?>:</b>
	<?php echo CHtml::encode($data->am_period); ?>
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