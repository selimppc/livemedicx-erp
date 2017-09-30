<?php

/**
 * This is the model class for table "im_adjustdt".
 *
 * The followings are the available columns in table 'im_adjustdt':
 * @property integer $id
 * @property string $transaction_number
 * @property string $product_code
 * @property string $batch_number
 * @property string $expirry_date
 * @property integer $quantity
 * @property string $stock_rate
 * @property string $inserttime
 * @property string $insertuser
 * @property string $updatetime
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Adjusthd $transactionNumber
 * @property CmProductmaster $productCode
 */
class Adjustdt extends CActiveRecord
{
    public $product_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_adjustdt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inserttime', 'required'),
			array('quantity', 'numerical', 'integerOnly'=>true),
			array('transaction_number, product_code, batch_number, insertuser, updateuser', 'length', 'max'=>50),
			array('stock_rate', 'length', 'max'=>20),
			array('expirry_date,unit, updatetime', 'safe'),
            array('quantity', 'greaterThanZero'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, transaction_number, product_code,  product_search, batch_number, expirry_date, unit, quantity, stock_rate, inserttime, insertuser, updatetime, updateuser', 'safe', 'on'=>'search'),
		);
	}

    public function greaterThanZero($quantity)
    {
        if ($this->$quantity<=0)
            $this->addError($quantity, 'Quantity should not be blank or zero');
    }


    /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'transactionNumber' => array(self::BELONGS_TO, 'Adjusthd', 'transaction_number'),
			'product' => array(self::BELONGS_TO, 'Productmaster', 'product_code'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transaction_number' => 'Transaction Number',
			'product_code' => 'Product Code',
			'batch_number' => 'Batch Number',
			'expirry_date' => 'Expirry Date',
            'unit'=> 'Unit',
			'quantity' => 'Quantity',
			'stock_rate' => 'Stock Rate',
			'inserttime' => 'Inserttime',
			'insertuser' => 'Insertuser',
			'updatetime' => 'Updatetime',
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
	public function search($transaction_number)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        $criteria->condition = "transaction_number = '$transaction_number' ";

		$criteria->compare('id',$this->id);
		$criteria->compare('transaction_number',$this->transaction_number,true);
		$criteria->compare('product_code',$this->product_code,true);
		$criteria->compare('batch_number',$this->batch_number,true);
		$criteria->compare('expirry_date',$this->expirry_date,true);
        $criteria->compare('unit',$this->unit,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('stock_rate',$this->stock_rate,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria->with = array( 'product' );
        $criteria->compare( 'product.cm_name', $this->product_search, true );

        $criteria -> order = "id DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Adjustdt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
