<?php
/* @var $this RequisitiondtController */
/* @var $model Requisitiondt */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requisitiondt-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,

)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_requisitionno'); ?>
		<?php echo $form->textField($model,'pp_requisitionno' ); ?>
		<?php echo $form->error($model,'pp_requisitionno'); ?>
	</div>

	<script type="text/javascript">
		function myFunction(){
			var str = document.getElementById("selectid").value;
			document.getElementById("selectid").value = str.split("-",1);
			addCodeid();
		}

		function addCodeid(){
	
				var id=	$('#selectid').val();
				//alert(id);
				$.ajax({
					url: "<?php echo Yii::app()->createUrl('requisitiondt/loadunit') ?>"+'/'+id,
					//type: 'GET',
					dataType: "json"
				}).success(function(data){

			        	//$('#data').append(JSON.stringify(data));
			        	//console.log(data);
			        	//return false;
			        	
						$.each(data, function(i, value) {
							//console.log(value.cm_purunit);
						   $('#unitid').append($('<option>').text(value.cm_purunit).attr('value', value.cmpurunit));
						});

					});
				return false;
			}
		
			
		</script>
	
	<div class="row" >
		<?php echo $form->labelEx($model, 'cm_code'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		        'name'=>'cm_name',
				'id' =>'selectid',
				'model'=>$model, //Model object
				'attribute'=>'cm_code', //attribute name
		        'sourceUrl' => Yii::app()->createUrl('requisitiondt/Acomplete'),
				//'source' => array_keys(CHtml::listData(Productmaster::model()->findAll(array('select' => 'cm_code')), 'cm_name', 'cm_code')),
				
		        'options'=>array(
		            'minLength'=>'1',
					'showAnim'=>'fold',
					'type' => 'get',
					
		        ),
		 
		        'htmlOptions'=>array(
		            'class'=>'input-1',
		          	'onblur' => "myFunction()",
		        ),
		    )); ?>

		<?php echo $form->error($model,'cm_code'); ?>
	</div>


	<div class="row" id="drophidden">
		<?php echo $form->labelEx($model,'pp_unit'); ?>
		<?php  echo $form->dropDownList($model,'pp_unit', array(), array('class'=>'unitclass', 'id'=>'unitid'));?>
		<?php //echo $form->textField($model,'pp_unit', array(), array('id'=>'unitid', 'disable'=>'disable'));?>
		<?php echo $form->error($model,'pp_unit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pp_quantity'); ?>
		<?php echo $form->textField($model,'pp_quantity'); ?>
		<?php echo $form->error($model,'pp_quantity'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'inserttime'); ?>
		<?php echo $form->hiddenField($model,'inserttime'); ?>
		<?php //echo $form->error($model,'inserttime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updatetime'); ?>
		<?php echo $form->hiddenField($model,'updatetime'); ?>
		<?php //echo $form->error($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'insertuser'); ?>
		<?php echo $form->hiddenField($model,'insertuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'insertuser'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updateuser'); ?>
		<?php echo $form->hiddenField($model,'updateuser',array('size'=>50,'maxlength'=>50)); ?>
		<?php //echo $form->error($model,'updateuser'); ?>
	</div>


	<div class="row buttons">
	<div class="row status-container">
          <div class="span4 action-bar">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?>
		  </div>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<?php //$this->widget('zii.widgets.grid.CGridView', array(
	//'id'=>'requisitiondt-grid',
	
	//'dataProvider'=>$model->searchView($pp_requisitionno),
	
	//'columns'=>array(
		//'id',
		//'pp_requisitionno',
		//'cm_code',
		//'pp_unit',
		//'pp_quantity',
		///array(
			//'class'=>'CButtonColumn',
		//),
	//),
//)); ?>
