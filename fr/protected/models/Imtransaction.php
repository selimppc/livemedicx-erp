<?php

/**
 * This is the model class for table "im_transaction".
 *
 * The followings are the available columns in table 'im_transaction':
 * @property integer $id
 * @property string $im_number
 * @property string $cm_code
 * @property string $im_storeid
 * @property string $im_BatchNumber
 * @property string $im_date
 * @property string $im_ExpireDate
 * @property integer $im_quantity
 * @property integer $im_sign
 * @property string $im_unit
 * @property string $im_rate
 * @property string $im_totalprice
 * @property string $im_RefNumber
 * @property integer $im_RefRow
 * @property string $im_note
 * @property string $im_status
 * @property string $im_voucherno
 * @property string $cm_supplierid
 * @property string $im_currency
 * @property string $im_ExchangeRate
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property CmProductmaster $cmCode
 */
class Imtransaction extends CActiveRecord
{
	public $cm_name;
	public $cm_description;
	
	//for post to GL parameters
	public $branch;
	public $fromdate;
	public $todate;

    public $product_search;
    public $branch_search;

    public $pBranch;
    public $pFromDate;
    public $pToDate;
	
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_transaction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('im_quantity, im_sign, im_RefRow', 'numerical', 'integerOnly'=>true),
			array('im_number, cm_code, im_storeid, im_BatchNumber, im_unit, im_RefNumber, im_status, im_voucherno, cm_supplierid, im_currency, insertuser, updateuser', 'length', 'max'=>50),
			array('im_rate, im_totalprice, im_ExchangeRate', 'length', 'max'=>20),
			array('im_note', 'length', 'max'=>250),
			array('im_date, im_ExpireDate, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, im_number, cm_code, product_search, im_storeid, im_BatchNumber, im_date, im_ExpireDate, im_quantity, im_sign, im_unit, im_rate, im_totalprice, im_RefNumber, im_RefRow, im_note, im_status, im_voucherno, cm_supplierid, im_currency, im_ExchangeRate, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
			array('im_rate, im_totalprice, im_currency, im_ExchangeRate', 'numerical', 'integerOnly'=>false),
			array('cm_code', 'required'),
			//array('cm_code', 'cmCode'),
		);
	}
	
	public function cmCode($cm_code)
	{
	    if(!empty($this->cm_code))  
	    {     
	        $record = Productmaster::model()->findByAttributes(array('cm_code' => $this->cm_code));
	
	        if($record === null)
	        {
	            $this->addError($cm_code, 'Invalid Product Code');
	        }
	    }
	 }
	 
	/**
	 * @return array relational rules.
	 */
	 
	 
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product' => array(self::BELONGS_TO, 'Productmaster', 'cm_code'),
            'branch' => array(self::BELONGS_TO, 'Branchmaster', 'im_storeid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'im_number' => 'Receive Number',
			'cm_code' => 'Product Code',
			'im_storeid' => 'Branch',
			'im_BatchNumber' => 'Batch Number',
			'im_date' => 'Date',
			'im_ExpireDate' => 'Expire Date',
			'im_quantity' => 'Recieve Quantity',
			'im_sign' => 'Sign',
			'im_unit' => 'Unit',
			'im_rate' => ' Rate',
			'im_totalprice' => ' Total Price',
			'im_RefNumber' => ' Reference Number',
			'im_RefRow' => 'Ref Row',
			'im_note' => 'Note',
			'im_status' => 'Status',
			'im_voucherno' => ' Voucher No',
			'cm_supplierid' => 'Supplier Id',
			'im_currency' => 'Currency',
			'im_ExchangeRate' => 'Exchange Rate',
			'inserttime' => 'Insert Time',
			'updatetime' => 'Update Time',
			'insertuser' => 'Insert User',
			'updateuser' => 'Update User',
			
			'cm_name' => 'Product Name',
			'cm_description'=> 'Branch Name',
            'product_search' =>'Product Name',
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

		$criteria=new CDbCriteria;

        $criteria -> condition = "im_status = 'Open'";

		$criteria->compare('id',$this->id);
		$criteria->compare('im_number',$this->im_number,true);
		$criteria->compare('cm_code',$this->cm_code,true);

		$criteria->compare('im_storeid',$this->im_storeid,true);

		$criteria->compare('im_BatchNumber',$this->im_BatchNumber,true);
		$criteria->compare('im_date',$this->im_date,true);
		$criteria->compare('im_ExpireDate',$this->im_ExpireDate,true);
		$criteria->compare('im_quantity',$this->im_quantity);
		$criteria->compare('im_sign',$this->im_sign);
		$criteria->compare('im_unit',$this->im_unit,true);
		$criteria->compare('im_rate',$this->im_rate,true);
		$criteria->compare('im_totalprice',$this->im_totalprice,true);
		$criteria->compare('im_RefNumber',$this->im_RefNumber,true);
		$criteria->compare('im_RefRow',$this->im_RefRow);
		$criteria->compare('im_note',$this->im_note,true);
		$criteria->compare('im_status',$this->im_status,true);
		$criteria->compare('im_voucherno',$this->im_voucherno,true);
		$criteria->compare('cm_supplierid',$this->cm_supplierid,true);
		$criteria->compare('im_currency',$this->im_currency,true);
		$criteria->compare('im_ExchangeRate',$this->im_ExchangeRate,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria->with = array( 'product' );
        $criteria->compare( 'product.cm_name', $this->product_search, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Imtransaction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
