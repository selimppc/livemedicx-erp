<?php

/**
 * This is the model class for table "am_vw_payinvc".
 *
 * The followings are the available columns in table 'am_vw_payinvc':
 * @property string $suppliercode
 * @property string $invoicnumber
 * @property string $amount
 */
class Vwpayinvc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'am_vw_payinvc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('suppliercode, invoicnumber', 'length', 'max'=>50),
			array('amount', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('suppliercode, invoicnumber, amount', 'safe', 'on'=>'search'),
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
			'suppliercode' => 'Suppliercode',
			'invoicnumber' => 'Invoicnumber',
			'amount' => 'Amount',
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

		$criteria->compare('suppliercode',$this->suppliercode,true);
		$criteria->compare('invoicnumber',$this->invoicnumber,true);
		$criteria->compare('amount',$this->amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vwpayinvc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
