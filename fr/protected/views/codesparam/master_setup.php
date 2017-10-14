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
    <div id="flag_desc_text"><b>Contrôle des configurations: </b>cet écran favorise le passage d'information à tous les niveaux d'affaires.  </div>
</div>


<div style="width: 99%; float: left;">
    <div style="width: 32%; float: left; margin-right: 2%;">
        <h1 style="text-align:center; background: #FFCCFF; margin-bottom: 20px; padding: 10px; width: 74%; font-weight: bold; box-shadow: 10px 3px 5px #aaa;">
            Contrôle du Produit
        </h1>
        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Configuration des Classes de produits',array('codesparam/createProductClass')); ?>
            </div>
        </div>


        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Catégorie de produits Configuration',array('codesparam/createProductGroup')); ?>
            </div>
        </div>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Configuration des Groupes des produits',array('codesparam/createProductCategory')); ?>
            </div>
        </div>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link("Configuration de l'unité de mesure",array('codesparam/unitOfMeasurement')); ?>
            </div>
        </div>
    </div>


    <div style="width: 32%; float: left; margin-right: 2%;">
        <h1 style="text-align:center; background: #FFCCFF; margin-bottom: 20px; padding: 10px; width: 74%; font-weight: bold; box-shadow: 10px 3px 5px #aaa;">
            Contrôle du fournisseur
        </h1>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link("Configuration du groupe d'un fournisseur",array('codesparam/createSupplierGroup')); ?>
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
            Contrôle de la clientèle
        </h1>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Configuration des groupes des clients',array('codesparam/createCustomerGroup')); ?>
            </div>
        </div>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Configuration de numéros des transanctions des clients',array('transaction/createCustmerTrnNo')); ?>
            </div>
        </div>

        <div id="report_main_div">
            <div id="report_button">
                <?php echo CHtml::link('Code de District du client',array('codesparam/createDistrictCode')); ?>
            </div>
        </div>

    </div>
-->
</div>

