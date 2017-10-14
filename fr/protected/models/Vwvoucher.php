<?php

/**
 * This is the model class for table "am_vw_voucher".
 *
 * The followings are the available columns in table 'am_vw_voucher':
 * @property string $am_vouchernumber
 * @property string $am_accountcode
 * @property string $am_description
 * @property string $am_subacccode
 * @property string $am_currency
 * @property string $am_exchagerate
 * @property string $prime_debit
 * @property string $prime_credit
 * @property string $base_debit
 * @property string $base_credit
 */
class Vwvoucher extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'am_vw_voucher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('am_vouchernumber, am_accountcode, am_description', 'required'),
			array('am_vouchernumber, am_accountcode, am_subacccode', 'length', 'max'=>50),
			array('am_description', 'length', 'max'=>100),
			array('am_currency', 'length', 'max'=>10),
			array('am_exchagerate, prime_debit, prime_credit, base_debit, base_credit', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('am_vouchernumber, am_accountcode, am_description, am_subacccode, am_currency, am_exchagerate, prime_debit, prime_credit, base_debit, base_credit', 'safe', 'on'=>'search'),
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
			'am_vouchernumber' => 'Voucher Number',
			'am_accountcode' => 'Account Code',
			'am_description' => 'A/C Description',
			'am_subacccode' => 'Sub acccode',
			'am_currency' => 'Currency',
			'am_exchagerate' => 'Exchage Rate',
			'prime_debit' => 'Debit',
			'prime_credit' => 'Credit',
			'base_debit' => 'Debit (Local Currency)',
			'base_credit' => 'Credit (Local Currency)',
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
	public function search($am_vouchernumber)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        $criteria->condition = "am_vouchernumber = '$am_vouchernumber'";

		$criteria->compare('am_vouchernumber',$this->am_vouchernumber,true);
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('am_description',$this->am_description,true);
		$criteria->compare('am_subacccode',$this->am_subacccode,true);
		$criteria->compare('am_currency',$this->am_currency,true);
		$criteria->compare('am_exchagerate',$this->am_exchagerate,true);
		$criteria->compare('prime_debit',$this->prime_debit,true);
		$criteria->compare('prime_credit',$this->prime_credit,true);
		$criteria->compare('base_debit',$this->base_debit,true);
		$criteria->compare('base_credit',$this->base_credit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vwvoucher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
