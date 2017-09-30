<?php
/* @var $this ItImtoapController */
/* @var $model ItImtoap */

$this->breadcrumbs=array(
	'Reports (GL)'=>array('sareport/GLReports'),
	'Reporting',
);
/*
$this->menu=array(
	//array('label'=>'List ItImtoap', 'url'=>array('index')),
	//array('label'=>'Create Module Interface', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'IM to AP', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
);
*/
?>
<style type="text/css">
	#report_main_div{
		width: 100%; 
		float: left;
		color: orange;
		margin-left: 30px;
	}
	#report_button{
		width: 100%; 
		float: left;
	}

	#report_button a {
		text-decoration: none;
		color: white;
		width: 55%;
		float: left;
		text-align: center;
		margin-top: 10px;
		padding: 17px 30px;
		background: #4085BB;
		border-radius: 2px;
		font-size: 16px;
		box-shadow: 10px 3px 5px #aaa;
	}
	#report_button a:hover {
		background: #2F6088;
	}

</style>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> <b>Outils de reportage de la comptabilité:</b> Sur cet écran, vous avez l'accès aux rapports de la comptabilité. </div>
</div>

<div style="width: 98%; float: left;">
	<div style="width: 32%; float: left; margin-right: 2%;">
	
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Un essaie consolidé de faire un calcul de balance commerciale',array('sareport/TrialBlance')); ?>
			</div>	
		</div>
		
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Un essaie consolidé de faire un calcul de balance globale.',array('sareport/trialBlanceAll')); ?>
			</div>
		</div>

		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Tableau des comptes',array('sareport/chartOfAccount')); ?>
			</div>
		</div>
		
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Livre de caisse',array('sareport/journalTransaction')); ?>
			</div>
		</div>
	</div>
	<div style="width: 32%; float: left; margin-right: 2%;">
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Bilan',array('sareport/balanceSheet')); ?>
			</div>
		</div>
		<div id="report_main_div"> 
			<div id="report_button">
				<?php echo CHtml::link('Gain & Perte',array('sareport/pnl')); ?>
			</div>
		</div>
	</div>
	<div style="width: 32%; float: left;">
	</div>
</div>

<div style="width: 98%; margin: 0 auto;">

	

</div>




