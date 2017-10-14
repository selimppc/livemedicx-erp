<?php

/**
 * This is the model class for table "cm_suppliermaster".
 *
 * The followings are the available columns in table 'cm_suppliermaster':
 * @property string $cm_supplierid
 * @property string $cm_group
 * @property string $cm_orgname
 * @property string $cm_address
 * @property string $cm_district
 * @property string $cm_post
 * @property string $cm_policest
 * @property string $cm_postcode
 * @property string $cm_contactperson
 * @property string $cm_phone
 * @property string $cm_cellphone
 * @property string $cm_fax
 * @property string $cm_email
 * @property string $cm_url
 * @property string $cm_status
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Suppliermaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cm_suppliermaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_supplierid, cm_group, cm_orgname, cm_contactperson', 'required'),
			array('cm_supplierid, cm_group, cm_district, cm_post, cm_policest, cm_cellphone, cm_email, cm_url, cm_status, insertuser, updateuser', 'length', 'max'=>50),
			array('cm_orgname, cm_contactperson', 'length', 'max'=>100),
			array('cm_address', 'length', 'max'=>200),
			array('cm_postcode, cm_fax', 'length', 'max'=>10),
			array('cm_phone', 'length', 'max'=>20),
			array('cm_supplierid, cm_group, cm_orgname, cm_address, cm_district, cm_post, cm_policest, cm_postcode, cm_contactperson, cm_phone, cm_cellphone, cm_fax, cm_email, cm_url, cm_status, inserttime, updatetime, insertuser, updateuser', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cm_supplierid, cm_group, cm_orgname, cm_address, cm_district, cm_post, cm_policest, cm_postcode, cm_contactperson, cm_phone, cm_cellphone, cm_fax, cm_email, cm_url, cm_status, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'cm_supplierid' => 'Supplier Id',
			'cm_group' => 'Group',
			'cm_orgname' => 'Supplier Name',
			'cm_address' => 'Address',
			'cm_district' => 'District',
			'cm_post' => 'Post',
			'cm_policest' => 'Police Station',
			'cm_postcode' => 'Post Code',
			'cm_contactperson' => 'Contact Person',
			'cm_phone' => 'Phone',
			'cm_cellphone' => 'Cell Phone',
			'cm_fax' => 'Fax',
			'cm_email' => 'Email',
			'cm_url' => 'Url',
			'cm_status' => 'Status',
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

		$criteria->compare('cm_supplierid',$this->cm_supplierid,true);
		$criteria->compare('cm_group',$this->cm_group,true);
		$criteria->compare('cm_orgname',$this->cm_orgname,true);
		//$criteria->compare('cm_address',$this->cm_address,true);
		//$criteria->compare('cm_district',$this->cm_district,true);
		//$criteria->compare('cm_post',$this->cm_post,true);
		//$criteria->compare('cm_policest',$this->cm_policest,true);
		//$criteria->compare('cm_postcode',$this->cm_postcode,true);
		//$criteria->compare('cm_contactperson',$this->cm_contactperson,true);
		//$criteria->compare('cm_phone',$this->cm_phone,true);
		$criteria->compare('cm_cellphone',$this->cm_cellphone,true);
		//$criteria->compare('cm_fax',$this->cm_fax,true);
		$criteria->compare('cm_email',$this->cm_email,true);
		//$criteria->compare('cm_url',$this->cm_url,true);
		$criteria->compare('cm_status',$this->cm_status,true);
		//$criteria->compare('inserttime',$this->inserttime,true);
		//$criteria->compare('updatetime',$this->updatetime,true);
		//$criteria->compare('insertuser',$this->insertuser,true);
		//$criteria->compare('updateuser',$this->updateuser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Suppliermaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getStatusOptions(){
            return array('Open' => 'Open', 'Close' => 'Close');
        }
}
