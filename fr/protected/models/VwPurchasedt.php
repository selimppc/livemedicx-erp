<?php

/**
 * This is the model class for table "im_vw_purchasedt".
 *
 * The followings are the available columns in table 'im_vw_purchasedt':
 * @property string $pp_purordnum
 * @property string $cm_code
 * @property string $cm_name
 * @property string $pp_unit
 * @property integer $pp_unitqty
 * @property string $pp_quantity
 * @property string $pp_purchasrate
 * @property string $pp_totalamount
 */
class VwPurchasedt extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_vw_purchasedt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pp_purordnum, cm_code, cm_name', 'required'),
			array('pp_unitqty', 'numerical', 'integerOnly'=>true),
			array('pp_purordnum, cm_code, pp_unit', 'length', 'max'=>50),
			array('cm_name', 'length', 'max'=>200),
			array('pp_quantity', 'length', 'max'=>12),
			array('pp_purchasrate', 'length', 'max'=>20),
			array('pp_totalamount', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pp_purordnum, cm_code, cm_name, pp_unit, pp_unitqty, pp_quantity, pp_purchasrate, pp_totalamount', 'safe', 'on'=>'search'),
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
			'pp_purordnum' => 'Purchase Ord.Num',
			'cm_code' => 'Product Code',
			'cm_name' => 'Product Name',
			'pp_unit' => 'Unit',
			'pp_unitqty' => 'Unit Quantity',
			'pp_quantity' => 'Quantity',
			'pp_purchasrate' => 'Purchas Rate',
			'pp_totalamount' => 'Total Amount',
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
	public function search($pp_purordnum)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = "pp_purordnum = '$pp_purordnum' ";

		$criteria->compare('pp_purordnum',$this->pp_purordnum,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('cm_name',$this->cm_name,true);
		$criteria->compare('pp_unit',$this->pp_unit,true);
		$criteria->compare('pp_unitqty',$this->pp_unitqty);
		$criteria->compare('pp_quantity',$this->pp_quantity,true);
		$criteria->compare('pp_purchasrate',$this->pp_purchasrate,true);
		$criteria->compare('pp_totalamount',$this->pp_totalamount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VwPurchasedt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
