<?php
/* @var $this ItimtoglController */
/* @var $data Itimtogl */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_branch')); ?>:</b>
	<?php echo CHtml::encode($data->c_branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_trncode')); ?>:</b>
	<?php echo CHtml::encode($data->c_trncode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_group')); ?>:</b>
	<?php echo CHtml::encode($data->c_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_accdr')); ?>:</b>
	<?php echo CHtml::encode($data->c_accdr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_acccr')); ?>:</b>
	<?php echo CHtml::encode($data->c_acccr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inserttime')); ?>:</b>
	<?php echo CHtml::encode($data->inserttime); ?>
	<br />

	<?php /*
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