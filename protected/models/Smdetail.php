<?php

/**
 * This is the model class for table "sm_detail".
 *
 * The followings are the available columns in table 'sm_detail':
 * @property integer $id
 * @property string $sm_number
 * @property string $cm_code
 * @property string $sm_unit
 * @property string $sm_rate
 * @property integer $sm_bonusqty
 * @property integer $sm_quantity
 * @property string $sm_tax_rate
 * @property string $sm_tax_amt
 * @property string $sm_lineamt
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property CmProductmaster $cmCode
 * @property SmHeader $smNumber
 */
class Smdetail extends CActiveRecord
{
	public $cm_name;
	public $cm_description;
	public $product_search;
	public $product_name;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sm_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sm_number', 'required'),
			array('sm_bonusqty, sm_quantity', 'numerical', 'integerOnly'=>true),
			array('sm_number, sm_rate, sm_tax_rate, sm_tax_amt, sm_lineamt', 'length', 'max'=>20),
			array('cm_code, sm_unit, insertuser, updateuser', 'length', 'max'=>50),
			array('sm_unit_qty, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sm_number, cm_code, product_search, sm_unit, sm_unit_qty, sm_rate, sm_bonusqty, sm_quantity, sm_tax_rate, sm_tax_amt, sm_lineamt, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cmCode' => array(self::BELONGS_TO, 'CmProductmaster', 'cm_code'),
			'smNumber' => array(self::BELONGS_TO, 'SmHeader', 'sm_number'),
			'product' => array(self::BELONGS_TO, 'Productmaster', 'cm_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sm_number' => 'Sales Number',
			'cm_code' => 'Product Code',
			'sm_unit' => 'Unit',
			'sm_rate' => 'Rate',
			'sm_bonusqty' => 'Bonusqty',
			'sm_quantity' => 'Quantity',
			'sm_unit_qty' => 'Unit Quantity',
			'sm_tax_rate' => 'Tax Rate',
			'sm_tax_amt' => 'Tax Amountt',
			'sm_lineamt' => 'Line Amount',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',

			'cm_name'=> 'Product Name',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = '';

		$criteria->compare('id',$this->id);
		$criteria->compare('sm_number',$this->sm_number,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('sm_unit',$this->sm_unit,true);
		$criteria->compare('sm_rate',$this->sm_rate,true);
		$criteria->compare('sm_bonusqty',$this->sm_bonusqty);
		$criteria->compare('sm_quantity',$this->sm_quantity);
		$criteria->compare('sm_unit_qty',$this->sm_unit_qty);
		$criteria->compare('sm_tax_rate',$this->sm_tax_rate,true);
		$criteria->compare('sm_tax_amt',$this->sm_tax_amt,true);
		$criteria->compare('sm_lineamt',$this->sm_lineamt,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	//Invoice Details
	public function searchInvoiceDetail($sm_number)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		//$criteria->condition = "sm_number = '{$sm_number}' ";
		$criteria->condition = '';
		$criteria->compare('id',$this->id);
		$criteria->compare('sm_number',$this->sm_number,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('sm_unit',$this->sm_unit,true);
		$criteria->compare('sm_rate',$this->sm_rate,true);
		$criteria->compare('sm_bonusqty',$this->sm_bonusqty);
		$criteria->compare('sm_quantity',$this->sm_quantity);
		$criteria->compare('sm_unit_qty',$this->sm_unit_qty);
		$criteria->compare('sm_tax_rate',$this->sm_tax_rate,true);
		$criteria->compare('sm_tax_amt',$this->sm_tax_amt,true);
		$criteria->compare('sm_lineamt',$this->sm_lineamt,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

		$criteria->select = 't.*, m.cm_name';
		$criteria->condition ="sm_number = '{$sm_number}' ";
		$criteria->join = 'INNER JOIN cm_productmaster m ON t.cm_code = m.cm_code';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Smdetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function searchDetail($sm_number)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = '';
		$criteria->condition = "sm_number = '$sm_number' ";

		$criteria->compare('id',$this->id);
		$criteria->compare('sm_number',$this->sm_number,true);
		$criteria->compare('cm_code',$this->cm_code,true,'OR');
		$criteria->compare('sm_unit',$this->sm_unit,true);
		$criteria->compare('sm_rate',$this->sm_rate,true);
		$criteria->compare('sm_bonusqty',$this->sm_bonusqty);
		$criteria->compare('sm_quantity',$this->sm_quantity);
		$criteria->compare('sm_unit_qty',$this->sm_unit_qty);
		$criteria->compare('sm_tax_rate',$this->sm_tax_rate,true);
		$criteria->compare('sm_tax_amt',$this->sm_tax_amt,true);
		$criteria->compare('sm_lineamt',$this->sm_lineamt,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

		$criteria->with = array( 'product' );
		$criteria->compare( 'product.cm_name', $this->product_search, true,'OR' );

		$criteria->order = "id DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
