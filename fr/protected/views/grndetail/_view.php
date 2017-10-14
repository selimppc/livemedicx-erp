<?php
/* @var $this GrndetailController */
/* @var $data Grndetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_grnnumber')); ?>:</b>
	<?php echo CHtml::encode($data->im_grnnumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_code')); ?>:</b>
	<?php echo CHtml::encode($data->cm_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_BatchNumber')); ?>:</b>
	<?php echo CHtml::encode($data->im_BatchNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_ExpireDate')); ?>:</b>
	<?php echo CHtml::encode($data->im_ExpireDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_RcvQuantity')); ?>:</b>
	<?php echo CHtml::encode($data->im_RcvQuantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_costprice')); ?>:</b>
	<?php echo CHtml::encode($data->im_costprice); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('im_unit')); ?>:</b>
	<?php echo CHtml::encode($data->im_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_unitqty')); ?>:</b>
	<?php echo CHtml::encode($data->im_unitqty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('im_rowamount')); ?>:</b>
	<?php echo CHtml::encode($data->im_rowamount); ?>
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