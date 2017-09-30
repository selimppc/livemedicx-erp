<?php
/* @var $this CustomermstController */
/* @var $model Customermst */
/* @var $form CActiveForm */
?>

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
    #part_20 textarea{
        background: none;
        padding: 1px;
        width: 99%;
        color: #666;
        font-size: 12px;
        height: 18px;
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
        
        border-right: 1px solid #ccc;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        padding: 3px;
        
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
        
        border-right: 1px solid #ccc;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        padding: 3px;
       
    }
    #part_50:hover{
        background: white;

    }

    #part_40{
        width: 38.5%;
        float: left;
        
        border-right: 1px solid #ccc;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        padding: 3.5px;
        
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
<div class="form" style="width: 100%; float: left;">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'customermst-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'focus'=>array($model,'cm_name'),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <div id="box_input_id">
        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_group'); ?>
            <?php echo $form->dropDownList($model,'cm_group', CHtml::listData(Codesparam::model()->findAll('cm_type="Customer Group"'),'cm_code','cm_code'), array('class'=>'hr_input_field')); ?>
        </div>
        <div id="part_240">
            <?php //echo $form->labelEx($model,'cm_cuscode'); ?>
            <?php //echo $form->textField($model,'cm_cuscode', array("readonly"=>True, 'style'=>$model->isNewRecord ? 'background: #efefef':'',)); ?>
        </div>
        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_name'); ?>
            <?php echo $form->textField($model,'cm_name', array("required"=>TRUE )); ?>
        </div>

        <div id="part_20">
            <?php echo $form->labelEx($model,'gerant_id'); ?>
            <?php echo $form->textField($model,'gerant_id', array('onchange'=>"gerandIDs()", 'id'=>'gerand-id' )); ?>

            <?php echo $form->hiddenField($model,'is_gerant', array('id'=>'is-gerand' )); ?>
        </div>
        <script type="text/javascript">
            function gerandIDs(){
                var a = document.getElementById("gerand-id").value;
                if( a != ''){
                    document.getElementById("is-gerand").value = 1;
                }else{
                    document.getElementById("is-gerand").value = 0;
                }
            }
        </script>

        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_phone'); ?>
            <?php echo $form->textField($model,'cm_phone'); ?>
        </div>

    </div>

    <div id="box_input_id">
        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_fax'); ?>
            <?php echo $form->textField($model,'cm_fax'); ?>
        </div>
        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_address'); ?>
            <?php echo $form->textArea($model,'cm_address'); ?>
        </div>
        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_email'); ?>
            <?php echo $form->textField($model,'cm_email', array("required"=>TRUE )); ?>
        </div>

        <div id="part_20">
            <label>Country Code:</label>
            <?php echo $form->hiddenField($model,'country_code', array("readonly"=>TRUE)); ?>
        </div>


    </div>

    <div id="box_input_id">
        <div id="part_20">
            <?php // echo $form->labelEx($model,'cm_branch'); ?>
            <?php // echo $form->dropDownList($model,'cm_branch', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'), array('class'=>'hr_input_field')); ?>
            <label><span style="color: red;">Select District *</span> </label>
            <?php echo $form->dropDownList($model,'cm_territory', CHtml::listData(Codesparam::model()->findAll('cm_type="District Code"'),'cm_code','cm_desc'), array('class'=>'hr_input_field')); ?>
        </div>
        <div id="part_20">
            <?php echo $form->labelEx($model,'c_type'); ?>
            <?php echo $form->dropDownList($model,'c_type', array('Credit'=>'Credit','General'=>'General'), array('class'=>'hr_input_field')); ?>
        </div>

        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_cellnumber'); ?>
            <?php echo $form->textField($model,'cm_cellnumber'); ?>
        </div>
		
		<!-- This part did by amit-->
		<div id="part_20">
			<label>Branch </label>
			<?php echo $form->dropDownList($model,'cm_branch', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_branch'), array('class'=>'hr_input_field', 'required'=>TRUE)); ?>
			<?php echo $form->error($model,'sm_storeid'); ?>
		</div>
		
        <!--div id="part_20">
            <?php //echo $form->labelEx($model,'cm_market'); ?>
            <?php //echo $form->dropDownList($model,'cm_market', CHtml::listData(Codesparam::model()->findAll('cm_type="Market"'),'cm_code','cm_desc'), array('class'=>'hr_input_field')); ?>
        </div-->

    </div>


    <div id="box_input_id">
        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_sp'); ?>
            <?php echo $form->textField($model,'cm_sp'); ?>
        </div>
        <div id="part_20">
            <?php echo $form->labelEx($model,'cm_creditlimit'); ?>
            <?php echo $form->textField($model,'cm_creditlimit', array('value'=>'0.00', 'style'=>'text-align: right;') ); ?>
        </div>
        <div id="part_40" class="compactRadioGroup">
            <?php echo $form->labelEx($model,'c_status'); ?>
            <?php echo $form->radioButtonList($model,'c_status', array('Open'=>'Open','Close'=>'Close'),
                array('separator'=>'', 'labelOptions'=>array('style'=>'display:inline; margin: 36px 25px 0px 0px; padding: 0px 0px 0px 3px;'))); ?>
        </div>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'inserttime'); ?>
        <?php echo $form->hiddenField($model,'inserttime'); ?>
        <?php //echo $form->error($model,'inserttime'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'updatetime'); ?>
        <?php echo $form->hiddenField($model,'updatetime'); ?>
        <?php //echo $form->error($model,'updatetime'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'insertuser'); ?>
        <?php echo $form->hiddenField($model,'insertuser' ); ?>
        <?php //echo $form->error($model,'insertuser'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'updateuser'); ?>
        <?php echo $form->hiddenField($model,'updateuser'); ?>
        <?php //echo $form->error($model,'updateuser'); ?>
    </div>

    <div class="row buttons">
        <div class="row status-container">
            <div class="span4 action-bar">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->