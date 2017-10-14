<?php
/* @var $this AdjustdtController */
/* @var $data Adjustdt */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_number')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_code')); ?>:</b>
	<?php echo CHtml::encode($data->product_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_number')); ?>:</b>
	<?php echo CHtml::encode($data->batch_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expirry_date')); ?>:</b>
	<?php echo CHtml::encode($data->expirry_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stock_rate')); ?>:</b>
	<?php echo CHtml::encode($data->stock_rate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('inserttime')); ?>:</b>
	<?php echo CHtml::encode($data->inserttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insertuser')); ?>:</b>
	<?php echo CHtml::encode($data->insertuser); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatetime')); ?>:</b>
	<?php echo CHtml::encode($data->updatetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateuser')); ?>:</b>
	<?php echo CHtml::encode($data->updateuser); ?>
	<br />

	*/ ?>

</div>