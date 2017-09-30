<?php
$this->breadcrumbs=array(
    'Inventory',
	'POST to GL (COGS)'=>array('imtransaction/PostToGl'),
	'Posting To GL',
);

$this->menu=array(
	//array('label'=>'POST to GL', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/post_gl_a.png" /></span>{menu}', 'url'=>array('PostToGl')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'IM Transaction', 'url'=>array('transaction/ManageImTrn')),
	),
	),*/
);

?>

<style type="text/css">


table tr td select,#Imtransaction_fromdate, #Imtransaction_todate{
    padding: 15px;
    width: 250px;
    font-size: 14px;
}
table tr th{
    width: 300px;
}
.ui-datepicker-trigger{
    border: none;
    background: none;
}
.hasDatepicker{
    padding: 3px;
}
</style>



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


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> <b>Posting to GL:</b> Post inventory data to <b>General Ledger</b>. Select branch and input desire dates, from and to, followed by clicking the button on <b>"Proceed"</b>.
    <br> <b>Note:</b> Click the button <b>"Pre-Posting Journal View"</b> for viewing journal entry(s) before <b>"Proceed"</b> <i>if require</i>.
    </div>
</div>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sm-header-form',
	'enableClientValidation'=>true,
)); ?>


<table style="width: 98%; float: left; text-align: left; ">
    <tr>
        <th> Branch: </th>
        <th> From Date: </th>
        <th> To Date: </th>
    </tr>
    <tr>
        <td>
            <?php
                $branch = CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description');
            echo $form->dropDownList($model,'branch', $branch, array('class'=>'hr_input_field')); ?>
        </td>
        <td>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker',array(
                'model'=>$model,
                'attribute'=>'fromdate', //attribute name
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
                    'maxDate' => CTimestamp::formatDate('Y-m-d') ,
                ),

                'htmlOptions'=>array(
                    'value'=>CTimestamp::formatDate('Y-m-d'),
                    'readonly' => true,
                ),
            ));?>

        </td>
        <td>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker',array(
                'model'=>$model,
                'attribute'=>'todate', //attribute name
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

                ),
            ));?>

        </td>
    </tr>

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
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>20,'maxlength'=>20)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php // echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>20,'maxlength'=>20)); ?>
		<?php // echo $form->error($model,'updateuser'); ?>
	</div>

	<div class="row buttons">
		<div class="row status-container">
          <div class="span4 action-bar" style="width: 440px;">
			<?php //echo CHtml::submitButton($model->isNewRecord ? 'Proceed' : 'Proceed', array('name' => 'Proceed', 'class'=>'action-btn', 'id'=>'action-btn-1', 'style'=>'margin-left: -10px;width: 130px;')); ?>
              <?php //echo CHtml::submitButton($model->isNewRecord ? 'Process Result' : 'Process Result', array('name' => 'Result', 'class'=>'action-btn', 'id'=>'action-btn-1', 'style'=>'width: 130px;')); ?>
              <?php echo CHtml::submitButton('Proceed', array('class'=>'action-btn', 'id'=>'action-btn-1', 'name' => 'proceed', 'style'=>'width: 150px; margin-right: 20px;')); ?>
              <?php echo CHtml::submitButton('Pre-Posting Journal View', array('class'=>'action-btn', 'id'=>'action-btn-1', 'name' => 'posting', 'style'=>'width:220px;')); ?>
          </div>
        </div>
	</div>

<?php $this->endWidget(); ?>

<!-- form -->




    <?php /* $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'imtransaction-grid',
        //'dataProvider'=>$post->searchPostings($pBranch, $pFromDate, $pToDate),
        'dataProvider'=>$post->searchPostings($pBranch, $pFromDate, $pToDate),
        //'filter'=>$post,
        'columns'=>array(
            'im_number',
            //'im_storeid',
            //'im_date',
            'cm_code',
            'cm_name',
            //'im_currency',
            //'im_ExchangeRate',
            //'im_quantity',
            //'im_totalprice',
            'im_basevalue',
            //'im_status',
        ),
    )); */ ?>
