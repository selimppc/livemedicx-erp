<?php
/* @var $this PurchaseorddtController */
/* @var $data Purchaseorddt */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_purordnum')); ?>:</b>
	<?php echo CHtml::encode($data->pp_purordnum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_serialno')); ?>:</b>
	<?php echo CHtml::encode($data->pp_serialno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_code')); ?>:</b>
	<?php echo CHtml::encode($data->cm_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->pp_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_grnqty')); ?>:</b>
	<?php echo CHtml::encode($data->pp_grnqty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_unit')); ?>:</b>
	<?php echo CHtml::encode($data->pp_unit); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_unitqty')); ?>:</b>
	<?php echo CHtml::encode($data->pp_unitqty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_purchasrate')); ?>:</b>
	<?php echo CHtml::encode($data->pp_purchasrate); ?>
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