<?php

/**
 * This is the model class for table "sm_invalc".
 *
 * The followings are the available columns in table 'sm_invalc':
 * @property integer $id
 * @property string $sm_number
 * @property string $sm_invnumber
 * @property string $sm_amount
 * @property string $sm_balanceamt
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property SmHeader $smNumber
 */
class Sminvalc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sm_invalc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sm_number, sm_invnumber, sm_amount, sm_balanceamt, insertuser, updateuser', 'length', 'max'=>20),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sm_number, sm_invnumber, sm_amount, sm_balanceamt, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'smNumber' => array(self::BELONGS_TO, 'SmHeader', 'sm_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sm_number' => 'Money Receipt Number',
			'sm_invnumber' => 'Invoice Number',
			'sm_amount' => 'Amount',
			'sm_balanceamt' => 'Balance Amount',
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
	public function search($sm_number)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        $criteria->condition = "sm_number = '$sm_number' ";

		$criteria->compare('id',$this->id);
		$criteria->compare('sm_number',$this->sm_number,true);
		$criteria->compare('sm_invnumber',$this->sm_invnumber,true);
		$criteria->compare('sm_amount',$this->sm_amount,true);
		$criteria->compare('sm_balanceamt',$this->sm_balanceamt,true);
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
	 * @return Sminvalc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
