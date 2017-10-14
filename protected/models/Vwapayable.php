<?php

/**
 * This is the model class for table "am_vw_apayable".
 *
 * The followings are the available columns in table 'am_vw_apayable':
 * @property string $suppliercode
 * @property string $suppliername
 * @property string $accoutcode
 * @property string $conperson
 * @property string $payableamt
 */
class Vwapayable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'am_vw_apayable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('suppliercode, suppliername, accoutcode, conperson', 'required'),
			array('suppliercode, accoutcode', 'length', 'max'=>50),
			array('suppliername, conperson, branch, description', 'length', 'max'=>100),
			array('payableamt', 'length', 'max'=>42),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('suppliercode, suppliername, branch, description,accoutcode, conperson, payableamt', 'safe', 'on'=>'search'),
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
			'suppliercode' => 'Supplier Code',
			'suppliername' => 'Supplier Name',
            'branch'=> 'Branch',
            'description'=>'Account Name',
			'accoutcode' => 'Accout Code',
			'conperson' => 'Contact Person',
			'payableamt' => 'Payable Amount',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('suppliercode',$this->suppliercode,true);
		$criteria->compare('suppliername',$this->suppliername,true);
        $criteria->compare('branch',$this->branch,true);
		$criteria->compare('accoutcode',$this->accoutcode,true);
        $criteria->compare('description',$this->description,true);
		$criteria->compare('conperson',$this->conperson,true);
		$criteria->compare('payableamt',$this->payableamt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vwapayable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
