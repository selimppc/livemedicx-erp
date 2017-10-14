<?php
/* @var $this ChartofaccountsController */
/* @var $data Chartofaccounts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_accountcode')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->am_accountcode), array('view', 'id'=>$data->am_accountcode)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_description')); ?>:</b>
	<?php echo CHtml::encode($data->am_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_accounttype')); ?>:</b>
	<?php echo CHtml::encode($data->am_accounttype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_accountusage')); ?>:</b>
	<?php echo CHtml::encode($data->am_accountusage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_groupone')); ?>:</b>
	<?php echo CHtml::encode($data->am_groupone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_grouptwo')); ?>:</b>
	<?php echo CHtml::encode($data->am_grouptwo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_groupthree')); ?>:</b>
	<?php echo CHtml::encode($data->am_groupthree); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('am_groupfour')); ?>:</b>
	<?php echo CHtml::encode($data->am_groupfour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_analyticalcode')); ?>:</b>
	<?php echo CHtml::encode($data->am_analyticalcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('am_branch')); ?>:</b>
	<?php echo CHtml::encode($data->am_branch); ?>
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