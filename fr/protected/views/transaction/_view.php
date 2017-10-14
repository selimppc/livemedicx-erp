<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<div class="view">
	<b>
	<?php echo CHtml::link(">> ", array('view', 
	'cm_type'=>$data->cm_type, 'cm_trncode'=>$data->cm_trncode)); ?><br/></b>
	
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_type')); ?>:</b>
	<?php echo CHtml::encode($data->cm_type); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_trncode')); ?>:</b>
	<?php echo CHtml::encode($data->cm_trncode); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_branch')); ?>:</b>
	<?php echo CHtml::encode($data->cm_branch); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_lastnumber')); ?>:</b>
	<?php echo CHtml::encode($data->cm_lastnumber); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_increment')); ?>:</b>
	<?php echo CHtml::encode($data->cm_increment); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_active')); ?>:</b>
	<?php echo CHtml::encode($data->cm_active); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('inserttime')); ?>:</b>
	<?php echo CHtml::encode($data->inserttime); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('updatetime')); ?>:</b>
	<?php echo CHtml::encode($data->updatetime); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('insertuser')); ?>:</b>
	<?php echo CHtml::encode($data->insertuser); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('updateuser')); ?>:</b>
	<?php echo CHtml::encode($data->updateuser); ?><br />
</div>
