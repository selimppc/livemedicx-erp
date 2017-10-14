<?php

/**
 * This is the model class for table "sm_vw_cusreceivable".
 *
 * The followings are the available columns in table 'sm_vw_cusreceivable':
 * @property string $cm_code
 * @property string $cm_name
 * @property string $cm_group
 * @property string $cm_address
 * @property string $cm_cellnumber
 * @property string $sm_receivable
 */
class Smvwcusreceivable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sm_vw_cusreceivable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_group', 'required'),
			array('cm_code', 'length', 'max'=>20),
			array('cm_name, cm_branch', 'length', 'max'=>100),
			array('cm_group, cm_cellnumber', 'length', 'max'=>50),
			array('cm_address', 'length', 'max'=>250),
			array('sm_receivable', 'length', 'max'=>52),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cm_code, cm_name, cm_branch, cm_group, cm_address, cm_cellnumber, sm_receivable', 'safe', 'on'=>'search'),
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
			'cm_code' => 'Customer Code',
			'cm_name' => 'Customer Name',
			'cm_group' => 'Group',
            'cm_branch'=> 'Branch Name',
			'cm_address' => 'Address',
			'cm_cellnumber' => 'Phone/Cellnumber',
			'sm_receivable' => 'Receivable Amount',
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
		//$criteria->condition = "sm_doc_type = 'Sales' ";
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('cm_name',$this->cm_name,true);
		$criteria->compare('cm_group',$this->cm_group,true);
        $criteria->compare('cm_branch',$this->cm_branch,true);
		$criteria->compare('cm_address',$this->cm_address,true);
		$criteria->compare('cm_cellnumber',$this->cm_cellnumber,true);
		$criteria->compare('sm_receivable',$this->sm_receivable,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Smvwcusreceivable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
