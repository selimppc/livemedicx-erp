<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Inventory',
	'Report'=>array('sareport/inventoryReports'),
	'Item Ledger',
);
$this->menu=array(
    array('label'=>'<< Back to Report', 'url'=>array('sareport/inventoryReports')),
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
		width: 220px;
		font-size: 14px;
	}
	table tr th{
		width: 300px;
	}

</style>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"><b>  Inventaire d'articles :</b> Sélectionner la Branche et faire entrer  dates désirées,de et jusqu'à. Pour consulter le rapport en format pdf ou xls cliquez sur <b>PDF</b> & <b>XLS</b>. *** L'affichage des données dans le livres comptable est nécessaire pour la consultation et le résultat. Vous pouvez revenir aux Outils de Rapportage  pour afficher tous les outils de rapportage en cliquant sur l'onglet du menu <b>"Retour au rapport»</b>. </div>
</div>
<div style="clear:both;"</div>

<div>
<?php echo CHtml::beginForm($this->createUrl('/sareport/LedReport'), 'POST', array('target'=>'_blank'))?>
		
		
<table style="text-align: left; ">
	  <tr>
	    <th> Branch: </th>
	    <th> From Date: </th>
	    <th> To Date: </th>
	  </tr>
	  <tr>
	  	<td> <?php echo CHtml::activeDropDownList($model, 'cm_branch', CHtml::listData(Branchmaster::model()->findAll(array('order'=>'cm_branch ASC')), 'cm_branch', 'cm_description')); ?> </td>
	  	<td>
	  		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'name'=>'from_date', //attribute name
					'language'=> '',
					'flat'=>true,//remove to hide the datepicker
					'mode'=>'date', 
					'options'=>array(
						'dateFormat' => 'yy-mm-dd',
						'showAnim'=>'fold',
						'changeMonth' => 'true',
						'changeYear' => 'true',
						'showOtherMonths' => 'true',
						'selectOtherMonths' => 'true',
						'showOn' => 'both',
						'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
						//'showButtonPanel'=>true,
				        //'minDate'=>-5,
				        'maxDate'=>"+1M +5D",
				),
				
				'htmlOptions'=>array(
					'value'=> CTimestamp::formatDate('Y-m-d'),
					'required' => 'required',
				),
			));?>  
	  	</td>
	  	<td> 
	  		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
				$this->widget('CJuiDateTimePicker',array(
					'name'=>'to_date', //attribute name
					'model'=>'model',
					'language'=> '',
					'flat'=>true,//remove to hide the datepicker
					'mode'=>'date', 
					'options'=>array(
						'dateFormat' => 'yy-mm-dd',
						'showAnim'=>'fold',
						'changeMonth' => 'true',
						'changeYear' => 'true',
						'showOtherMonths' => 'true',
						'selectOtherMonths' => 'true',
						'showOn' => 'both',
						'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
						//'showButtonPanel'=>true,
				        //'minDate'=>-5,
				        //'maxDate'=>"+1M +5D",
				),
				
				'htmlOptions'=>array(
					'value'=> CTimestamp::formatDate('Y-m-d'),
					'required' => 'required',
				),
			));?> 	
	  	</td>
	  </tr>
</table>

	<div class="row buttons">
		<div class="row status-container">
          <div class="span4 action-bar">
			<?php echo CHtml::submitButton('Generate', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
			<?php //echo CHtml::link('Proceed',array('/billing/default/Create')); ?> 
		  </div>
        </div>
	</div>
<?php echo CHtml::endForm(); ?>
</div>
