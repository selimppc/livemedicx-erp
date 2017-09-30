<?php
/* @var $this SmheaderController */
/* @var $data Smheader */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_number')); ?>:</b>
	<?php echo CHtml::encode($data->sm_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_date')); ?>:</b>
	<?php echo CHtml::encode($data->sm_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cm_cuscode')); ?>:</b>
	<?php echo CHtml::encode($data->cm_cuscode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_sp')); ?>:</b>
	<?php echo CHtml::encode($data->sm_sp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_doc_type')); ?>:</b>
	<?php echo CHtml::encode($data->sm_doc_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_territory')); ?>:</b>
	<?php echo CHtml::encode($data->sm_territory); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_rsm')); ?>:</b>
	<?php echo CHtml::encode($data->sm_rsm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_area')); ?>:</b>
	<?php echo CHtml::encode($data->sm_area); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_payterms')); ?>:</b>
	<?php echo CHtml::encode($data->sm_payterms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_totalamt')); ?>:</b>
	<?php echo CHtml::encode($data->sm_totalamt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_total_tax_amt')); ?>:</b>
	<?php echo CHtml::encode($data->sm_total_tax_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_disc_rate')); ?>:</b>
	<?php echo CHtml::encode($data->sm_disc_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_disc_amt')); ?>:</b>
	<?php echo CHtml::encode($data->sm_disc_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_netamt')); ?>:</b>
	<?php echo CHtml::encode($data->sm_netamt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_sign')); ?>:</b>
	<?php echo CHtml::encode($data->sm_sign); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_stataus')); ?>:</b>
	<?php echo CHtml::encode($data->sm_stataus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sm_refe_code')); ?>:</b>
	<?php echo CHtml::encode($data->sm_refe_code); ?>
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