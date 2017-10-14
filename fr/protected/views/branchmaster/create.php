<?php
/* @var $this BranchmasterController */
/* @var $model Branchmaster */

$this->breadcrumbs=array(
	'Branch Masters'=>array('admin'),
	'Contrôle de la nouvelle Branche',
);

$this->menu=array(
	//array('label'=>'List Branchmaster', 'url'=>array('index')),
	array('label'=>'Manage Branch Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>


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
        <div id="flag_desc_text">
            <b>Contrôle de la nouvelle Branche</b>: Sur cet écran vous devez remplir tous les champs obligatoires avant de cliquer sur le bouton <b>"Enregistrer" </b>. Les champs marqué avec (*) sont obligatoires.  Vous pouvez revenir à  votre écran d'accueil pour afficher des informations sur le client  en cliquant sur l'onglet du menu <b>"Gérer la nouvelle branche "  </b>.
        </div>
    </div>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>