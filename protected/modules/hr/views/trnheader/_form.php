<?php
/* @var $this TrnheaderController */
/* @var $model Trnheader */
/* @var $form CActiveForm */
?>
<style type="text/css">
table .money-receipt-sales, td, th
{
	border: 1px solid #4E8EC2;
}
#button_add{
	text-align: center;
	background: orange;
	color: white;
	cursor: pointer;
	padding: 3px 8px;
	border-radius: 3px;
}
#Vouhcerheader_voucher_no{
	width: 140px;
}
.trn_header_input{
	width: 240px;
	text-align: center;
	padding: 4px;
}
</style>



<script type="text/javascript">
var id=0;
var addedEmployeeId = [];
var addedSalaryType = [];

$(document).ready(function(){
	$("#button_add").click(function() {

		//getting data from a table 
	    var tableData = $(this).closest("tr").find("td input").map(function() {
	        return $(this).val();
	    }).get();

	   //getting salary type by dropdown
	    var e = document.getElementById("salarytype");
		var salarytype = e.options[e.selectedIndex].value;
		
		var empid = document.getElementById("empid").value;
		var addedEmpid = $.trim(tableData[0]);

		//checking value in array
	    var flag = false;

	    for (var i = 0; i < addedEmployeeId.length; i++) {
	        if (addedEmployeeId[i] == empid && addedSalaryType[i] == salarytype) {
	            flag = true;
	        }
	    }
		 	
		//appending data to another table
	    if (flag) {
	        alert("You already added Employee And Salary Type");
	        exit;
	    } else {
	        if (empid == "") {
	            alert("Please add Employee ID");
	            exit;
	        } else {
	            $("#test").append(
	            		// "<tr><td><input name='' value='"+$.trim(tableData[0])+"' style='width: 120px;' readonly > </td><td><input value='"+salarytype+"' style='width: 100px;' readonly ></td><td><input name='' value='"+$.trim(tableData[1])+"' style='width: 100px;' readonly ></td><td><input name='' value='"+$.trim(tableData[2])+"' style='width: 100px;' readonly ></td><td><input name='' value='"+$.trim(tableData[3])+"' style='width: 100px;' readonly ></td><td><input name='' value='"+$.trim(tableData[4])+"' style='width: 100px;' readonly ></td><td><input name='' value='"+$.trim(tableData[5])+"' style='width: 100px;' readonly ></td><td><input name='' value='"+$.trim(tableData[6])+"' style='width: 100px;' readonly ></td><td><input name='' value='"+$.trim(tableData[7])+"' style='width: 100px;' readonly ></td></tr>");
	            	"<tr><td><input name='empid[]' value='"+$.trim(tableData[0])+"' style='width: 120px;' readonly > </td><td><input name='salarytype[]' value='"+salarytype+"' style='width: 100px;' readonly ></td><td><input name='amount[]' value='"+$.trim(tableData[1])+"' style='width: 100px;' readonly ></td><td><input name='percent[]' value='"+$.trim(tableData[2])+"' style='width: 100px;' readonly ></td><td><input name='timeofbasic[]' value='"+$.trim(tableData[3])+"' style='width: 100px;' readonly ></td><td><input name='areaamt[]' value='"+$.trim(tableData[4])+"' style='width: 100px;' readonly ></td><td><input name='adjustment[]' value='"+$.trim(tableData[5])+"' style='width: 100px;' readonly ></td><td><input name='othour[]' value='"+$.trim(tableData[6])+"' style='width: 100px;' readonly ></td><td><input name='daydeduction[]' value='"+$.trim(tableData[7])+"' style='width: 100px;' readonly ></td></tr>");
	            addedEmployeeId.push(addedEmpid);
	            addedSalaryType.push(salarytype);
	        }
	    }
		
	});
});


</script>






<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trnheader-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'focus'=>array($model,''),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


<table>
	<tr> 
		<td colspan="4" style="text-align: center; background: #4085BB; color: white;"> 
			HR Transaction Header
		</td>
	</tr>
	
	<tr style="text-align: center;">
		<td> Transaction Number </td>
		<td> Date </td>
		<td> Year </td>
		<td> Period </td>
	</tr>
	
	<tr>
		<td> <?php echo $form->textField($model,'trnnumber', array('class'=>'trn_header_input')); ?> </td>
		<td> <?php // echo $form->textField($model,'trndate', array('class'=>'trn_header_input')); ?> 
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, //Model object
					'attribute'=>'trndate', //attribute name
					'language'=> '',
					'mode'=>'date', 
					'options'=>array(
						'dateFormat' => 'yy-mm-dd',
						'showAnim'=>'fold',
						'changeMonth' => 'true',
						'changeYear' => 'true',
						'showOtherMonths' => 'true',
						'selectOtherMonths' => 'true',
						'showOn' => 'both',
						'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
				),
				
				'htmlOptions'=>array(
					'value'=>$model->isNewRecord ? CTimestamp::formatDate('Y-m-d') : '',
					'id'=>'date_formate_v',
					'class' => 'trn_header_input',
				),
			));?> 
		</td>
		<td> <?php echo $form->textField($model,'trnyear', array('class'=>'trn_header_input')); ?> </td>
		<td> <?php echo $form->textField($model,'trnperiod', array('class'=>'trn_header_input')); ?> </td>
	</tr>

</table>

<br>	
	
	
<table style="width: 94%; float: left;">
	<tr> 
		<td style="text-align: center; background: #4085BB; color: white;"> 
			HR Transaction Deatails
		</td>
	</tr>
</table>	
	
	
<table>	
	<thead>
		<tr>
			<th> Employee ID </th>
			<th> Salary Type </th>
			<th> Amount </th>
			<th> Percent </th>
			<th> Time of Basic </th>
			<th> Area Amount </th>
			<th> Adjustment </th>
			<th> Over Time Hour </th>
			<th> Day Deduction </th> 
			<th> Action </th>
		</tr>
	</thead>
	
	
	<tbody>
		<tr>
			<td>
				<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'name'=>'empid',
					'source'=>CController::createUrl('/hr/trnheader/EmplyeeName'),
					'options'=>array(
						'minLength'=>'1', 
						'select'=>'js:function(event, ui){
							$("#empid").val(ui.item.value);
						}'
					),
					'htmlOptions'=>array(
						'id'=>'empid',
						'placeholder'=>'Search Employee ...',
						'style'=>'padding: 3px; width: 120px;',
					),
				)); ?> 
			</td>
			<td> 
				<?php echo $form->dropdownList($model, 'salarytype', CHtml::listdata(Codesparam::model()->findAll('cm_type="Salary Type"'), 'cm_code', 'cm_code' ), array('id'=>'salarytype', 'style'=>'width: 100px;') ); ?>
			</td>
			<td><input id="" style="width: 100px; padding: 3px; text-align: right;" value="0.00"/> </td>
			<td><input id="" style="width: 100px; padding: 3px; text-align: right;" value="0"/> </td>
			<td><input id="" style="width: 100px; padding: 3px; text-align: right;" value="0"/> </td>
			<td><input id="" style="width: 100px; padding: 3px; text-align: right;" value="0.00"/> </td>
			<td><input id="" style="width: 100px; padding: 3px; text-align: right;" value="0.00"/> </td>
			<td><input id="" style="width: 100px; padding: 3px; text-align: right;" value="0"/> </td>
			<td><input id="" style="width: 100px; padding: 3px; text-align: right;" value="0"/> </td>
			<td><span id="button_add"> Add </span>  </td>
		</tr>
	</tbody>
	
</table>		
	
	
<br>
<table>
	<tbody id="test">
	</tbody>
</table>	
	
	
	
	
	
	

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
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php // echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php // echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<div class="row status-container">
         <div class="span4 action-bar">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->