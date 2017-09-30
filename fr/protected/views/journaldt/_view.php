<?php
/* @var $this JournaldtController */
/* @var $data Voucherdetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_vouchernumber')); ?>:</b>
	<?php echo CHtml::encode($data->am_vouchernumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_accountcode')); ?>:</b>
	<?php echo CHtml::encode($data->am_accountcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_subacccode')); ?>:</b>
	<?php echo CHtml::encode($data->am_subacccode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_currency')); ?>:</b>
	<?php echo CHtml::encode($data->am_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_exchagerate')); ?>:</b>
	<?php echo CHtml::encode($data->am_exchagerate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_primeamt')); ?>:</b>
	<?php echo CHtml::encode($data->am_primeamt); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('am_baseamt')); ?>:</b>
	<?php echo CHtml::encode($data->am_baseamt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_branch')); ?>:</b>
	<?php echo CHtml::encode($data->am_branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_note')); ?>:</b>
	<?php echo CHtml::encode($data->am_note); ?>
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