<?php
/* @var $this CustomermstController */
/* @var $data Customermst */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_cuscode')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cm_cuscode), array('view', 'id'=>$data->cm_cuscode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_name')); ?>:</b>
	<?php echo CHtml::encode($data->cm_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_address')); ?>:</b>
	<?php echo CHtml::encode($data->cm_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_territory')); ?>:</b>
	<?php echo CHtml::encode($data->cm_territory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_cellnumber')); ?>:</b>
	<?php echo CHtml::encode($data->cm_cellnumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_phone')); ?>:</b>
	<?php echo CHtml::encode($data->cm_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_fax')); ?>:</b>
	<?php echo CHtml::encode($data->cm_fax); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_email')); ?>:</b>
	<?php echo CHtml::encode($data->cm_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_branch')); ?>:</b>
	<?php echo CHtml::encode($data->cm_branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_market')); ?>:</b>
	<?php echo CHtml::encode($data->cm_market); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_sp')); ?>:</b>
	<?php echo CHtml::encode($data->cm_sp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_creditlimit')); ?>:</b>
	<?php echo CHtml::encode($data->cm_creditlimit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_hub')); ?>:</b>
	<?php echo CHtml::encode($data->cm_hub); ?>
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