<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<div class="view">
	<b>
	<?php echo CHtml::link(">> ", array('view', 
	'cm_type'=>$data->cm_type, 'cm_code'=>$data->cm_code)); ?><br/></b>
	
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_type')); ?>:</b>
	<?php echo CHtml::encode($data->cm_type); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_code')); ?>:</b>
	<?php echo CHtml::encode($data->cm_code); ?><br />
	
    <b><?php echo CHtml::encode($data->getAttributeLabel('cm_desc')); ?>:</b>
	<?php echo CHtml::encode($data->cm_desc); ?><br />
	
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
