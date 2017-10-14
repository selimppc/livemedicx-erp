<?php

/**
 * This is the model class for table "im_vw_postimtogl".
 *
 * The followings are the available columns in table 'im_vw_postimtogl':
 * @property string $im_number
 * @property string $im_storeid
 * @property string $im_date
 * @property string $cm_code
 * @property string $cm_name
 * @property string $im_currency
 * @property string $im_ExchangeRate
 * @property integer $im_quantity
 * @property string $im_totalprice
 * @property string $im_basevalue
 * @property string $im_status
 * @property string $im_voucherno
 */
class Vwpostimtogl extends CActiveRecord
{
    public $pBranch;
    public $pFromDate;
    public $pToDate;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_vw_postimtogl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_name', 'required'),
			array('im_quantity', 'numerical', 'integerOnly'=>true),
			array('im_number, im_storeid, cm_code, im_currency, im_status, im_voucherno', 'length', 'max'=>50),
			array('cm_name', 'length', 'max'=>200),
			array('im_ExchangeRate, im_totalprice, im_basevalue', 'length', 'max'=>20),
			array('im_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('im_number, im_storeid, im_date, cm_code, cm_name, im_currency, im_ExchangeRate, im_quantity, im_totalprice, im_basevalue, im_status, im_voucherno', 'safe', 'on'=>'search'),
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
			'im_number' => 'Im Number',
			'im_storeid' => 'Store Id',
			'im_date' => 'Date',
			'cm_code' => 'Product Code',
			'cm_name' => 'Product Name',
			'im_currency' => 'Currency',
			'im_ExchangeRate' => 'Exchange Rate',
			'im_quantity' => 'Quantity',
			'im_totalprice' => 'Total Price',
			'im_basevalue' => 'Value',
			'im_status' => 'Status',
			'im_voucherno' => 'Im Voucherno',
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

		$criteria->compare('im_number',$this->im_number,true);
		$criteria->compare('im_storeid',$this->im_storeid,true);
		$criteria->compare('im_date',$this->im_date,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('cm_name',$this->cm_name,true);
		$criteria->compare('im_currency',$this->im_currency,true);
		$criteria->compare('im_ExchangeRate',$this->im_ExchangeRate,true);
		$criteria->compare('im_quantity',$this->im_quantity);
		$criteria->compare('im_totalprice',$this->im_totalprice,true);
		$criteria->compare('im_basevalue',$this->im_basevalue,true);
		$criteria->compare('im_status',$this->im_status,true);
		$criteria->compare('im_voucherno',$this->im_voucherno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    public function searchPostings($pBranch, $pFromDate, $pToDate)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria -> condition = "im_storeid = '$pBranch'";
        $criteria -> addBetweenCondition ('im_date', $pFromDate, $pToDate);

        $criteria->compare('im_number',$this->im_number,true);
        $criteria->compare('im_storeid',$this->im_storeid,true);
        $criteria->compare('im_date',$this->im_date,true);
        $criteria->compare('cm_code',$this->cm_code,true);
        $criteria->compare('cm_name',$this->cm_name,true);
        $criteria->compare('im_currency',$this->im_currency,true);
        $criteria->compare('im_ExchangeRate',$this->im_ExchangeRate,true);
        $criteria->compare('im_quantity',$this->im_quantity);
        $criteria->compare('im_totalprice',$this->im_totalprice,true);
        $criteria->compare('im_basevalue',$this->im_basevalue,true);
        $criteria->compare('im_status',$this->im_status,true);
        $criteria->compare('im_voucherno',$this->im_voucherno,true);



        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vwpostimtogl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
