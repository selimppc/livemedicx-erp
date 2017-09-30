<?php

/**
 * This is the model class for table "hr_trndetail".
 *
 * The followings are the available columns in table 'hr_trndetail':
 * @property integer $id
 * @property string $trnnumber
 * @property string $empid
 * @property string $salarytype
 * @property string $amount
 * @property string $percent
 * @property integer $timeofbasic
 * @property string $areaamt
 * @property string $adjustment
 * @property string $othour
 * @property integer $daydeduction
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Trnheader $trnnumber0
 */
class Trndetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr_trndetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timeofbasic, daydeduction', 'numerical', 'integerOnly'=>true),
			array('trnnumber, empid, salarytype, insertuser, updateuser', 'length', 'max'=>50),
			array('amount, percent, areaamt, adjustment, othour', 'length', 'max'=>20),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, trnnumber, empid, salarytype, amount, percent, timeofbasic, areaamt, adjustment, othour, daydeduction, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'trnnumber0' => array(self::BELONGS_TO, 'Trnheader', 'trnnumber'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'trnnumber' => 'Transaction Number',
			'empid' => 'Employee ID',
			'salarytype' => 'Salary Type',
			'amount' => 'Amount',
			'percent' => 'Percent',
			'timeofbasic' => 'Time of Basic',
			'areaamt' => 'Area Amount',
			'adjustment' => 'Adjustment',
			'othour' => 'Over Time Hour',
			'daydeduction' => 'Day Deduction',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
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
		$criteria->compare('trnnumber',$this->trnnumber,true);
		$criteria->compare('empid',$this->empid,true);
		$criteria->compare('salarytype',$this->salarytype,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('percent',$this->percent,true);
		$criteria->compare('timeofbasic',$this->timeofbasic);
		$criteria->compare('areaamt',$this->areaamt,true);
		$criteria->compare('adjustment',$this->adjustment,true);
		$criteria->compare('othour',$this->othour,true);
		$criteria->compare('daydeduction',$this->daydeduction);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Trndetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
