<?php

/**
 * This is the model class for table "im_vw_purchaseordhd".
 *
 * The followings are the available columns in table 'im_vw_purchaseordhd':
 * @property integer $id
 * @property string $pp_purordnum
 * @property string $cm_supplierid
 * @property string $cm_orgname
 * @property string $Order_Date
 * @property string $Delivery_Date
 * @property string $pp_status
 */
class VwPurchaseordhd extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_vw_purchaseordhd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pp_purordnum, cm_supplierid, cm_orgname', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('pp_purordnum, cm_supplierid', 'length', 'max'=>50),
			array('cm_orgname', 'length', 'max'=>100),
			array('pp_status', 'length', 'max'=>20),
			array('Order_Date, Delivery_Date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pp_purordnum, cm_supplierid, cm_orgname, Order_Date, Delivery_Date, pp_status', 'safe', 'on'=>'search'),
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
			'pp_purordnum' => 'PO Number',
			'cm_supplierid' => ' Supplier Id',
			'cm_orgname' => 'Supplier Name',
			'Order_Date' => 'Order Date',
			'Delivery_Date' => 'Delivery Date',
			'pp_status' => 'PO Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('pp_purordnum',$this->pp_purordnum,true);
		$criteria->compare('cm_supplierid',$this->cm_supplierid,true);
		$criteria->compare('cm_orgname',$this->cm_orgname,true);
		$criteria->compare('Order_Date',$this->Order_Date,true);
		$criteria->compare('Delivery_Date',$this->Delivery_Date,true);
		$criteria->compare('pp_status',$this->pp_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VwPurchaseordhd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
