<?php
$this->breadcrumbs=array(
    'Inventory Module',
    'Settings'=>array('imtransaction/inventorySettings'),
);

?>

<style type="text/css">
    #report_main_div{
        width: 96%;
        float: left;
        color: orange;
        margin-left: 20px;

    }
    #report_button{
        width: 33%;
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
    <div id="flag_desc_text"><b>Inventory Settings</b> This screen facilities information flow between all Inventory functions. By clicking the tab options will navigate to desired screen. </div>
</div>


<div id="notice_amt" style="width: 98%; float: left; padding: 10px; font-size: 16px; font-weight: bold; background: blanchedalmond; color: red; margin-bottom: 20px;  box-shadow: 10px 3px 5px #aaa;">
    <b>Warning Message: This settings option is only for the System Administrator. </b>

</div>

<div style="width: 98%; margin: 0 auto;">

    <div id="report_main_div">
        <div id="report_button">
            <?php echo CHtml::link('GRN Number Setup',array('transaction/createGRNnumnber')); ?>
        </div>
    </div>

    <div id="report_main_div">
        <div id="report_button">
            <?php echo CHtml::link('IM Transaction',array('transaction/createImTrn')); ?>
        </div>
    </div>

    <div id="report_main_div">
        <div id="report_button">
            <?php echo CHtml::link('IM Transfer Number',array('transaction/createImTrnNum')); ?>
        </div>
    </div>


	<div id="report_main_div">
		<div id="report_button">
			<?php echo CHtml::link('IM Adjustment Transaction Number',array('transaction/createAdjustmentNumber')); ?>
		</div>
	</div>

</div>
