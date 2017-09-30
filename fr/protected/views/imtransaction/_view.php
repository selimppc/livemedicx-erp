<?php
/* @var $this ImtransactionController */
/* @var $data Imtransaction */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_number')); ?>:</b>
	<?php echo CHtml::encode($data->im_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_code')); ?>:</b>
	<?php echo CHtml::encode($data->cm_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_storeid')); ?>:</b>
	<?php echo CHtml::encode($data->im_storeid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_BatchNumber')); ?>:</b>
	<?php echo CHtml::encode($data->im_BatchNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_date')); ?>:</b>
	<?php echo CHtml::encode($data->im_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_ExpireDate')); ?>:</b>
	<?php echo CHtml::encode($data->im_ExpireDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('im_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->im_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_sign')); ?>:</b>
	<?php echo CHtml::encode($data->im_sign); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_unit')); ?>:</b>
	<?php echo CHtml::encode($data->im_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_rate')); ?>:</b>
	<?php echo CHtml::encode($data->im_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_totalprice')); ?>:</b>
	<?php echo CHtml::encode($data->im_totalprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_RefNumber')); ?>:</b>
	<?php echo CHtml::encode($data->im_RefNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_RefRow')); ?>:</b>
	<?php echo CHtml::encode($data->im_RefRow); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_note')); ?>:</b>
	<?php echo CHtml::encode($data->im_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_status')); ?>:</b>
	<?php echo CHtml::encode($data->im_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_voucherno')); ?>:</b>
	<?php echo CHtml::encode($data->im_voucherno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_supplierid')); ?>:</b>
	<?php echo CHtml::encode($data->cm_supplierid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_currency')); ?>:</b>
	<?php echo CHtml::encode($data->im_currency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_ExchangeRate')); ?>:</b>
	<?php echo CHtml::encode($data->im_ExchangeRate); ?>
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