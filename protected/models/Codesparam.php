<?php

/**
 * This is the model class for table "cm_codesparam".
 *
 * The followings are the available columns in table 'cm_codesparam':
 * @property string $cm_type
 * @property string $cm_code
 * @property string $cm_desc
 * @property integer $cm_active
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Codesparam extends CActiveRecord
{
    public $account_name;
    public $return_account;
    public $stock_account;
    public $disc_account;
    public $tax_account;
    public $revenue_account;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cm_codesparam';
	}
	
	public function primaryKey(){
	    return array('cm_type', 'cm_code');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_type, cm_code', 'required'),
			array('cm_active', 'numerical', 'integerOnly'=>true),
			array('cm_code', 'filter', 'filter'=>'strtoupper'),
			array('cm_type, cm_code, cm_acccode,cm_purtax, cm_acctax, cm_props, cm_long, cm_percent, cm_branch, insertuser, updateuser', 'length', 'max'=>50),
			array('cm_desc, cm_accdisc', 'length', 'max'=>150),
			array('inserttime, updatetime, cm_accdr', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cm_type, cm_code, cm_desc,cm_accdisc, cm_acccode, cm_accrtn, cm_accdr, cm_acctax, cm_props, cm_purtax, cm_long, cm_percent, cm_branch, cm_active, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'cm_code' => 'Code',
			'cm_desc' => 'Description',
			'cm_accdisc' => 'Discount Account Code',
		
			'cm_purtax' => 'Purchase Tax(%)',
			'cm_acccode' => 'Sales Account',
            'cm_accrtn'=>'Return Account',
            'cm_accdr'=>'Sales/Revenue Account',
			'cm_acctax' => 'VAT A/C',
			'cm_branch' => 'Branch Code',
		
			'cm_props' => 'Property',
			'cm_long' => 'Addition Type',
			'cm_percent' => 'Percentage',
		
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
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('cm_desc',$this->cm_desc,true);
		$criteria->compare('cm_accdisc',$this->cm_accdisc,true);
		$criteria->compare('cm_acccode',$this->cm_acccode,true);
        $criteria->compare('cm_accrtn',$this->cm_accrtn,true);
        $criteria->compare('cm_accdr',$this->cm_accdr,true);
		$criteria->compare('cm_acctax',$this->cm_acctax,true);
        $criteria->compare('cm_purtax',$this->cm_purtax,true);

		$criteria->compare('cm_branch',$this->cm_branch,true);
		
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
	 * @return Codesparam the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
