<?php
/* @var $this ItImtoapController */
/* @var $data ItImtoap */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_group')); ?>:</b>
	<?php echo CHtml::encode($data->item_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sup_group')); ?>:</b>
	<?php echo CHtml::encode($data->sup_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debit_account')); ?>:</b>
	<?php echo CHtml::encode($data->debit_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit_account')); ?>:</b>
	<?php echo CHtml::encode($data->credit_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
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