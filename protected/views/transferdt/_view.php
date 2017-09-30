<?php
/* @var $this TransferdtController */
/* @var $data Transferdt */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_transfernum')); ?>:</b>
	<?php echo CHtml::encode($data->im_transfernum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_code')); ?>:</b>
	<?php echo CHtml::encode($data->cm_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_unit')); ?>:</b>
	<?php echo CHtml::encode($data->im_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->im_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_rate')); ?>:</b>
	<?php echo CHtml::encode($data->im_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inserttime')); ?>:</b>
	<?php echo CHtml::encode($data->inserttime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updatetime')); ?>:</b>
	<?php echo CHtml::encode($data->updatetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insertuser')); ?>:</b>
	<?php echo CHtml::encode($data->insertuser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateuser')); ?>:</b>
	<?php echo CHtml::encode($data->updateuser); ?>
	<br />

	*/ ?>

</div>