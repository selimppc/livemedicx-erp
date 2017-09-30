<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
    'General Ledger',
	'Post'=>array('vouhcerheader/postunpost'),
	'Post',
);

$this->menu=array(
	array('label'=>'Posting Tools', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('vouhcerheader/postunpost')),
);
?>


<style type="text/css">
table .money-receipt-sales, td, th
{
	border: 1px solid #4E8EC2;
	line-height: 23px;
}

.radio_button{
	background: #4085BB;
	border-radius: 30px;
	
}
</style>


<div id="statusMsg">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-success").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-error").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

</div>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> <b>Voucher Posting Selection Table: </b> In this screen you have two options either you select date or year-period. By clicking  the <b>Post</b> button, selected vouchers (<i>between dates or year-period</i>) will hit <b>P&L</b>, <b>Balance Sheet</b> and <b>Trial Balance</b>. Note: Only Balance Voucher will be Posted. </div>
</div>

<div style="clear: both;"></div>

<div>

<?php echo CHtml::beginForm($this->createUrl('/vouhcerheader/postUnPost'), 'POST')?>

<?php echo CHtml::errorSummary($model); ?>

<table>
	<tr> 
		<td colspan="5" style="text-align: center; background: #4085BB; color: white;"> 
			Post to Ledger
		</td>
	</tr>

    <tr style="border: none;">
        <td colspan="5" style="text-align: right; border: none; color: #4085bb;">
            <b> Select One Radio Button </b>
        </td>
    </tr>
	<tr> 
		<td> Start Date </td> 
		<td> 
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, //Model object
					'attribute'=>'start_date', //attribute name
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
					'style' => 'width: 140px;'
				),
			));?> 
		</td>
		<td> End Date </td> 
		<td> 
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, //Model object
					'attribute'=>'end_date', //attribute name
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
					'style' => 'width: 140px;'
				),
			));?> 
		</td>
		<td class="radio_button"> <input type="radio" name="radio" required="required" value="date" style="width: 25px;"> </td>
	</tr>
	
	<tr> 
		<td> Year </td> 
		<td> <input name="year" value="<?php echo $year ?>" style="width: 140px;" > </td>
		<td> Period </td> 
		<td> <input name="period" value="<?php echo $period; ?>" style="width: 140px;" ></td>
		<td class="radio_button"> <input type="radio" name="radio"  required="required" value="year" style="width: 25px;" > </td>
	</tr>
</table>


<div style="width: 600px; float: left; margin: 20px;">

	<div style="width: 90%; float: left; margin-right: 10%;">
		<?php echo CHtml::submitButton('Post', array('name' => 'Post', 'style'=>'background:#4085BB; height: 40px; width:150px; color: white; cursor: pointer; font-weight: bold; border-radius: 3px;')); ?>
	</div>
	
	<div style="width: 5%; float: left;">
		<?php //echo CHtml::submitButton('Unpost', array('name' => 'unpost', 'style'=>'background:#4085BB; height:40px; width:150px; color: white; cursor: pointer; font-weight: bold; border-radius: 3px;')); ?>
	</div>
	
</div>


<?php echo CHtml::endForm(); ?>

</div>