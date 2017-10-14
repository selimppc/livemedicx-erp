<?php


class Purchaseordhd extends CActiveRecord
{
	public $cm_branch;
	public $cm_orgname;
	public $cm_description;
    public $supplier_search;
    public $branch_search;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pp_purchaseordhd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pp_purordnum, cm_supplierid', 'required'),
			array('pp_purordnum, cm_supplierid, pp_requisitionno, pp_store, pp_currency, pp_exchrate, insertuser, updateuser', 'length', 'max'=>50),
			array('pp_payterms', 'length', 'max'=>500),
			array('pp_taxrate, pp_taxamt, pp_discrate, pp_discamt, pp_amount, pp_status', 'length', 'max'=>20),
			array('pp_date, pp_deliverydate, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pp_purordnum, pp_date, cm_supplierid, supplier_search, pp_requisitionno, pp_payterms, pp_deliverydate, pp_store, branch_search, pp_taxrate, pp_taxamt, pp_discrate, pp_discamt, pp_amount, pp_netamt, pp_status, pp_currency, pp_exchrate, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
			array('pp_discamt, pp_discrate, pp_amount, pp_netamt', 'numerical', 'integerOnly'=>false),
			array('cm_supplierid', 'cmSupplier'),
		);
	}

	
	public function cmSupplier($cm_supplierid)
	{
	    if(!empty($this->cm_supplierid))  
	    {     
	        $record = Suppliermaster::model()->findByAttributes(array('cm_supplierid' => $this->cm_supplierid));
	        if($record === null)
	        {
	            $this->addError($cm_supplierid, 'Invalid Supplier ID');
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
			'purchaseorddts' => array(self::HAS_MANY, 'Purchaseorddt', 'pp_purordnum'),
			'supplier' => array(self::BELONGS_TO, 'Suppliermaster', 'cm_supplierid'),
			'branch' => array(self::BELONGS_TO, 'Branchmaster', 'pp_store')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pp_purordnum' => 'PO No',
			'pp_date' => 'Date',
			'cm_supplierid' => 'Supplier ID',
			'pp_requisitionno' => 'Requisition Number',
			'pp_payterms' => 'Payment Terms',
			'pp_deliverydate' => 'Delivery Date',
			'pp_store' => 'Delivery to Warehouse',
			'pp_taxrate' => 'Tax Rate ( % )',
			'pp_taxamt' => 'Tax Amount',
			'pp_discrate' => 'Discount Rate ( % )',
			'pp_discamt' => 'Discount Amount',
			'pp_amount' => 'Total Amount',
            'pp_netamt'=>'Net Amount',
			'pp_status' => 'Status',
			'pp_currency' => 'Currency',
            'pp_exchrate'=>'Exchange Rate',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',
		
			'cm_orgname' => 'Supplier Name',
			'cm_description' => 'Delivery to Warehouse',
            'supplier_search' => 'Supplier',
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
		$criteria->compare('pp_date',$this->pp_date,true);
		$criteria->compare('cm_supplierid',$this->cm_supplierid,true);
		$criteria->compare('pp_requisitionno',$this->pp_requisitionno,true);
		$criteria->compare('pp_payterms',$this->pp_payterms,true);
		$criteria->compare('pp_deliverydate',$this->pp_deliverydate,true);
		$criteria->compare('pp_store',$this->pp_store,true);
		$criteria->compare('pp_taxrate',$this->pp_taxrate,true);
		$criteria->compare('pp_taxamt',$this->pp_taxamt,true);
		$criteria->compare('pp_discrate',$this->pp_discrate,true);
		$criteria->compare('pp_discamt',$this->pp_discamt,true);
		$criteria->compare('pp_amount',$this->pp_amount,true);
        $criteria->compare('pp_netamt',$this->pp_netamt,true);
		$criteria->compare('pp_status',$this->pp_status,true);
		$criteria->compare('pp_currency',$this->pp_currency,true);
        $criteria->compare('pp_exchrate',$this->pp_exchrate,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria->order = "id DESC";

        $criteria->with = array( 'supplier' );
        $criteria->compare( 'supplier.cm_orgname', $this->supplier_search, true );

        //$criteria->select = 't.*, n.cm_description';
        //$criteria->join = 'INNER JOIN cm_suppliermaster m ON t.cm_supplierid = m.cm_supplierid';
        //$criteria->join .= ' INNER JOIN cm_branchmaster n ON t.pp_store = n.cm_branch';

		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Purchaseordhd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
