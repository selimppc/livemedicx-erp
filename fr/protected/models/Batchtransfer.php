<?php

/**
 * This is the model class for table "im_batchtransfer".
 *
 * The followings are the available columns in table 'im_batchtransfer':
 * @property integer $id
 * @property string $im_transfernum
 * @property string $cm_code
 * @property string $im_BatchNumber
 * @property string $im_ExpDate
 * @property integer $im_quantity
 * @property string $im_unit
 * @property string $im_rate
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Transferhd $imTransfernum
 */
class Batchtransfer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_batchtransfer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('im_quantity', 'numerical', 'integerOnly'=>true),
			array('im_transfernum, cm_code, im_BatchNumber, im_unit, insertuser, updateuser', 'length', 'max'=>50),
			array('im_rate', 'length', 'max'=>20),
			array('im_ExpDate, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, im_transfernum, cm_code, im_BatchNumber, im_ExpDate, im_quantity, im_unit, im_rate, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'imTransfernum' => array(self::BELONGS_TO, 'Transferhd', 'im_transfernum'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'im_transfernum' => 'Transfer Number',
			'cm_code' => 'Cm Code',
			'im_BatchNumber' => 'Batch Number',
			'im_ExpDate' => 'Expiry Date',
			'im_quantity' => 'Im Quantity',
			'im_unit' => 'Im Unit',
			'im_rate' => 'Im Rate',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('im_transfernum',$this->im_transfernum,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('im_BatchNumber',$this->im_BatchNumber,true);
		$criteria->compare('im_ExpDate',$this->im_ExpDate,true);
		$criteria->compare('im_quantity',$this->im_quantity);
		$criteria->compare('im_unit',$this->im_unit,true);
		$criteria->compare('im_rate',$this->im_rate,true);
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
	 * @return Batchtransfer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
