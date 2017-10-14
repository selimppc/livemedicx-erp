<?php

/**
 * This is the model class for table "it_imtogl".
 *
 * The followings are the available columns in table 'it_imtogl':
 * @property integer $id
 * @property string $c_branch
 * @property string $c_trncode
 * @property string $c_group
 * @property string $c_accdr
 * @property string $c_acccr
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Itimtogl extends CActiveRecord
{
    public $accdr;
    public $acccr;

    public $debit_search;
    public $credit_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'it_imtogl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_branch, c_trncode, c_accdr, c_acccr, insertuser, updateuser', 'length', 'max'=>10),
			array('c_group', 'length', 'max'=>50),
			array('inserttime, updatetime', 'safe'),
            //array('c_branch, c_trncode, c_group', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, c_branch, c_trncode, c_group, c_accdr, debit_search, c_acccr, credit_search,inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
            'debit' => array(self::BELONGS_TO, 'Chartofaccounts', 'c_accdr'),

            'credit' => array(self::BELONGS_TO, 'Chartofaccounts', 'c_acccr'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'c_branch' => 'Branch',
			'c_trncode' => 'Transaction Code',
			'c_group' => 'Group',
			'c_accdr' => 'Account Debit',
			'c_acccr' => 'Account Credit',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',

            'accdr'=> 'Debit A/C',
            'acccr'=>'Credit A/C',

            'debit_search'=>'Debit A/C',
            'credit_search'=> 'Credit A/C',
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
		$criteria->compare('c_branch',$this->c_branch,true);
		$criteria->compare('c_trncode',$this->c_trncode,true);
		$criteria->compare('c_group',$this->c_group,true);
		$criteria->compare('c_accdr',$this->c_accdr,true);
		$criteria->compare('c_acccr',$this->c_acccr,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria->select = 't.*, m.am_description as accdr, n.am_description as acccr';
        $criteria->join = 'LEFT JOIN am_chartofaccounts m ON t.c_accdr = m.am_accountcode';
        $criteria->join .= ' LEFT JOIN am_chartofaccounts n ON t.c_acccr = n.am_accountcode';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Itimtogl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
