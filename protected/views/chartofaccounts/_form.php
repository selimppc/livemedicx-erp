<?php
/* @var $this ChartofaccountsController */
/* @var $model Chartofaccounts */
/* @var $form CActiveForm */
?>
<style type="text/css">
table .money-receipt-sales, td
{
	border: 1px solid #4E8EC2;
}
.compactRadioGroup LABEL, .compactRadioGroup INPUT {
	padding-left: 1em;
    display: inline !important;
    width: auto !important;    
}
</style>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chartofaccounts-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	//'focus'=>array($model,'am_accountcode'),
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>



<table style="width: 99%; float: left;">
	<tr> 
		<td colspan="2" style="text-align: center; background: #4085BB; color: white;"> Chart of Accounts  </td>
	</tr>
	<tr>
		<td width="140">Account Code <span class="required">*</span></td>
		<td> <?php echo $form->textField($model,'am_accountcode',  array($model->isNewRecord ? '' : "readonly"=>True, 'required'=>TRUE)); ?> <?php echo $form->error($model,'am_accountcode'); ?></td>
	</tr>
	<tr>	
		<td> Description <span class="required">*</span></td>
		<td> <?php echo $form->textField($model,'am_description', array('required'=>TRUE)); ?>
            <?php echo $form->error($model,'am_description'); ?>
        </td>
	</tr>
	
	<tr>
		<td> Account Type </td>
		<td class="compactRadioGroup"> 
			<?php // echo $form->radioButtonList($model,'am_accounttype', $model->getAccountType()); ?>
			<?php echo  $form->radioButtonList($model,'am_accounttype',array('Asset'=>'Asset','Liability'=>'Liability', 'Income'=>'Income', 'Expenses'=>'Expenses'), array('separator'=>'', 'labelOptions'=>array('style'=>'display:inline; margin: -5px 25px 0px 0px; padding: 0px 0px 0px 3px; '), 'required'=>TRUE)); ?>
		</td>
		
	</tr>
	<tr>
		<td> Account Usage </td>
		<td class="compactRadioGroup"> <?php //echo $form->radioButtonList($model,'am_accountusage',array('Ledger'=>'Ledger','AP'=>'AP', 'AR'=>'AR')); ?> 
		<?php echo  $form->radioButtonList($model,'am_accountusage',array('Ledger'=>'Ledger','AP'=>'AP', 'AR'=>'AR'), array('separator'=>'', 'labelOptions'=>array('style'=>'display:inline; margin: -5px 25px 0px 0px; padding: 0px 0px 0px 3px;'), 'required'=>TRUE)); ?>
		<?php // echo $form->radioButtonList($model,'am_accountusage', $model->getAccountUsage()); ?>
		</td>
	</tr>
	
	<tr>
		<td>First Group </td>
		<td> <?php 
				$groupone = CHtml::listData(Groupone::model()->findAll(),'am_groupone','am_description'); 
				echo $form->DropDownList($model,'am_groupone',$groupone,
					array(
                        'prompt'=>'- Select Group One -',
                        'ajax'=>array(
	                            //'empty'=>'Select Group One',
	                            'type'=>'POST',
	                            'url' => CController::createUrl('chartofaccounts/grouptwo'),
	                            'update'=>'#'.CHtml::activeId($model,'am_grouptwo'),
                            )

                    )
		 );?> </td>


	</tr>

	<tr>
		<td>Second Group </td>
        <td> <?php $grouptwo = CHtml::listData(Grouptwo::model()->findAll(),'am_grouptwo','am_description');
            echo $form->dropDownList($model,'am_grouptwo', $model->isNewRecord ? array() : $grouptwo, array('empty'=>'- Select Group Two -')); ?> </td>

		<td> <?php /* echo $form->dropDownList($model,'am_grouptwo', array(),
			array(
                        'prompt'=>'Select Group Two',
                        'ajax'=>array(
                            //'empty'=>'Select Group',
                            'type'=>'POST',
                            'url' => CController::createUrl('chartofaccounts/groupthree'),
                            'update'=>'#'.CHtml::activeId($model,'am_groupthree'),
                            ))
		); */?> </td>


	</tr>
	
	<!-- <tr>
		<td> Third Group </td>
		<td> <?php //echo $form->dropDownList($model,'am_groupthree',array(), array('empty'=>'Select Group Three')); ?> </td>

	</tr> -->
	
	<tr>
		<td> Analytic Type </td>
		<td> <?php echo $form->dropDownList($model,'am_analyticalcode',array(
                'Cash'=>'Cash','Non-Cash'=>'Non-Cash')); ?>
        </td>
	</tr>
	<tr>	
		<td> Status </td>
		<td class="compactRadioGroup"> 
		<?php //echo $form->dropDownList($model,'am_status',array('Open'=>'Open','Close'=>'Close')); ?>
		<?php echo $form->radioButtonList($model,'am_status',array('Open'=>'Open','Close'=>'Close'), array('separator'=>'', 'labelOptions'=>array('style'=>'display:inline; margin: -5px 25px 0px 0px; padding: 0px 0px 0px 3px;'), 'required'=>TRUE)); ?>
		</td>
	</tr>
	
	<!--<tr>
		<td colspan="1"> Branch </td>
		<td colspan="5"> <?php // echo $form->dropDownList($model,'am_branch', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'),array('empty'=>'- Select Branch -')); ?> </td>
	</tr>-->
</table>



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
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add New A/C' : 'Update A/C', array('class'=>'btn_btn')); ?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


