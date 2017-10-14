<?php
/* @var $this ProductmasterController */
/* @var $data Productmaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_code')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cm_code), array('view', 'id'=>$data->cm_code)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_name')); ?>:</b>
	<?php echo CHtml::encode($data->cm_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_description')); ?>:</b>
	<?php echo CHtml::encode($data->cm_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_class')); ?>:</b>
	<?php echo CHtml::encode($data->cm_class); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_group')); ?>:</b>
	<?php echo CHtml::encode($data->cm_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_category')); ?>:</b>
	<?php echo CHtml::encode($data->cm_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_sellrate')); ?>:</b>
	<?php echo CHtml::encode($data->cm_sellrate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_costprice')); ?>:</b>
	<?php echo CHtml::encode($data->cm_costprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_sellunit')); ?>:</b>
	<?php echo CHtml::encode($data->cm_sellunit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_sellconfact')); ?>:</b>
	<?php echo CHtml::encode($data->cm_sellconfact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_purunit')); ?>:</b>
	<?php echo CHtml::encode($data->cm_purunit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_purconfact')); ?>:</b>
	<?php echo CHtml::encode($data->cm_purconfact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_stkunit')); ?>:</b>
	<?php echo CHtml::encode($data->cm_stkunit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_stkconfac')); ?>:</b>
	<?php echo CHtml::encode($data->cm_stkconfac); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_packsize')); ?>:</b>
	<?php echo CHtml::encode($data->cm_packsize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_stocktype')); ?>:</b>
	<?php echo CHtml::encode($data->cm_stocktype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_generic')); ?>:</b>
	<?php echo CHtml::encode($data->cm_generic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_supplierid')); ?>:</b>
	<?php echo CHtml::encode($data->cm_supplierid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_mfgcode')); ?>:</b>
	<?php echo CHtml::encode($data->cm_mfgcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_maxlevel')); ?>:</b>
	<?php echo CHtml::encode($data->cm_maxlevel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_minlevel')); ?>:</b>
	<?php echo CHtml::encode($data->cm_minlevel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_reorder')); ?>:</b>
	<?php echo CHtml::encode($data->cm_reorder); ?>
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