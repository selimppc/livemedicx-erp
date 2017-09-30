<?php
/* @var $this ChartofaccountsController */
/* @var $model Chartofaccounts */

$this->breadcrumbs=array(
	'Chart of Accounts'=>array('admin'),
	'Manage Chart of Accounts',
);

$this->menu=array(
	//array('label'=>'List Chartofaccounts', 'url'=>array('index')),
	array('label'=>'Nouveau tableau  des comptes', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Group Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('groupone/create')),
				//array('label'=>'Group Two', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('grouptwo/createGroupTwo')),
				//array('label'=>'Group Three', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('groupthree/admin')),
				//array('label'=>'Default', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('amdefault/admin')),
	),
	),*/
	
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
        <b>Historique du compte</b>: Cet écran vous permettra d'avoir une vue d'ensemble dans le tableau  des détails du compte; vous pouvez rechercher des données spécifiques en sélectionnant les titre dans les colonnes.Vous pouvez également ouvrir un écran de saisie de données pour l'entréed'un nouveau plan compte  en cliquant sur l'onglet du Menu <b>"Nouveau plan comptable"</b>.

      </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'chartofaccounts-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'header'=>'Type de compte',
            'name'=>'am_accounttype'
        ),
        array(
            'header'=>'Premier Groupe',
            'name'=>'Group_One'
        ),
        array(
            'header'=>'Deuxièmegroupe',
            'name'=>'Group_Two'
        ),
        array(
            'header'=>'code du compte',
            'name'=>'am_accountcode'
        ),

        array(
            'header'=>'Description du compte',
            'name'=>'am_description'
        ),
        array(
            'header'=>'Utilisation du compte',
            'name'=>'am_accountusage'
        ),
        array(
            'header'=>'Type analytique',
            'name'=>'am_analyticalcode'
        ),
        'am_status',

    ),
)); ?>

<?php /* $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'chartofaccounts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'am_accountcode',
		'am_description',
		'am_accounttype',
		'am_accountusage',
		'group_one',
		'group_two',

		'group_three',
		'am_analyticalcode',
		//'am_branch',
		'am_status',
		//'inserttime',
		//'updatetime',
		//'insertuser',
		//'updateuser',


		array(
			'class'=>'CButtonColumn',
			'header'=>'Action',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); */ ?>
