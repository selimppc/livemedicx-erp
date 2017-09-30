<?php

/**
 * This is the model class for table "hr_trnheader".
 *
 * The followings are the available columns in table 'hr_trnheader':
 * @property integer $id
 * @property string $trnnumber
 * @property string $trndate
 * @property integer $trnyear
 * @property integer $trnperiod
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Trndetail[] $trndetails
 */
class Trnheader extends CActiveRecord
{
	
	public $salarytype;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr_trnheader';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('trnyear, trnperiod', 'numerical', 'integerOnly'=>true),
			array('trnnumber, insertuser, updateuser', 'length', 'max'=>50),
			array('trndate, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, trnnumber, trndate, trnyear, trnperiod, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'trndetails' => array(self::HAS_MANY, 'Trndetail', 'trnnumber'),
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
			'trndate' => 'Date',
			'trnyear' => 'Year',
			'trnperiod' => 'Period',
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
		$criteria->compare('trndate',$this->trndate,true);
		$criteria->compare('trnyear',$this->trnyear);
		$criteria->compare('trnperiod',$this->trnperiod);
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
	 * @return Trnheader the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
