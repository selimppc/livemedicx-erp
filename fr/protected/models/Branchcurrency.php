<?php

/**
 * This is the model class for table "cm_branchcurrency".
 *
 * The followings are the available columns in table 'cm_branchcurrency':
 * @property integer $id
 * @property string $cm_branch
 * @property string $cm_currency
 * @property string $cm_description
 * @property string $cm_exchangerate
 * @property integer $cm_active
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Branchmaster $cmBranch
 */
class Branchcurrency extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cm_branchcurrency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_active', 'numerical', 'integerOnly'=>true),
			array('cm_branch, cm_currency', 'length', 'max'=>10),
			array('cm_description', 'length', 'max'=>100),
			array('cm_exchangerate', 'length', 'max'=>20),
			array('insertuser, updateuser', 'length', 'max'=>50),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cm_branch, cm_currency, cm_description, cm_exchangerate, cm_active, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'cm_branch' => array(self::BELONGS_TO, 'Branchmaster', 'cm_branch'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cm_branch' => 'Branch',
			'cm_currency' => 'Currency',
			'cm_description' => 'Description',
			'cm_exchangerate' => 'Exchange Rate',
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

		//$criteria-> condition = "cm_branch = 'cm_branch'";
		
		$criteria->compare('id',$this->id);
		$criteria->compare('cm_branch',$this->cm_branch,true);
		$criteria->compare('cm_currency',$this->cm_currency,true);
		$criteria->compare('cm_description',$this->cm_description,true);
		$criteria->compare('cm_exchangerate',$this->cm_exchangerate,true);
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
	 * @return Branchcurrency the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
