<?php

/**
 * This is the model class for table "pp_purchaseorddt".
 *
 * The followings are the available columns in table 'pp_purchaseorddt':
 * @property integer $id
 * @property string $pp_purordnum
 * @property string $cm_code
 * @property integer $pp_quantity
 * @property integer $pp_grnqty
 * @property string $pp_unit
 * @property integer $pp_unitqty
 * @property string $pp_purchasrate
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property CmProductmaster $cmCode
 * @property Purchaseordhd $ppPurordnum
 */
class Purchaseorddt extends CActiveRecord
{
	
	public $pp_status;
	
	public $cm_name;
	public $cm_description;
    public $product_search;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pp_purchaseorddt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pp_purordnum, cm_code', 'required'),
			array('pp_quantity, pp_grnqty, pp_unitqty', 'numerical', 'integerOnly'=>true),
			array('pp_purordnum, cm_code, pp_unit, insertuser, updateuser', 'length', 'max'=>50),
			array('pp_purchasrate', 'length', 'max'=>20),
            array('pp_quantity', 'greaterThanZero'),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pp_purordnum, cm_code, product_search, pp_quantity, pp_grnqty, pp_unit, pp_unitqty, pp_purchasrate,pp_taxrate, pp_taxamt, pp_rowamt, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
			array('pp_purchasrate, pp_taxrate, pp_taxamt, pp_rowamt', 'numerical', 'integerOnly'=>false),
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

    public function greaterThanZero($pp_quantity)
    {

        if ($this->$pp_quantity<=0)
            $this->addError($pp_quantity, 'Quantity should not be blank or zero');

    }
	 
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'cmCode' => array(self::BELONGS_TO, 'CmProductmaster', 'cm_code'),
            'product' => array(self::BELONGS_TO, 'Productmaster', 'cm_code'),
			'ppPurordnum' => array(self::BELONGS_TO, 'Purchaseordhd', 'pp_purordnum'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pp_purordnum' => 'Purchase Order No',
			'cm_code' => 'Product Code',
			'pp_quantity' => 'Pur.Order Quantity',
			'pp_grnqty' => 'Grand Quantity',
            'pp_taxrate'=>'Tax Rate',
            'pp_taxamt' => 'Tax Amount',
            'pp_unit' => 'Unit of Measurement',
			'pp_unitqty' => 'Unit Quantity',
			'pp_purchasrate' => 'Purchase Rate',
			'pp_rowamt' => 'Line Amount',
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
		$criteria->compare('pp_purordnum',$this->pp_purordnum,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('pp_quantity',$this->pp_quantity);
		$criteria->compare('pp_grnqty',$this->pp_grnqty);
        $criteria->compare('pp_taxrate',$this->pp_taxrate);
        $criteria->compare('pp_taxamt',$this->pp_taxamt);
		$criteria->compare('pp_unit',$this->pp_unit,true);
		$criteria->compare('pp_unitqty',$this->pp_unitqty);
		$criteria->compare('pp_purchasrate',$this->pp_purchasrate,true);
        $criteria->compare('pp_rowamt',$this->pp_rowamt,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	
	public function searchDetail($pp_purordnum)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = "pp_purordnum = '$pp_purordnum' ";
		
		$criteria->compare('id',$this->id);
		$criteria->compare('pp_purordnum',$this->pp_purordnum,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('pp_quantity',$this->pp_quantity);
		$criteria->compare('pp_grnqty',$this->pp_grnqty);
        $criteria->compare('pp_taxrate',$this->pp_taxrate);
        $criteria->compare('pp_taxamt',$this->pp_taxamt);
		$criteria->compare('pp_unit',$this->pp_unit,true);
		$criteria->compare('pp_unitqty',$this->pp_unitqty);
		$criteria->compare('pp_purchasrate',$this->pp_purchasrate,true);
        $criteria->compare('pp_rowamt',$this->pp_rowamt,true);
		$criteria->order = "id DESC";

        $criteria->with = array( 'product' );
        $criteria->compare( 'product.cm_name', $this->product_search, true );

		//$criteria->select = 't.*, m.cm_name';
		//$criteria->condition = "t.pp_purordnum = '$pp_purordnum' ";
		//$criteria->join = 'INNER JOIN cm_productmaster m ON t.cm_code = m.cm_code';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Purchaseorddt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
