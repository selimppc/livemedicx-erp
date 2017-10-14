<?php
/* @var $this TransferhdController */
/* @var $data Transferhd */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_transfernum')); ?>:</b>
	<?php echo CHtml::encode($data->im_transfernum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_date')); ?>:</b>
	<?php echo CHtml::encode($data->im_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_condate')); ?>:</b>
	<?php echo CHtml::encode($data->im_condate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_note')); ?>:</b>
	<?php echo CHtml::encode($data->im_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_fromstore')); ?>:</b>
	<?php echo CHtml::encode($data->im_fromstore); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_tostore')); ?>:</b>
	<?php echo CHtml::encode($data->im_tostore); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('im_status')); ?>:</b>
	<?php echo CHtml::encode($data->im_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inserttime')); ?>:</b>
	<?php echo CHtml::encode($data->inserttime); ?>
	<br />

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