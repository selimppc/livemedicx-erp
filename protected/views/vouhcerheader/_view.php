<?php
/* @var $this VouhcerheaderController */
/* @var $data Vouhcerheader */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_vouchernumber')); ?>:</b>
	<?php echo CHtml::encode($data->am_vouchernumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_date')); ?>:</b>
	<?php echo CHtml::encode($data->am_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_referance')); ?>:</b>
	<?php echo CHtml::encode($data->am_referance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_year')); ?>:</b>
	<?php echo CHtml::encode($data->am_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_period')); ?>:</b>
	<?php echo CHtml::encode($data->am_period); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_branch')); ?>:</b>
	<?php echo CHtml::encode($data->am_branch); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('am_note')); ?>:</b>
	<?php echo CHtml::encode($data->am_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_status')); ?>:</b>
	<?php echo CHtml::encode($data->am_status); ?>
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