<?php
$this->breadcrumbs=array(
    'Master Setup',
    'Settings'=>array('codesparam/masterSetup'),
);

?>

<style type="text/css">
    #report_main_div{
        width: 100%;
        float: left;
    }
    #report_button{
        width: 100%;
        float: left;
    }

    #report_button a {
        text-decoration: none;
        color: white;
        width: 60%;
        float: left;
        text-align: center;
        margin-bottom: 20px;
        padding: 13px 35px;
        background: #4085BB;
        border-radius: 2px;
        font-size: 16px;
        box-shadow: 10px 3px 5px #aaa;
    }
    #report_button a:hover {
        background: #2F6088;
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
    <div id="flag_desc_text"><b>Master Settings: </b>This screen facilities information flow between all business functions.  </div>
</div>


<div style="width: 99%; float: left;">
    <div style="width: 32%; float: left; margin-right: 2%;">
        <h1 style="text-align:center; background: #FFCCFF; margin-bottom: 20px; padding: 10px; width: 74%; font-weight: bold; box-shadow: 10px 3px 5px #aaa;">
            Product Master
        </h1>
        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Product Class Setup',array('codesparam/createProductClass')); ?>
            </div>
        </div>


        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Product Category Setup',array('codesparam/createProductGroup')); ?>
            </div>
        </div>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Product Group Setup',array('codesparam/createProductCategory')); ?>
            </div>
        </div>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Unit Of Measurement Setup',array('codesparam/unitOfMeasurement')); ?>
            </div>
        </div>
    </div>


    <div style="width: 32%; float: left; margin-right: 2%;">
        <h1 style="text-align:center; background: #FFCCFF; margin-bottom: 20px; padding: 10px; width: 74%; font-weight: bold; box-shadow: 10px 3px 5px #aaa;">
            Supplier Master
        </h1>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Supplier Group Setup',array('codesparam/createSupplierGroup')); ?>
            </div>
        </div>


        <!--
        <div id="report_main_div">
            <div id="report_button">
                <?php //echo CHtml::link('User Report',array('default/billadmin')); ?>
            </div>
        </div> -->
    </div>


    <div style="width: 32%; float: left;">
        <h1 style="text-align:center; background: #FFCCFF; margin-bottom: 20px; padding: 10px; width: 74%; font-weight: bold; box-shadow: 10px 3px 5px #aaa;">
            Customer Master
        </h1>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Customer Group Setup',array('codesparam/createCustomerGroup')); ?>
            </div>
        </div>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Customer Transaction No Setup',array('transaction/createCustmerTrnNo')); ?>
            </div>
        </div>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Customer District Code',array('codesparam/createDistrictCode')); ?>
            </div>
        </div>

    </div>
-->
</div>

