<?php

/**
 * This is the model class for table "companyprofile".
 *
 * The followings are the available columns in table 'companyprofile':
 * @property integer $id
 * @property string $title
 * @property string $shortdescription
 * @property string $longdescription
 * @property string $photo
 */
class Companyprofile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'companyprofile';
	}
        
        
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, shortdescription, longdescription, photo', 'required'),
			array('title', 'length', 'max'=>64),
			array('photo', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, shortdescription, longdescription, photo', 'safe', 'on'=>'insert,update, search'),
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
			'title' => 'Title',
			'shortdescription' => 'Description',
			'longdescription' => 'Description',
			'photo' => 'Photo',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('shortdescription',$this->shortdescription,true);
		$criteria->compare('longdescription',$this->longdescription,true);
		$criteria->compare('photo',$this->photo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Companyprofile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
