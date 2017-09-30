<?php

/**
 * This is the model class for table "hr_default".
 *
 * The followings are the available columns in table 'hr_default':
 * @property integer $id
 * @property string $pfconrate
 * @property integer $othours
 * @property string $otrate
 * @property integer $taxyear
 * @property integer $taxoffset
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Hrdefault extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr_default';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, othours, taxyear, taxoffset', 'numerical', 'integerOnly'=>true),
			array('pfconrate, otrate', 'length', 'max'=>20),
			array('insertuser, updateuser', 'length', 'max'=>50),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pfconrate, othours, otrate, taxyear, taxoffset, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'pfconrate' => 'Provident Fund Contributory Rate',
			'othours' => 'Over Time Hours',
			'otrate' => 'Over Time Rate',
			'taxyear' => 'Year',
			'taxoffset' => 'Offset',
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
		$criteria->compare('pfconrate',$this->pfconrate,true);
		$criteria->compare('othours',$this->othours);
		$criteria->compare('otrate',$this->otrate,true);
		$criteria->compare('taxyear',$this->taxyear);
		$criteria->compare('taxoffset',$this->taxoffset);
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
	 * @return Hrdefault the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
