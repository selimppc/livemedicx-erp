<?php

/**
 * This is the model class for table "im_vw_grndetail".
 *
 * The followings are the available columns in table 'im_vw_grndetail':
 * @property integer $id
 * @property string $im_grnnumber
 * @property string $im_purordnum
 * @property string $cm_code
 * @property string $cm_name
 * @property string $im_BatchNumber
 * @property string $im_ExpireDate
 * @property integer $im_RcvQuantity
 * @property string $im_costprice
 * @property string $im_unit
 * @property integer $im_unitqty
 * @property string $im_rowamount
 */
class VwGrndetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_vw_grndetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_name', 'required'),
			array('id, im_RcvQuantity, im_unitqty', 'numerical', 'integerOnly'=>true),
			array('im_grnnumber, im_purordnum, cm_code, im_BatchNumber, im_unit', 'length', 'max'=>50),
			array('cm_name', 'length', 'max'=>200),
			array('im_costprice, im_rowamount', 'length', 'max'=>20),
			array('im_ExpireDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, im_grnnumber, im_purordnum, cm_code, cm_name, im_BatchNumber, im_ExpireDate, im_RcvQuantity, im_costprice, im_unit, im_unitqty, im_rowamount', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'im_grnnumber' => 'GRN Number',
			'im_purordnum' => 'Purchase Order Number',
			'cm_code' => 'Product Code',
			'cm_name' => 'Product Name',
			'im_BatchNumber' => 'Batch Number',
			'im_ExpireDate' => 'Expiry Date',
			'im_RcvQuantity' => 'Receive Quantity',
			'im_costprice' => 'Cost Price',
			'im_unit' => 'Unit',
			'im_unitqty' => 'Unit Quantity',
			'im_rowamount' => 'Total Value',
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
	public function search($im_grnnumber)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = "im_grnnumber = '$im_grnnumber' ";
		
		$criteria->compare('id',$this->id);
		$criteria->compare('im_grnnumber',$this->im_grnnumber,true);
		$criteria->compare('im_purordnum',$this->im_purordnum,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('cm_name',$this->cm_name,true);
		$criteria->compare('im_BatchNumber',$this->im_BatchNumber,true);
		$criteria->compare('im_ExpireDate',$this->im_ExpireDate,true);
		$criteria->compare('im_RcvQuantity',$this->im_RcvQuantity);
		$criteria->compare('im_costprice',$this->im_costprice,true);
		$criteria->compare('im_unit',$this->im_unit,true);
		$criteria->compare('im_unitqty',$this->im_unitqty);
		$criteria->compare('im_rowamount',$this->im_rowamount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VwGrndetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
