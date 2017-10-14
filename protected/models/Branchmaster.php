<?php

/**
 * This is the model class for table "cm_branchmaster".
 *
 * The followings are the available columns in table 'cm_branchmaster':
 * @property string $cm_branch
 * @property string $cm_description
 * @property string $cm_currency
 * @property string $cm_contacperson
 * @property string $cm_designation
 * @property string $cm_mailingaddress
 * @property string $cm_phone
 * @property string $cm_cell
 * @property string $cm_fax
 * @property integer $active
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Branchcurrency[] $branchcurrencies
 */
class Branchmaster extends CActiveRecord
{
	public $supplier_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cm_branchmaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_branch', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('cm_branch, cm_phone, cm_cell, cm_fax', 'length', 'max'=>10),
			array('cm_description', 'length', 'max'=>100),
			array('cm_currency, cm_exchrate, cm_contacperson, cm_designation, insertuser, updateuser', 'length', 'max'=>50),
			array('cm_mailingaddress', 'length', 'max'=>250),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cm_branch, cm_description, cm_currency, cm_exchrate, cm_contacperson, cm_designation, cm_mailingaddress, cm_phone, cm_cell, cm_fax, active, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'branchcurrencies' => array(self::HAS_MANY, 'Branchcurrency', 'cm_branch'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cm_branch' => 'Branch',
			'cm_description' => 'Description',
			'cm_currency' => 'Currency',
            'cm_exchrate'=> 'Exchange Rate',
			'cm_contacperson' => 'Contact Person',
			'cm_designation' => 'Job Title',
			'cm_mailingaddress' => 'Mailing Address',
			'cm_phone' => 'Phone',
			'cm_cell' => 'Cell',
			'cm_fax' => 'Fax',
			'active' => 'Active',
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

		$criteria->compare('cm_branch',$this->cm_branch,true);
		$criteria->compare('cm_description',$this->cm_description,true);
		$criteria->compare('cm_currency',$this->cm_currency,true);
        $criteria->compare('cm_exchrate',$this->cm_exchrate,true);
		$criteria->compare('cm_contacperson',$this->cm_contacperson,true);
		$criteria->compare('cm_designation',$this->cm_designation,true);
		$criteria->compare('cm_mailingaddress',$this->cm_mailingaddress,true);
		$criteria->compare('cm_phone',$this->cm_phone,true);
		$criteria->compare('cm_cell',$this->cm_cell,true);
		$criteria->compare('cm_fax',$this->cm_fax,true);
		$criteria->compare('active',$this->active);
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
	 * @return Branchmaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
