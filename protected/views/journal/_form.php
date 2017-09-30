<?php
/* @var $this JournalController */
/* @var $model Vouhcerheader */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>

<script type="text/javascript">
    function getMe(){
        var vdate = document.getElementById("date_formate_v").value;
        var year = vdate.substring(0,4);

        var month = vdate.substring(5,7);
        var offset = document.getElementById("offset_pre").value;
        var period =  12 + parseInt(month) - parseInt(offset);

        if (parseInt(period) > 12 ){
            postPeriod =  parseInt(period) - 12;
            document.getElementById("period_new").value = postPeriod;
        }else{
            document.getElementById("period_new").value = period;
        }
        if(parseInt(period) <= 12){
            yearA = parseInt(year) -1;
            document.getElementById("year_new").value = yearA;
        }else{
            document.getElementById("year_new").value = year;
        }
    }
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vouhcerheader-form',
	'enableAjaxValidation'=>false,
)); ?>
    <h1 style="background: #BA7C39; padding: 5px; width: 90%; font-weight: bold; text-align: center;">
        Fill in Voucher Header Information
    </h1>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'am_vouchernumber'); ?>
		<?php echo $form->textField($model,'am_vouchernumber',array('readonly'=>'readonly', 'style'=>'background: #ccc; font-weight:bold;')); ?>
		<?php echo $form->error($model,'am_vouchernumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_date'); ?>
		<?php // echo $form->textField($model,'am_date'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'am_date', //attribute name
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
                'value'=>CTimestamp::formatDate('Y-m-d'),
                'readonly'=>'true',
                'id'=>'date_formate_v',
                'onchange' => 'getMe()',
            ),
        ));?>
        <?php echo $form->error($model,'am_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_referance'); ?>
		<?php echo $form->textField($model,'am_referance',array('size'=>60,'maxlength'=>150, 'required'=>TRUE)); ?>
		<?php echo $form->error($model,'am_referance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_year'); ?>
		<?php echo $form->textField($model,'am_year', array('id'=>'year_new')); ?>
		<?php echo $form->error($model,'am_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_period'); ?>
		<?php echo $form->textField($model,'am_period', array('id'=>'period_new')); ?>
		<?php echo $form->error($model,'am_period'); ?>
	</div>

	<div class="row">
        <label>Branch </label>
        <?php //echo $form->dropDownList($model,'sm_storeid', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('id'=>'warehouse', 'required'=>TRUE)); ?>
         <select id="warehouse" name="Vouhcerheader[am_branch]">
            <option value="">Select Branch</option>
            <?php
            mysql_connect('localhost','root','HEUganda@2017');
            mysql_select_db('ur2');
            $query = mysql_query("SELECT * FROM `cm_branchmaster` WHERE active=1");
            while($row = mysql_fetch_array($query)){
                echo'
                <option value="'.$row['cm_branch'].'">'.$row['cm_description'].'</option>
                ';
            }
            ?>
        </select> 
                <?php echo $form->error($model,'am_branch'); ?>
    </div>

    <input id="offset_pre" type="hidden" value="<?php echo $offset; ?>" />

	<div class="row">
		<?php echo $form->labelEx($model,'am_note'); ?>
		<?php echo $form->textArea($model,'am_note',array('required'=>TRUE)); ?>
		<?php echo $form->error($model,'am_note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'am_status'); ?>
		<?php echo $form->textField($model,'am_status',array('value'=>'Open', 'readonly'=>true)); ?>
		<?php echo $form->error($model,'am_status'); ?>
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
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add New Voucher' : 'Update Voucher Info', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->