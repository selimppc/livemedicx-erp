<?php
/* @var $this RequisitiondtController */
/* @var $data Requisitiondt */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_requisitionno')); ?>:</b>
	<?php echo CHtml::encode($data->pp_requisitionno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_code')); ?>:</b>
	<?php echo CHtml::encode($data->cm_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_unit')); ?>:</b>
	<?php echo CHtml::encode($data->pp_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->pp_quantity); ?>
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