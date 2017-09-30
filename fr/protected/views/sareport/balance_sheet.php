<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'General Ledger',
	'Reports'=>array('sareport/GLReports'),
	'Balance Sheet',
);

$this->menu=array(
	array('label'=>'<< Back to Report', 'url'=>array('sareport/GLReports')),
);
?>
<style type="text/css">
	.ui-datepicker-trigger{
		border: none;
		background: none;
	}
	.hasDatepicker{
		padding: 3px;
	}
	
	table tr td select, #from_date, #to_date{
		padding: 15px;
		width: 170px;
		font-size: 14px;
	}
	table tr th{
		width: 300px;
	}

</style>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> <b>Bilan:</b> Selectionner  l'année, le mois, la  branche et le type de rapportla Direction générale et le type de rapport. Pour consulter le rapport en format pdf ou xls, cliquez sur <b>"PDF"</b> ou <b>"XLS"</b>.   ***  L'affichage des données dans le livres comptable est nécessaire pour la consultation et le résultat. Vous pouvez revenir aux Outils de Rapportage  pour afficher tous les outils de rapportage en cliquant sur l'onglet du menu <b>"Retour au rapport»</b>.</div>
</div>

<div style="clear: both;"></div>

<?php echo CHtml::beginForm($this->createUrl('/sareport/balanceSheetReports'), 'POST', array('target'=>'_blank'))?>

<table style="text-align: left; ">
	  <tr>
	    <th> Year : </th>
	    <th> Month: </th>
	    <th> Branch: </th>
		<th> Report Type: </th>
	  </tr>
	  <tr>
	  
		<td>
	  		<?php echo CHtml::activeDropDownList($model, 'cm_phone', array('2013'=>'2013', '2014'=>'2014', '2015'=>'2015', '2016'=>'2016', '2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021'), array('empty'=>'- Select Year -', 'required'=>TRUE)); ?>
	  	</td>
	
		<td>
	  		<?php echo CHtml::activeDropDownList($model, 'inserttime', array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec',), array('empty'=>'- Select Month -', 'required'=>TRUE)); ?>
	  	</td>
		
	  	<td> <?php echo CHtml::activeDropDownList($model, 'cm_branch', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description'), array('empty'=>'- Select Branch -', 'required'=>TRUE)); ?> </td>
	  	
		<td> <?php echo CHtml::activeDropDownList($model, 'insertuser', array('Detail'=>'Detail', 'Summary'=>'Summary')); ?>
		</td>
	  </tr>
</table>

	<div class="row buttons">
		<div class="row status-container">
          <div class="span4 action-bar">
			<?php echo CHtml::submitButton('To PDF', array('class'=>'action-btn', 'id'=>'action-btn-pdf', 'name' => 'topdf', 'style'=>'margin-right: 10px;')); ?>
			<?php echo CHtml::submitButton('To XLS', array('class'=>'action-btn', 'id'=>'action-btn-xls', 'name' => 'toxls')); ?>
		  </div>
        </div>
	</div>
<?php echo CHtml::endForm(); ?>

