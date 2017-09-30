<?php
/* @var $this AdjustdtController */
/* @var $model Adjustdt */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'adjustdt-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'transaction_number'); ?>
        <?php echo $form->textField($model,'transaction_number',array('readonly'=>TRUE,)); ?>
        <?php echo $form->error($model,'transaction_number'); ?>
    </div>

    <input type="hidden" id="branch_name" value="<?php echo $branch; ?>">

    <span style="color: orangered; font-weight: bold;" id="adjustment_type">
        <?php if($adjStatus =='1'){
            echo "Positive Adjustment";
        }else if($adjStatus =='-1'){
            echo "Negative Adjustment";
        }   ?>
    </span>


    <div class="row">
        <?php echo $form->labelEx($model,'product_code'); ?>
        <?php //echo $form->textField($model,'product_code'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'product_code',
            'model'=>$model,
            'attribute'=>'product_code',

            'source'=>'js: function(request, response) {
                $.ajax({
                    url: "'.$this->createUrl('adjustdt/getStockNames').'",
                    dataType: "json",
                    data: {
                        term: request.term,
                        branchName: $("#branch_name").val(),
                        adjustmentType: $("#adjustment_type").text(),
                    },
                    success: function (data) {
                            response(data);
                    }
                })
             }',

            'options'=>array(
                'minLength'=>'1',
                'select'=>'js:function(event, ui){
						$("#product_code").val(ui.item.value);
						$("#productname").text(ui.item.label);
						$("#batch_number").val(ui.item.batch);
						$("#expirry_date").val(ui.item.expire);
						$("#unit").val(ui.item.unit);
                        $("#stock_rate").val(ui.item.rate);
					}'
            ),
            'htmlOptions'=>array(
                'id'=>'product_code',
                'placeholder'=>'Search by Product Name',
                'readonly'=>$model->isNewRecord ? '' : True,
                'required'=>TRUE,
            ),
        ));
        ?>
        <p>&nbsp;</p>
        <br>
        <div id="productname" style="width: 56%; margin-left: 28%; padding: 5px; background: ghostwhite; font-weight: bold;"></div>
        <?php echo $form->error($model,'product_code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'batch_number'); ?>
        <?php echo $form->textField($model,'batch_number',array('id'=>'batch_number', 'required'=>TRUE)); ?>
        <?php echo $form->error($model,'batch_number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'expirry_date'); ?>
        <?php //echo $form->textField($model,'expirry_date',array('id'=>'expirry_date')); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        $this->widget('CJuiDateTimePicker',array(
            'model'=>$model, //Model object
            'attribute'=>'expirry_date', //attribute name
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
                //'value'=>CTimestamp::formatDate('Y-m-d'),
                'id'=>'expirry_date',
                'required'=>TRUE,
            ),
        ));?>
        <?php echo $form->error($model,'expirry_date'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'unit'); ?>
        <?php echo $form->textField($model,'unit',array('id'=>'unit', 'style'=>'background-color: white;', 'required'=>TRUE)); ?>
        <?php echo $form->error($model,'unit'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'quantity'); ?>
        <?php echo $form->textField($model,'quantity',array('id'=>'quantity', 'required'=>TRUE,)); ?>
        <?php echo $form->error($model,'quantity'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'stock_rate'); ?>
        <?php echo $form->textField($model,'stock_rate',array('id'=>'stock_rate', 'required'=>TRUE)); ?>
        <?php echo $form->error($model,'stock_rate'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'inserttime'); ?>
        <?php echo $form->hiddenField($model,'inserttime'); ?>
        <?php //echo $form->error($model,'inserttime'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'insertuser'); ?>
        <?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
        <?php //echo $form->error($model,'insertuser'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'updatetime'); ?>
        <?php echo $form->hiddenField($model,'updatetime'); ?>
        <?php //echo $form->error($model,'updatetime'); ?>
    </div>

    <div class="row">
        <?php //echo $form->labelEx($model,'updateuser'); ?>
        <?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
        <?php //echo $form->error($model,'updateuser'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Add Adjustment Detail' : 'Update Adjustment Detail', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->