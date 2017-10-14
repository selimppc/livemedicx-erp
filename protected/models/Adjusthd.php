<?php

/**
 * This is the model class for table "im_adjusthd".
 *
 * The followings are the available columns in table 'im_adjusthd':
 * @property integer $id
 * @property string $transaction_number
 * @property string $DATE
 * @property string $branch
 * @property integer $adjustment_type
 * @property string $confirm_date
 * @property string $currency
 * @property string $exchange_rate
 * @property string $STATUS
 * @property string $inserttime
 * @property string $insertuser
 * @property string $updatetime
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Adjustdt[] $adjustdts
 */
class Adjusthd extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_adjusthd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inserttime', 'required'),
			array('adjustment_type', 'numerical', 'integerOnly'=>true),
			array('transaction_number, branch, STATUS, insertuser, updateuser', 'length', 'max'=>50),
			array('currency', 'length', 'max'=>10),
			array('exchange_rate', 'length', 'max'=>20),
			array('DATE, confirm_date, voucherno, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, transaction_number, DATE, branch, adjustment_type, confirm_date, currency, exchange_rate, STATUS, voucherno, inserttime, insertuser, updatetime, updateuser', 'safe', 'on'=>'search'),
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
			'adjustdts' => array(self::HAS_MANY, 'Adjustdt', 'transaction_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transaction_number' => 'Transaction Number',
			'DATE' => 'Date',
			'branch' => 'Branch',
			'adjustment_type' => 'Adjustment Type',
			'confirm_date' => 'Confirm Date',
			'currency' => 'Currency',
			'exchange_rate' => 'Exchange Rate',
			'STATUS' => 'Status',
            'voucherno'=> 'Voucher No',
			'inserttime' => 'Inserttime',
			'insertuser' => 'Insertuser',
			'updatetime' => 'Updatetime',
			'updateuser' => 'Updateuser',
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
		$criteria->compare('transaction_number',$this->transaction_number,true);
		$criteria->compare('DATE',$this->DATE,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('adjustment_type',$this->adjustment_type);
		$criteria->compare('confirm_date',$this->confirm_date,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('exchange_rate',$this->exchange_rate,true);
		$criteria->compare('STATUS',$this->STATUS,true);
        $criteria->compare('voucherno',$this->voucherno,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria -> order = "id DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Adjusthd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
