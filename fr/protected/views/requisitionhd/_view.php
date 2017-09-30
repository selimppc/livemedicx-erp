<?php
/* @var $this RequisitionhdController */
/* @var $data Requisitionhd */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_requisitionno')); ?>:</b>
	<?php echo CHtml::encode($data->pp_requisitionno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_supplierid')); ?>:</b>
	<?php echo CHtml::encode($data->cm_supplierid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_date')); ?>:</b>
	<?php echo CHtml::encode($data->pp_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_branch')); ?>:</b>
	<?php echo CHtml::encode($data->pp_branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_note')); ?>:</b>
	<?php echo CHtml::encode($data->pp_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_status')); ?>:</b>
	<?php echo CHtml::encode($data->pp_status); ?>
	<br />

	<?php /*
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