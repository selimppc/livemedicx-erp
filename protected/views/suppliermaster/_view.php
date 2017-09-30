<?php
/* @var $this SuppliermasterController */
/* @var $data Suppliermaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_supplierid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cm_supplierid), array('view', 'id'=>$data->cm_supplierid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_group')); ?>:</b>
	<?php echo CHtml::encode($data->cm_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_orgname')); ?>:</b>
	<?php echo CHtml::encode($data->cm_orgname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_address')); ?>:</b>
	<?php echo CHtml::encode($data->cm_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_district')); ?>:</b>
	<?php echo CHtml::encode($data->cm_district); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_post')); ?>:</b>
	<?php echo CHtml::encode($data->cm_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_policest')); ?>:</b>
	<?php echo CHtml::encode($data->cm_policest); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_postcode')); ?>:</b>
	<?php echo CHtml::encode($data->cm_postcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_contactperson')); ?>:</b>
	<?php echo CHtml::encode($data->cm_contactperson); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_phone')); ?>:</b>
	<?php echo CHtml::encode($data->cm_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_cellphone')); ?>:</b>
	<?php echo CHtml::encode($data->cm_cellphone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_fax')); ?>:</b>
	<?php echo CHtml::encode($data->cm_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_email')); ?>:</b>
	<?php echo CHtml::encode($data->cm_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_url')); ?>:</b>
	<?php echo CHtml::encode($data->cm_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_status')); ?>:</b>
	<?php echo CHtml::encode($data->cm_status); ?>
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