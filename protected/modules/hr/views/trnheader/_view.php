<?php
/* @var $this TrnheaderController */
/* @var $data Trnheader */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trnnumber')); ?>:</b>
	<?php echo CHtml::encode($data->trnnumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trndate')); ?>:</b>
	<?php echo CHtml::encode($data->trndate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trnyear')); ?>:</b>
	<?php echo CHtml::encode($data->trnyear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trnperiod')); ?>:</b>
	<?php echo CHtml::encode($data->trnperiod); ?>
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