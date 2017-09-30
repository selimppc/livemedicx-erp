<?php Yii::app()->clientscript->scriptMap['jquery.js'] = false; ?>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'vouhcerheader-form',
    'enableClientValidation'=>true,
    'focus'=>array($model,'am_vouchernumber'),
)); ?>

<?php echo $form->errorSummary($model); ?>
<br>
<div class="row">
    <label> VAT (%)</label>
    <?php echo $form->textField($model,'im_taxamt', array('style'=> 'border: 1px solid #aaa; width: 50%; padding: 3px;')); ?>
    <?php echo $form->error($model,'im_taxamt'); ?>
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
    <?php echo $form->hiddenField($model,'insertuser'); ?>
    <?php //echo $form->error($model,'insertuser'); ?>
</div>

<div class="row">
    <?php //echo $form->labelEx($model,'updateuser'); ?>
    <?php echo $form->hiddenField($model,'updateuser'); ?>
    <?php //echo $form->error($model,'updateuser'); ?>
</div>






<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; text-align: center;') ); ?>



<?php $this->endWidget(); ?>

