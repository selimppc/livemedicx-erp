<?php
/* @var $this PurchaseordhdController */
/* @var $data Purchaseordhd */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_purordnum')); ?>:</b>
	<?php echo CHtml::encode($data->pp_purordnum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_date')); ?>:</b>
	<?php echo CHtml::encode($data->pp_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_supplierid')); ?>:</b>
	<?php echo CHtml::encode($data->cm_supplierid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_requisitionno')); ?>:</b>
	<?php echo CHtml::encode($data->pp_requisitionno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_payterms')); ?>:</b>
	<?php echo CHtml::encode($data->pp_payterms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_deliverydate')); ?>:</b>
	<?php echo CHtml::encode($data->pp_deliverydate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_store')); ?>:</b>
	<?php echo CHtml::encode($data->pp_store); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_taxrate')); ?>:</b>
	<?php echo CHtml::encode($data->pp_taxrate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_taxamt')); ?>:</b>
	<?php echo CHtml::encode($data->pp_taxamt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_discrate')); ?>:</b>
	<?php echo CHtml::encode($data->pp_discrate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_discamt')); ?>:</b>
	<?php echo CHtml::encode($data->pp_discamt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_amount')); ?>:</b>
	<?php echo CHtml::encode($data->pp_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pp_status')); ?>:</b>
	<?php echo CHtml::encode($data->pp_status); ?>
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