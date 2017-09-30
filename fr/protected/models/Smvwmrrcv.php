<?php

/**
 * This is the model class for table "sm_vw_mrrcv".
 *
 * The followings are the available columns in table 'sm_vw_mrrcv':
 * @property string $sm_invnumber
 * @property string $cm_cuscode
 * @property string $sm_amount
 */
class Smvwmrrcv extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sm_vw_mrrcv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sm_invnumber, cm_cuscode', 'length', 'max'=>20),
			array('sm_amount', 'length', 'max'=>52),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sm_invnumber, cm_cuscode, sm_amount', 'safe', 'on'=>'search'),
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
			'sm_invnumber' => 'Sm Invnumber',
			'cm_cuscode' => 'Cm Cuscode',
			'sm_amount' => 'Sm Amount',
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

		$criteria->compare('sm_invnumber',$this->sm_invnumber,true);
		$criteria->compare('cm_cuscode',$this->cm_cuscode,true);
		$criteria->compare('sm_amount',$this->sm_amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Smvwmrrcv the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
