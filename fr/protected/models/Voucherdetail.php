<?php

/**
 * This is the model class for table "am_voucherdetail".
 *
 * The followings are the available columns in table 'am_voucherdetail':
 * @property integer $id
 * @property string $am_vouchernumber
 * @property string $am_accountcode
 * @property string $am_currency
 * @property string $am_exchagerate
 * @property string $am_primeamt
 * @property string $am_baseamt
 * @property string $am_branch
 * @property string $am_note
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Vouhcerheader $amVouchernumber
 * @property Chartofaccounts $amAccountcode
 */
class Voucherdetail extends CActiveRecord
{
    public $account_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'am_voucherdetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('am_vouchernumber, am_accountcode', 'required'),
			array('am_vouchernumber, am_accountcode, am_branch, insertuser, updateuser', 'length', 'max'=>50),
			array('am_currency', 'length', 'max'=>10),
			array('am_exchagerate, am_primeamt, am_baseamt', 'length', 'max'=>20),
			array('am_note', 'length', 'max'=>255),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, am_vouchernumber, am_accountcode, account_search, am_currency, am_exchagerate, am_primeamt, am_baseamt, am_branch, am_note, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'amVouchernumber' => array(self::BELONGS_TO, 'Vouhcerheader', 'am_vouchernumber'),
			'accountname' => array(self::BELONGS_TO, 'Chartofaccounts', 'am_accountcode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'am_vouchernumber' => 'Voucher Number',
			'am_accountcode' => 'A/C Code',
			'am_currency' => 'Currency',
			'am_exchagerate' => 'Exchage Rate',
			'am_primeamt' => 'Debit/Credit Amount',
			'am_baseamt' => 'Local Currency Amount',
			'am_branch' => 'Branch',
			'am_note' => 'Note',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',
            'account_search'=> 'Account',
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
		$criteria->compare('am_vouchernumber',$this->am_vouchernumber,true);
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('am_currency',$this->am_currency,true);
		$criteria->compare('am_exchagerate',$this->am_exchagerate,true);
		$criteria->compare('am_primeamt',$this->am_primeamt,true);
		$criteria->compare('am_baseamt',$this->am_baseamt,true);
		$criteria->compare('am_branch',$this->am_branch,true);
		$criteria->compare('am_note',$this->am_note,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function searchdt($am_vouchernumber)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria -> condition = "am_vouchernumber = '$am_vouchernumber'";

        $criteria->compare('id',$this->id);
        $criteria->compare('am_vouchernumber',$this->am_vouchernumber,true);
        $criteria->compare('am_accountcode',$this->am_accountcode,true);
        $criteria->compare('am_currency',$this->am_currency,true);
        $criteria->compare('am_exchagerate',$this->am_exchagerate,true);
        $criteria->compare('am_primeamt',$this->am_primeamt,true);
        $criteria->compare('am_baseamt',$this->am_baseamt,true);
        $criteria->compare('am_branch',$this->am_branch,true);
        $criteria->compare('am_note',$this->am_note,true);
        $criteria->compare('inserttime',$this->inserttime,true);
        $criteria->compare('updatetime',$this->updatetime,true);
        $criteria->compare('insertuser',$this->insertuser,true);
        $criteria->compare('updateuser',$this->updateuser,true);

        $criteria->order='am_vouchernumber DESC';

        $criteria->with = array( 'accountname' );
        $criteria->compare( 'accountname.am_description', $this->account_search, true );

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Voucherdetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
