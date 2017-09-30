<?php
/* @var $this BranchmasterController */
/* @var $data Branchmaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_branch')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cm_branch), array('view', 'id'=>$data->cm_branch)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_description')); ?>:</b>
	<?php echo CHtml::encode($data->cm_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_contacperson')); ?>:</b>
	<?php echo CHtml::encode($data->cm_contacperson); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_designation')); ?>:</b>
	<?php echo CHtml::encode($data->cm_designation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_mailingaddress')); ?>:</b>
	<?php echo CHtml::encode($data->cm_mailingaddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_phone')); ?>:</b>
	<?php echo CHtml::encode($data->cm_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_cell')); ?>:</b>
	<?php echo CHtml::encode($data->cm_cell); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_fax')); ?>:</b>
	<?php echo CHtml::encode($data->cm_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
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