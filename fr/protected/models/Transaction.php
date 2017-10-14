<?php

/**
 * This is the model class for table "cm_transaction".
 *
 * The followings are the available columns in table 'cm_transaction':
 * @property string $cm_type
 * @property string $cm_trncode
 * @property string $cm_branch
 * @property integer $cm_lastnumber
 * @property integer $cm_increment
 * @property integer $cm_active
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Transaction extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cm_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_type, cm_trncode', 'required'),
			array('cm_trncode', 'length', 'max'=>10),
			array('cm_lastnumber, cm_increment, cm_active', 'numerical', 'integerOnly'=>true),
			array('cm_type, cm_trncode, cm_branch, insertuser, updateuser', 'length', 'max'=>50),
			array('cm_trncode', 'filter', 'filter'=>'strtoupper'),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cm_type, cm_trncode, cm_branch, cm_lastnumber, cm_increment, cm_active, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'cm_type' => 'Type',
			'cm_trncode' => 'Transaction code',
			'cm_branch' => 'Description',
			'cm_lastnumber' => 'Last Number',
			'cm_increment' => 'Increment',
			'cm_active' => 'Active',
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

		$criteria->compare('cm_type',$this->cm_type,true);
		$criteria->compare('cm_trncode',$this->cm_trncode,true);
		$criteria->compare('cm_branch',$this->cm_branch,true);
		$criteria->compare('cm_lastnumber',$this->cm_lastnumber);
		$criteria->compare('cm_increment',$this->cm_increment);
		$criteria->compare('cm_active',$this->cm_active);
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
	 * @return Transaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
