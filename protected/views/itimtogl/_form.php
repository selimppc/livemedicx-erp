<?php
/* @var $this ItimtoglController */
/* @var $model Itimtogl */
/* @var $form CActiveForm */
?>
<style type="text/css">
    table td, th
    {
        border: 1px solid #4E8EC2;
        padding: 2px;
    }
    table td select{
        padding: 3px;
    }
    table td input{
        padding: 5px;
    }
    .row input, .row textarea, .row select {
        padding: 5px;
        margin: 5px;
    }
</style>


<div style="width: 98%; float: left;" >

    <div style="width: 48%; float: left;" >
        <div class="form">

            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'itimtogl-form',
                'enableAjaxValidation'=>false,
            )); ?>

            <table>
                <tr>
                    <td colspan="2" style="text-align: center; background: #4085BB; color: white;">
                        IM to GL
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Branch</b>
                    </td>
                    <td>
                        <b>Transcation Code</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->dropDownList($model,'c_branch', CHtml::listData(Branchmaster::model()->findAll(),'cm_branch','cm_description'), array('style'=>'width: 230px;')); ?>
                    </td>
                    <td>
                        <?php echo $form->dropDownList($model,'c_trncode', CHtml::listData(Transaction::model()->findAll('cm_type = "IM Transaction" '),'cm_trncode','cm_trncode'), array('style'=>'width: 230px;')); ?>
                    </td>
                </tr>

                <tr>
                    <td> <b>Category</b> </td>
                    <td>
                        <?php echo $form->dropDownList($model,'c_group', CHtml::listData(Codesparam::model()->findAll('cm_type = "Product Category" '),'cm_code','cm_code'), array('style'=>'width: 230px;')); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Debit Account</b>
                    </td>
                    <td>
                        <?php // echo $form->textField($model,'debit_account',array('size'=>50,'maxlength'=>50)); ?>
                        <?php echo $form->dropDownList($model,'c_accdr', CHtml::listData(Chartofaccounts::model()->findAll(array('order' => 'am_description ASC')),'am_accountcode','am_description'), array('empty'=>'- Select Debit Account -', 'required'=>TRUE ,'style'=>'width: 230px;')); ?>
                        <?php
                        /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'c_accdr',
                            'model'=>$model,
                            'attribute'=>'c_accdr',
                            'source'=>CController::createUrl('/itimtogl/getim'),
                            'options'=>array(
                                'minLength'=>'1',
                                'select'=>'js:function(event, ui){
                                    $("#c_accdr").val(ui.item.value);
                                }'
                            ),
                            'htmlOptions'=>array(
                                'id'=>'c_accdr',
                                'style'=>'width: 230px;',
                                'placeholder'=>'search by account..',
                            ),
                        ));*/
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Credit Account</b>
                    </td>
                    <td>
                        <?php // echo $form->textField($model,'debit_account',array('size'=>50,'maxlength'=>50)); ?>
                        <?php echo $form->dropDownList($model,'c_acccr', CHtml::listData(Chartofaccounts::model()->findAll(array('order' => 'am_description ASC')),'am_accountcode','am_description'), array('empty'=>'- Select Credit Account -', 'required'=>TRUE ,'style'=>'width: 230px;')); ?>
                        <?php
                        /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'c_acccr',
                            'model'=>$model,
                            'attribute'=>'c_acccr',
                            'source'=>CController::createUrl('/itimtogl/getim'),
                            'options'=>array(
                                'minLength'=>'1',
                                'select'=>'js:function(event, ui){
                                    $("#c_acccr").val(ui.item.value);
                                }'
                            ),
                            'htmlOptions'=>array(
                                'id'=>'c_acccr',
                                'style'=>'width: 230px;',
                                'placeholder'=>'search by account..',
                            ),
                        ));*/
                        ?>
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
                <?php echo $form->hiddenField($model,'insertuser',array('size'=>10,'maxlength'=>10)); ?>
                <?php //echo $form->error($model,'insertuser'); ?>
            </div>

            <div class="row">
                <?php //echo $form->labelEx($model,'updateuser'); ?>
                <?php echo $form->hiddenField($model,'updateuser',array('size'=>10,'maxlength'=>10)); ?>
                <?php //echo $form->error($model,'updateuser'); ?>
            </div>

            <div class="row buttons">
                <?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit IM to GL' : 'Update IM to GL', array('class'=>'btn_btn', 'name' => 'submit', 'style'=>'width: 200px; margin-left: 200px;')); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div><!-- form -->


    </div>

    <div style="width: 52%; float: left; line-height: 14px;" >


        <h1 style="background: #FFCCFF; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
            IM to GL
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'it-imtoap-grid',
            'dataProvider'=>$imtogl->search(),
            'filter'=>$imtogl,
            'columns'=>array(
                //'id',
                'c_branch',
                'c_trncode',
                'c_group',
                //'c_accdr',
                //'c_acccr',
                'accdr',
                'acccr',
                array(
                    'class'=>'CButtonColumn',
                    'header' => 'Action',
                    'template' => '{update}',
                ),
            ),
        )); ?>

    </div>

</div>