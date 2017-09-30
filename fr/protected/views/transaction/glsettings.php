<?php
$this->breadcrumbs=array(
    'General Ledger',
    'Settings'=>array('transaction/glsettings'),
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
    <div id="flag_desc_text"><b> Outils de configuration d'un livre comptable :</b>
        Cet écran facilite le flux d'informations  entre tous les organes chargés de la Comptabilité.  En cliquant sur les options de l'onglet, vous arriverez à l'écran souhaité.
    </div>
</div>




<div style="width: 98%; margin: 0 auto;">

    <div id="report_main_div">
        <div id="report_button">
            <?php echo CHtml::link('Groupes de plans Comptables',array('groupone/create')); ?>
        </div>
    </div>

    <div id="report_main_div">
        <div id="report_button">
            <?php echo CHtml::link('Numéro du coupon de transanction',array('transaction/createvoucherno')); ?>
        </div>
    </div>
    <!--
	<div id="report_main_div">
		<div id="report_button">
			<?php echo CHtml::link('User Report',array('default/billadmin')); ?>
		</div>
	</div>

	<div id="report_main_div">
		<div id="report_button">
			<?php echo CHtml::link('User Report',array('default/billadmin')); ?>
		</div>
	</div>
	 -->
</div>
