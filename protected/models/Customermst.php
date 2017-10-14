<?php

/**
 * This is the model class for table "cm_customermst".
 *
 * The followings are the available columns in table 'cm_customermst':
 * @property string $cm_cuscode
 * @property string $cm_name
 * @property string $cm_address
 * @property string $cm_territory
 * @property string $cm_cellnumber
 * @property string $cm_phone
 * @property string $cm_fax
 * @property string $cm_email
 * @property string $cm_branch
 * @property string $cm_market
 * @property string $cm_sp
 * @property string $cm_creditlimit
 * @property string $cm_hub
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Customermst extends CActiveRecord
{
    public $country_code;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cm_customermst';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_name,cm_email', 'required'),
			array('cm_cuscode, cm_creditlimit', 'length', 'max'=>20),
			array('cm_name, cm_group, c_status, c_type', 'length', 'max'=>100),
			array('cm_address', 'length', 'max'=>250),
			array('cm_territory, cm_cellnumber, cm_phone, cm_fax, cm_branch, cm_market, cm_sp, cm_hub, insertuser, updateuser', 'length', 'max'=>50),
			array('cm_email', 'length', 'max'=>150),
			array('gerant_id, is_gerant, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cm_cuscode, cm_name,gerant_id, is_gerant, cm_address, cm_territory, cm_group,c_type, cm_cellnumber, cm_phone, cm_fax, cm_email, cm_branch, cm_market, cm_sp, cm_creditlimit, cm_hub,c_status, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'cm_cuscode' => 'Customer Code',
			'cm_name' => 'Customer Name',
			'gerant_id' => 'Gerant ID',
			'is_gerant' => 'Is Gerant',
			'cm_address' => 'Address',
			'cm_territory' => 'Territory',
			'cm_group' => 'Customer Group',
			'c_type'=>'Customer Type',
	
			'cm_cellnumber' => 'Mobile/Cell',
			'cm_phone' => 'Phone',
			'cm_fax' => 'Fax',
			'cm_email' => 'Email',
			'cm_branch' => 'Branch',
			'cm_market' => 'Area',
			'cm_sp' => 'Sales Person',
			'cm_creditlimit' => 'Credit Limit',
			'cm_hub' => 'Hub',
			'c_status'=> 'Status',
		
			'inserttime' => 'Insert Time',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insert User',
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

		$criteria->compare('cm_cuscode',$this->cm_cuscode,true);
		$criteria->compare('cm_name',$this->cm_name,true);
		$criteria->compare('gerant_id',$this->gerant_id,true);
		$criteria->compare('cm_address',$this->cm_address,true);
		$criteria->compare('cm_territory',$this->cm_territory,true);
		$criteria->compare('cm_group',$this->cm_group,true);
		$criteria->compare('c_type',$this->c_type,true);
		$criteria->compare('cm_cellnumber',$this->cm_cellnumber,true);
		$criteria->compare('cm_phone',$this->cm_phone,true);
		$criteria->compare('cm_fax',$this->cm_fax,true);
		$criteria->compare('cm_email',$this->cm_email,true);
		$criteria->compare('cm_branch',$this->cm_branch,true);
		$criteria->compare('cm_market',$this->cm_market,true);
		$criteria->compare('cm_sp',$this->cm_sp,true);
		$criteria->compare('cm_creditlimit',$this->cm_creditlimit,true);
		$criteria->compare('cm_hub',$this->cm_hub,true);
		$criteria->compare('c_status',$this->c_status,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria -> order = "inserttime DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public function searchCustomerGroup()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('cm_cuscode',$this->cm_cuscode,true);
		$criteria->compare('cm_name',$this->cm_name,true);
		$criteria->compare('gerant_id',$this->gerant_id,true);
		$criteria->compare('cm_address',$this->cm_address,true);
		$criteria->compare('cm_territory',$this->cm_territory,true);
		$criteria->compare('cm_group',$this->cm_group,true);
		$criteria->compare('c_type',$this->c_type,true);
		$criteria->compare('cm_cellnumber',$this->cm_cellnumber,true);
		$criteria->compare('cm_phone',$this->cm_phone,true);
		$criteria->compare('cm_fax',$this->cm_fax,true);
		$criteria->compare('cm_email',$this->cm_email,true);
		$criteria->compare('cm_branch',$this->cm_branch,true);
		$criteria->compare('cm_market',$this->cm_market,true);
		$criteria->compare('cm_sp',$this->cm_sp,true);
		$criteria->compare('cm_creditlimit',$this->cm_creditlimit,true);
		$criteria->compare('cm_hub',$this->cm_hub,true);
		$criteria->compare('c_status',$this->c_status,true);
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
	 * @return Customermst the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
