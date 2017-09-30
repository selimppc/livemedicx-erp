
<style type="text/css">
#part_20 input{
	background: none;
	padding: 5px;
	width: 95%;
	color: #666;
}

#part_20 label, #part_50 label{
	font-size: 14px;
}
#part_50 textarea{
	background: none;
	padding: 3px;
	width: 99%;
	color: #666;
	font-size: 12px;
	height: 43px;
}
#part_40 textarea{
	background: none;
	padding: 3px;
	width: 99%;
	color: #666;
	font-size: 12px;
	height: 13px;
}

#part_20{
	width: 19%; 
	float: left;
	background: #FEFCE3;
	border-right: 1px solid #ccc;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 3px;
	line-height: 22px;
}
#part_20:hover{
	background: white;

}

#part_20 input:focus, #part_50 textarea:focus{ 
			background-color: white;
		}
		
#part_50{
	width: 48.5%; 
	float: left;
	background: #FEFCE3;
	border-right: 1px solid #ccc;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 3px;
	line-height: 22px;
}
#part_50:hover{
	background: white;

}

#part_40{
	width: 38.5%; 
	float: left;
	background: #FEFCE3;
	border-right: 1px solid #ccc;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	padding: 3.5px;
	line-height: 22px;
}
#part_40:hover{
	background: white;

}

#box_input_id{
	width: 99%; 
	float: left; 
	margin-bottom: -1px;
	margin-left: 1%;
}
.hr_input_field, #Personalinfo_currency, #Personalinfo_branch{
	width: 99%; 
	float: left; 
	background: none;
	padding: 2.5px;
	color: #666;
}
.ui-datepicker-trigger{
	text-align: right;
	margin-left: 45px;
}

.compactRadioGroup LABEL, .compactRadioGroup INPUT {
	padding: 1em;
    display: inline !important;
    width: auto !important;    
}
#Customermst_c_status_0{
	margin-top: 40px;
}
#Customermst_c_status_1{
	margin-top: 40px;
}
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'client-account-create-form',
    'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,'cm_code'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php // echo $form->errorSummary($model); ?>

<div id="box_input_id">
	<div id="part_20">
		<?php echo $form->labelEx($model,'cm_type'); ?>
        <?php echo $form->textField($model,'cm_type', array('readonly' => 'true')); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model,'cm_code'); ?>
        <?php echo $form->textField($model,'cm_code', array('style' => 'text-transform: uppercase')); ?>
	</div>
	
</div>
    
<div id="box_input_id">
	<div id="part_20">
		<?php echo $form->labelEx($model,'cm_desc'); ?>
        <?php echo $form->textField($model,'cm_desc'); ?>
	</div>
	<div id="part_20">
		<?php echo $form->labelEx($model,'cm_active'); ?>
        <?php echo $form->dropDownList($model,'cm_active', $this->getActiveOptions(), array('class'=>'hr_input_field')); ?>
	</div>
</div>

	
	
	
    <div class="row">
        <?php // echo $form->labelEx($model,'inserttime'); ?>
        <?php echo $form->hiddenField($model,'inserttime'); ?>
        <?php // echo $form->error($model,'inserttime'); ?>
    </div>
	
	
    <div class="row">
        <?php // echo $form->labelEx($model,'updatetime'); ?>
        <?php echo $form->hiddenField($model,'updatetime'); ?>
        <?php // echo $form->error($model,'updatetime'); ?>
    </div>
	
	
    <div class="row">
        <?php // echo $form->labelEx($model,'insertuser'); ?>
        <?php echo $form->hiddenField($model,'insertuser'); ?>
        <?php // echo $form->error($model,'insertuser'); ?>
    </div>
	
	
    <div class="row">
        <?php // echo $form->labelEx($model,'updateuser'); ?>
        <?php echo $form->hiddenField($model,'updateuser'); ?>
        <?php // echo $form->error($model,'updateuser'); ?>
    </div>
	
    <div class="row buttons">
    	<div class="row status-container">
                <div class="span4 action-bar">
        			<?php echo CHtml::submitButton('Submit', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
        		</div>
		</div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form --> 
