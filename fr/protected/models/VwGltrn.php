<?php

/**
 * This is the model class for table "am_vw_gltrn".
 *
 * The followings are the available columns in table 'am_vw_gltrn':
 * @property string $am_vouchernumber
 * @property string $am_referance
 * @property string $am_date
 * @property integer $am_year
 * @property integer $am_period
 * @property string $am_branch
 * @property string $am_accountcode
 * @property string $am_description
 * @property string $debit
 * @property string $credit
 */
class VwGltrn extends CActiveRecord
{
	public $from_date;
	public $to_date;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'am_vw_gltrn';
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
			array('am_year, am_period', 'numerical', 'integerOnly'=>true),
			array('am_vouchernumber, am_branch, am_accountcode', 'length', 'max'=>50),
			array('am_referance', 'length', 'max'=>150),
			array('am_description', 'length', 'max'=>100),
			array('debit, credit', 'length', 'max'=>20),
			array('am_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('am_vouchernumber, am_referance, am_date, am_year, am_period, am_branch, am_accountcode, am_description, debit, credit', 'safe', 'on'=>'search'),
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
			'am_referance' => 'Referance',
			'am_date' => 'Date',
			'am_year' => 'Year',
			'am_period' => 'Period',
			'am_branch' => 'Branch',
			'am_accountcode' => 'Account Code',
			'am_description' => 'Account Description',
			'debit' => 'Debit',
			'credit' => 'Credit',
		
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

		$criteria->compare('am_vouchernumber',$this->am_vouchernumber,true);
		$criteria->compare('am_referance',$this->am_referance,true);
		$criteria->compare('am_date',$this->am_date,true);
		$criteria->compare('am_year',$this->am_year);
		$criteria->compare('am_period',$this->am_period);
		$criteria->compare('am_branch',$this->am_branch,true);
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('am_description',$this->am_description,true);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);
		
		$criteria->condition = "am_vouchernumber = '$am_vouchernumber' ";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function customJournalTransaction($am_vouchernumber, $am_branch, $from_date, $to_date)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('am_vouchernumber',$this->am_vouchernumber,true);
		$criteria->compare('am_referance',$this->am_referance,true);
		$criteria->compare('am_date',$this->am_date,true);
		$criteria->compare('am_year',$this->am_year);
		$criteria->compare('am_period',$this->am_period);
		$criteria->compare('am_branch',$this->am_branch,true);
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('am_description',$this->am_description,true);
		$criteria->compare('debit',$this->debit,true);
		$criteria->compare('credit',$this->credit,true);
		
		$criteria->condition = "am_vouchernumber = '$am_vouchernumber' ";
		$criteria -> addCondition("am_branch = '{$am_branch}'");
		$criteria -> addBetweenCondition ('am_date', $from_date, $to_date);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VwGltrn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
