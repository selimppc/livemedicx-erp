<?php
/* @var $this BatchsaleController */
/* @var $data Batchsale */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_number')); ?>:</b>
	<?php echo CHtml::encode($data->sm_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_code')); ?>:</b>
	<?php echo CHtml::encode($data->cm_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_batchnumber')); ?>:</b>
	<?php echo CHtml::encode($data->sm_batchnumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_expdate')); ?>:</b>
	<?php echo CHtml::encode($data->sm_expdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_unit')); ?>:</b>
	<?php echo CHtml::encode($data->sm_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->sm_quantity); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_bonusqty')); ?>:</b>
	<?php echo CHtml::encode($data->sm_bonusqty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_rate')); ?>:</b>
	<?php echo CHtml::encode($data->sm_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_tax_rate')); ?>:</b>
	<?php echo CHtml::encode($data->sm_tax_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_tax_amt')); ?>:</b>
	<?php echo CHtml::encode($data->sm_tax_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_line_amt')); ?>:</b>
	<?php echo CHtml::encode($data->sm_line_amt); ?>
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