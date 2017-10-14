<?php
/* @var $this ChartofaccountsController */
/* @var $model Chartofaccounts */

$this->breadcrumbs=array(
	'Chart of Accounts'=>array('admin'),
	'Manage Chart of Accounts',
);

$this->menu=array(
	//array('label'=>'List Chartofaccounts', 'url'=>array('index')),
	array('label'=>'New Chart of Accounts', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	
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
        <b>Chart of Account's History</b>: This screen will allow you to view the overall Chart of Account’s detail; you can search specific data by selecting any title columns. You can also open a data entry screen to input new Chart of Account(s) by clicking the Menu tab <b>“New Chart of Accounts”</b>

      </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'chartofaccounts-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'am_accounttype',
        'Group_One',
        'Group_Two',
        //'Group_Three',
        //'Group_Four',
        'am_accountcode',
        'am_description',
        'am_accountusage',
        'am_analyticalcode',
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
