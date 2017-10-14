<?php

/**
 * This is the model class for table "pp_requisitiondt".
 *
 * The followings are the available columns in table 'pp_requisitiondt':
 * @property integer $id
 * @property string $pp_requisitionno
 * @property string $cm_code
 * @property string $pp_unit
 * @property integer $pp_quantity
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property CmProductmaster $cmCode
 * @property Requisitionhd $ppRequisitionno
 */
class Requisitiondt extends CActiveRecord
{
	
	public $cm_supplierid;
	public $pp_date;
	public $pp_branch;
	public $pp_note;
	public $pp_status;
	
	public $cm_name;
	public $cm_description;

    public $product_search;

	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pp_requisitiondt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pp_requisitionno, cm_code, pp_unit', 'required'),
			array('pp_quantity', 'numerical', 'integerOnly'=>true),
			array('pp_requisitionno, cm_code, pp_unit, insertuser, updateuser', 'length', 'max'=>50),
			array('inserttime, updatetime', 'safe'),
            array('pp_quantity', 'greaterThanZero' ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pp_requisitionno, cm_code, product_search, pp_unit, pp_quantity, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
		);
	}

    public function greaterThanZero($pp_quantity)
    {

        if ($this->$pp_quantity<=0)
            $this->addError($pp_quantity, 'Quantity should not be blank or zero');

    }


    /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product' => array(self::BELONGS_TO, 'Productmaster', 'cm_code'),
			'Product_Name' => array(self::BELONGS_TO, 'Productmaster', 'cm_name'),
			'pp_Requisition_no' => array(self::BELONGS_TO, 'Requisitionhd', 'pp_requisitionno'),
			'pp_requisitionno' => array( self::BELONGS_TO, 'Requisitionhd', 'pp_requisitionno' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pp_requisitionno' => 'Requisition No',
			'cm_code' => 'Product Code',
			'pp_unit' => 'Unit',
			'pp_quantity' => 'Quantity',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',
		
			'cm_name' => 'Product Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($pp_requisitionno)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->together = true;
		$criteria->condition = "pp_requisitionno = '$pp_requisitionno' ";

		$criteria->compare('id',$this->id);
		$criteria->compare('pp_requisitionno',$this->pp_requisitionno,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('pp_unit',$this->pp_unit,true);
		$criteria->compare('pp_quantity',$this->pp_quantity);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);
		$criteria->order = "id DESC";

        $criteria->with = array( 'product' );
        $criteria->compare( 'product.cm_name', $this->product_search, true );
		
		//$criteria->select = 't.*, m.cm_name';
		//$criteria->condition = "t.pp_requisitionno = '$pp_requisitionno' ";
		//$criteria->join = 'INNER JOIN cm_productmaster m ON t.cm_code = m.cm_code';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		}

		public function searchView($pp_requisitionno)
		{

		// $pp_requisitionno= Yii::app()->Request->Getpost('pp_requisitionno');
		
		$criteria=new CDbCriteria();

		// $criteria->compare('t. pp_requisitionno',$this->pp_requisitionno, true);
		$criteria->condition = "t.pp_requisitionno = '$pp_requisitionno' ";
		$criteria->order= 'id DESC';


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		}
	

	
		/**
		 * Returns the static model of the specified AR class.
		 * Please note that you should have this exact method in all your CActiveRecord descendants!
		 * @param string $className active record class name.
		 * @return Requisitiondt the static model class
		 */
		public static function model($className=__CLASS__)
		{
			return parent::model($className);
		}
	
	
		public function getUnitOptions() {
		        return CHtml::listData(Productmaster::model()->findAll(), 'cm_purunit', 'cm_purunit');
		}
		
		
		
		public function searchEmployees()
        {
                $criteria=new CDbCriteria;
                $criteria->together = true;
                
                $criteria->compare('id',$this->id);
				$criteria->compare('pp_requisitionno',$this->pp_requisitionno,true);
				$criteria->compare('cm_code',$this->cm_code,true);
				$criteria->compare('pp_unit',$this->pp_unit,true);
				$criteria->compare('pp_quantity',$this->pp_quantity);
 
                $criteria->select = 't.*, m.cm_supplierid, m.pp_date, m.pp_branch, m.pp_note, m.pp_status';
				$criteria->condition = 't.pp_requisitionno = m.pp_requisitionno';
				$criteria->join = 'INNER JOIN pp_requisitionhd m ON t.pp_requisitionno = m.pp_requisitionno'; 
				$criteria->group = 't.pp_requisitionno';

                return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,   
                ));
        }
		
		
}
