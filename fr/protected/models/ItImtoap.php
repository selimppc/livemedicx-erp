<?php

/**
 * This is the model class for table "it_imtoap".
 *
 * The followings are the available columns in table 'it_imtoap':
 * @property integer $id
 * @property string $item_group
 * @property string $sup_group
 * @property string $debit_account
 * @property integer $active
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class ItImtoap extends CActiveRecord
{
    public $am_description;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'it_imtoap';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_group, sup_group, debit_account', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('item_group, sup_group, debit_account, insertuser, updateuser', 'length', 'max'=>50),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_group, sup_group, debit_account, active, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'item_group' => 'Item Group',
			'sup_group' => 'Sup Group',
			'debit_account' => 'Debit Account',
            'am_description' => 'Debit A/C',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('item_group',$this->item_group,true);
		$criteria->compare('sup_group',$this->sup_group,true);
		$criteria->compare('debit_account',$this->debit_account,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria->select = 't.*, m.am_description';
        $criteria->join = 'INNER JOIN am_chartofaccounts m ON t.debit_account = m.am_accountcode';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function newsearch()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = '';

		$criteria->compare('id',$this->id);
		$criteria->compare('item_group',$this->item_group,true);
		$criteria->compare('sup_group',$this->sup_group,true);
		$criteria->compare('debit_account',$this->debit_account,true);
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
	 * @return ItImtoap the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
