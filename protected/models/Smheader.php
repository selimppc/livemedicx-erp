<?php

class Smheader extends CActiveRecord
{
	public $cm_name;
	public $total_amount_;

    public $customer_search;

    public $product_class;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sm_header';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sm_sign', 'numerical', 'integerOnly'=>true),
			array('sm_number, cm_cuscode, sm_sp, sm_doc_type, sm_storeid, sm_territory, sm_rsm, sm_area, sm_payterms, sm_stataus, sm_refe_code, insertuser, updateuser', 'length', 'max'=>256),
			array('am_accountcode, glvoucher, sm_chequeno, sm_totalamt, sm_total_tax_amt, sm_disc_rate, sm_disc_amt, sm_netamt', 'length', 'max'=>50),
			array('sm_date, inserttime, updatetime, sm_currency, sm_exchrate, sm_note, imvoucher, sm_stataus', 'safe'),
			array('sm_totalamt, sm_total_tax_amt, sm_disc_rate, sm_disc_amt, sm_netamt', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sm_number, sm_date, cm_cuscode, customer_search, sm_sp, sm_doc_type, sm_storeid, sm_territory, sm_rsm, sm_area, sm_payterms, am_accountcode, sm_chequeno, sm_currency, sm_exchrate, sm_note, sm_totalamt, sm_total_tax_amt, sm_disc_rate, sm_disc_amt, sm_netamt, sm_sign, sm_stataus, sm_refe_code, glvoucher, imvoucher, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'smDetails' => array(self::HAS_MANY, 'SmDetail', 'sm_number'),
			'customer' => array(self::BELONGS_TO, 'Customermst', 'cm_cuscode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sm_number' => 'Sales Number',
			'sm_date' => 'Sales Date',
			'cm_cuscode' => 'Customer Code',
			'sm_sp' => 'Sales Person',
			'sm_doc_type' => 'Doc Type',
			'sm_storeid' => 'Store ID',
			'sm_territory' => 'Territory',
			'sm_rsm' => 'Rsm',
			'sm_area' => 'Area',
			'sm_payterms' => 'Payterms',
			'am_accountcode' => 'Accountcode',
			'sm_chequeno' => 'Cheque No',
            'sm_currency' => 'Currency',
            'sm_exchrate' => 'Exchange Rate',
            'sm_note' => 'Note',
			'sm_totalamt' => 'Total Amount',
			'sm_total_tax_amt' => 'Total Tax Amt',
			'sm_disc_rate' => 'Discount Rate (%)',
			'sm_disc_amt' => 'Discount Amount',
			'sm_netamt' => 'Net Amount',
			'sm_sign' => 'Sign',
			'sm_stataus' => 'Status',
			'sm_refe_code' => 'Refe Code',
			'glvoucher'=>  'GL Voucher No',
            'imvoucher' => 'IM Voucher',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',
		
			'cm_name'=> 'Customer Name',
            'customer_search'=>'Customer Name',
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
		$criteria->condition = '';
        $criteria->condition = "sm_doc_type = 'Sales' ";
        $criteria->addCondition("LEFT(sm_number, 4) != 'DS--'");
        $criteria->addCondition("sm_stataus != 'Cancel'");


        $criteria->compare('id',$this->id);
        $criteria->compare('sm_number',$this->sm_number,true);
        $criteria->compare('sm_date',$this->sm_date,true);
        $criteria->compare('cm_cuscode',$this->cm_cuscode,true);
        $criteria->compare('sm_sp',$this->sm_sp,true);
        $criteria->compare('sm_doc_type',$this->sm_doc_type,true);
        $criteria->compare('sm_storeid',$this->sm_storeid,true);
        $criteria->compare('sm_territory',$this->sm_territory,true);
        $criteria->compare('sm_rsm',$this->sm_rsm,true);
        $criteria->compare('sm_area',$this->sm_area,true);
        $criteria->compare('sm_payterms',$this->sm_payterms,true);
        $criteria->compare('am_accountcode',$this->am_accountcode,true);
        $criteria->compare('sm_chequeno',$this->sm_chequeno,true);
        $criteria->compare('sm_currency',$this->sm_currency,true);
        $criteria->compare('sm_exchrate',$this->sm_exchrate,true);
        $criteria->compare('sm_note',$this->sm_note,true);
        $criteria->compare('sm_totalamt',$this->sm_totalamt,true);
        $criteria->compare('sm_total_tax_amt',$this->sm_total_tax_amt,true);
        $criteria->compare('sm_disc_rate',$this->sm_disc_rate,true);
        $criteria->compare('sm_disc_amt',$this->sm_disc_amt,true);
        $criteria->compare('sm_netamt',$this->sm_netamt,true);
        $criteria->compare('sm_sign',$this->sm_sign);
        $criteria->compare('sm_stataus',$this->sm_stataus,true);
        $criteria->compare('sm_refe_code',$this->sm_refe_code,true);
        $criteria->compare('glvoucher',$this->glvoucher,true);
        $criteria->compare('imvoucher',$this->imvoucher,true);
        $criteria->compare('inserttime',$this->inserttime,true);
        $criteria->compare('updatetime',$this->updatetime,true);
        $criteria->compare('insertuser',$this->insertuser,true);
        $criteria->compare('updateuser',$this->updateuser,true);



        $criteria->with = array( 'customer' );
        $criteria->compare( 'customer.cm_name', $this->customer_search, true );

        $criteria -> order = "id DESC";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public function searchReturn()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = '';
		$criteria->condition = "sm_doc_type = 'Sales' ";
        $criteria -> addCondition("sm_stataus != 'Open'");
        $criteria -> addCondition("sm_stataus != 'Cancel'");
		
		$criteria->compare('id',$this->id);
		$criteria->compare('sm_number',$this->sm_number,true);
		$criteria->compare('sm_date',$this->sm_date,true);
		$criteria->compare('cm_cuscode',$this->cm_cuscode,true);
		$criteria->compare('sm_sp',$this->sm_sp,true);
		$criteria->compare('sm_doc_type',$this->sm_doc_type,true);
		$criteria->compare('sm_storeid',$this->sm_storeid,true);
		$criteria->compare('sm_territory',$this->sm_territory,true);
		$criteria->compare('sm_rsm',$this->sm_rsm,true);
		$criteria->compare('sm_area',$this->sm_area,true);
		$criteria->compare('sm_payterms',$this->sm_payterms,true);
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('sm_chequeno',$this->sm_chequeno,true);
        $criteria->compare('sm_currency',$this->sm_currency,true);
        $criteria->compare('sm_exchrate',$this->sm_exchrate,true);
		$criteria->compare('sm_totalamt',$this->sm_totalamt,true);
		$criteria->compare('sm_total_tax_amt',$this->sm_total_tax_amt,true);
		$criteria->compare('sm_disc_rate',$this->sm_disc_rate,true);
		$criteria->compare('sm_disc_amt',$this->sm_disc_amt,true);
		$criteria->compare('sm_netamt',$this->sm_netamt,true);
		$criteria->compare('sm_sign',$this->sm_sign);
		$criteria->compare('sm_stataus',$this->sm_stataus,true);
		$criteria->compare('sm_refe_code',$this->sm_refe_code,true);
        $criteria->compare('imvoucher',$this->imvoucher,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria -> order = "id DESC";

         $criteria->with = array( 'customer' );
         $criteria->compare( 'customer.cm_name', $this->customer_search, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function searchMoneyReceipt()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->condition = '';
        $criteria->condition = "sm_doc_type = 'Receipt' ";
        //$criteria -> addCondition("sm_stataus = 'Confirmed'");

        $criteria->compare('id',$this->id);
        $criteria->compare('sm_number',$this->sm_number,true);
        $criteria->compare('sm_date',$this->sm_date,true);
        $criteria->compare('cm_cuscode',$this->cm_cuscode,true);
        $criteria->compare('sm_sp',$this->sm_sp,true);
        $criteria->compare('sm_doc_type',$this->sm_doc_type,true);
        $criteria->compare('sm_storeid',$this->sm_storeid,true);
        $criteria->compare('sm_territory',$this->sm_territory,true);
        $criteria->compare('sm_rsm',$this->sm_rsm,true);
        $criteria->compare('sm_area',$this->sm_area,true);
        $criteria->compare('sm_payterms',$this->sm_payterms,true);
        $criteria->compare('am_accountcode',$this->am_accountcode,true);
        $criteria->compare('sm_chequeno',$this->sm_chequeno,true);
        $criteria->compare('sm_currency',$this->sm_currency,true);
        $criteria->compare('sm_exchrate',$this->sm_exchrate,true);
        $criteria->compare('sm_totalamt',$this->sm_totalamt,true);
        $criteria->compare('sm_total_tax_amt',$this->sm_total_tax_amt,true);
        $criteria->compare('sm_disc_rate',$this->sm_disc_rate,true);
        $criteria->compare('sm_disc_amt',$this->sm_disc_amt,true);
        $criteria->compare('sm_netamt',$this->sm_netamt,true);
        $criteria->compare('sm_sign',$this->sm_sign);
        $criteria->compare('sm_stataus',$this->sm_stataus,true);
        $criteria->compare('sm_refe_code',$this->sm_refe_code,true);
        $criteria->compare('glvoucher',$this->glvoucher,true);
        $criteria->compare('imvoucher',$this->imvoucher,true);
        $criteria->compare('inserttime',$this->inserttime,false);
        $criteria->compare('updatetime',$this->updatetime,true);
        $criteria->compare('insertuser',$this->insertuser,true);
        $criteria->compare('updateuser',$this->updateuser,true);

        $criteria -> order = "id DESC";

         $criteria->with = array( 'customer' );
         $criteria->compare( 'customer.cm_name', $this->customer_search, true );

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function searchViewMoneyReceipt($cm_cuscode)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->condition = '';
        $criteria->condition = "sm_doc_type = 'Receipt'";
        $criteria->addCondition("cm_cuscode = '$cm_cuscode'");

        $criteria->compare('id',$this->id);
        $criteria->compare('sm_number',$this->sm_number,true);
        $criteria->compare('sm_date',$this->sm_date,true);
        $criteria->compare('cm_cuscode',$this->cm_cuscode,true);
        $criteria->compare('sm_sp',$this->sm_sp,true);
        $criteria->compare('sm_doc_type',$this->sm_doc_type,true);
        $criteria->compare('sm_storeid',$this->sm_storeid,true);
        $criteria->compare('sm_territory',$this->sm_territory,true);
        $criteria->compare('sm_rsm',$this->sm_rsm,true);
        $criteria->compare('sm_area',$this->sm_area,true);
        $criteria->compare('sm_payterms',$this->sm_payterms,true);
        $criteria->compare('am_accountcode',$this->am_accountcode,true);
        $criteria->compare('sm_chequeno',$this->sm_chequeno,true);
        $criteria->compare('sm_currency',$this->sm_currency,true);
        $criteria->compare('sm_exchrate',$this->sm_exchrate,true);
        $criteria->compare('sm_totalamt',$this->sm_totalamt,true);
        $criteria->compare('sm_total_tax_amt',$this->sm_total_tax_amt,true);
        $criteria->compare('sm_disc_rate',$this->sm_disc_rate,true);
        $criteria->compare('sm_disc_amt',$this->sm_disc_amt,true);
        $criteria->compare('sm_netamt',$this->sm_netamt,true);
        $criteria->compare('sm_sign',$this->sm_sign);
        $criteria->compare('sm_stataus',$this->sm_stataus,true);
        $criteria->compare('sm_refe_code',$this->sm_refe_code,true);
        $criteria->compare('imvoucher',$this->imvoucher,true);
        $criteria->compare('inserttime',$this->inserttime,true);
        $criteria->compare('updatetime',$this->updatetime,true);
        $criteria->compare('insertuser',$this->insertuser,true);
        $criteria->compare('updateuser',$this->updateuser,true);

        $criteria -> order = "id DESC";
        $criteria->with = array( 'customer' );
        $criteria->compare( 'customer.cm_name', $this->customer_search, true );

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function searchManageReturn()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = '';
		$criteria->condition = "sm_doc_type = 'Return' ";
		$criteria -> addCondition("sm_stataus != 'Open'");
        $criteria -> addCondition("sm_stataus != 'Cancel'");
		
		$criteria->compare('id',$this->id);
		$criteria->compare('sm_number',$this->sm_number,true);
		$criteria->compare('sm_date',$this->sm_date,true);
		$criteria->compare('cm_cuscode',$this->cm_cuscode,true);
		$criteria->compare('sm_sp',$this->sm_sp,true);
		$criteria->compare('sm_doc_type',$this->sm_doc_type,true);
		$criteria->compare('sm_storeid',$this->sm_storeid,true);
		$criteria->compare('sm_territory',$this->sm_territory,true);
		$criteria->compare('sm_rsm',$this->sm_rsm,true);
		$criteria->compare('sm_area',$this->sm_area,true);
		$criteria->compare('sm_payterms',$this->sm_payterms,true);
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('sm_chequeno',$this->sm_chequeno,true);
        $criteria->compare('sm_currency',$this->sm_currency,true);
        $criteria->compare('sm_exchrate',$this->sm_exchrate,true);
		$criteria->compare('sm_totalamt',$this->sm_totalamt,true);
		$criteria->compare('sm_total_tax_amt',$this->sm_total_tax_amt,true);
		$criteria->compare('sm_disc_rate',$this->sm_disc_rate,true);
		$criteria->compare('sm_disc_amt',$this->sm_disc_amt,true);
		$criteria->compare('sm_netamt',$this->sm_netamt,true);
		$criteria->compare('sm_sign',$this->sm_sign);
		$criteria->compare('sm_stataus',$this->sm_stataus,true);
		$criteria->compare('sm_refe_code',$this->sm_refe_code,true);
        $criteria->compare('imvoucher',$this->imvoucher,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria -> order = "id DESC";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function deliveryOrder()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = '';
		$criteria->condition = "sm_stataus != 'Open' ";
		$criteria->addCondition("sm_doc_type = 'Sales' ");
        $criteria->addCondition("sm_stataus != 'Cancel' ");
        $criteria->addCondition("LEFT(sm_number, 4) != 'DS--'");
        $criteria->addCondition("LEFT(sm_number, 4) != 'MR--'");

		$criteria->compare('id',$this->id);
		$criteria->compare('sm_number',$this->sm_number,true);
		$criteria->compare('sm_date',$this->sm_date,true);
		$criteria->compare('cm_cuscode',$this->cm_cuscode,true);
		$criteria->compare('sm_sp',$this->sm_sp,true);
		$criteria->compare('sm_doc_type',$this->sm_doc_type,true);
		$criteria->compare('sm_storeid',$this->sm_storeid,true);
		$criteria->compare('sm_territory',$this->sm_territory,true);
		$criteria->compare('sm_rsm',$this->sm_rsm,true);
		$criteria->compare('sm_area',$this->sm_area,true);
		$criteria->compare('sm_payterms',$this->sm_payterms,true);
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('sm_chequeno',$this->sm_chequeno,true);
        $criteria->compare('sm_currency',$this->sm_currency,true);
        $criteria->compare('sm_exchrate',$this->sm_exchrate,true);
		$criteria->compare('sm_totalamt',$this->sm_totalamt,true);
		$criteria->compare('sm_total_tax_amt',$this->sm_total_tax_amt,true);
		$criteria->compare('sm_disc_rate',$this->sm_disc_rate,true);
		$criteria->compare('sm_disc_amt',$this->sm_disc_amt,true);
		$criteria->compare('sm_netamt',$this->sm_netamt,true);
		$criteria->compare('sm_sign',$this->sm_sign);
		$criteria->compare('sm_stataus',$this->sm_stataus,true);
		$criteria->compare('sm_refe_code',$this->sm_refe_code,true);
        $criteria->compare('imvoucher',$this->imvoucher,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria -> order = "id DESC";

         $criteria->with = array( 'customer' );
         $criteria->compare( 'customer.cm_name', $this->customer_search, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Smheader the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



    public function directSale()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->condition = '';
        $criteria->condition = "sm_stataus = 'Open' ";
        $criteria->addCondition("sm_doc_type = 'Sales' ");
        $criteria->addCondition("sm_stataus != 'Cancel' ");
        $criteria->condition = "LEFT(sm_number, 4) = 'DS--'";

        $criteria->compare('id',$this->id);
        $criteria->compare('sm_number',$this->sm_number,true);
        $criteria->compare('sm_date',$this->sm_date,true);
        $criteria->compare('cm_cuscode',$this->cm_cuscode,true);
        $criteria->compare('sm_sp',$this->sm_sp,true);
        $criteria->compare('sm_doc_type',$this->sm_doc_type,true);
        $criteria->compare('sm_storeid',$this->sm_storeid,true);
        $criteria->compare('sm_territory',$this->sm_territory,true);
        $criteria->compare('sm_rsm',$this->sm_rsm,true);
        $criteria->compare('sm_area',$this->sm_area,true);
        $criteria->compare('sm_payterms',$this->sm_payterms,true);
        $criteria->compare('am_accountcode',$this->am_accountcode,true);
        $criteria->compare('sm_chequeno',$this->sm_chequeno,true);
        $criteria->compare('sm_currency',$this->sm_currency,true);
        $criteria->compare('sm_exchrate',$this->sm_exchrate,true);
        $criteria->compare('sm_note',$this->sm_note,true);
        $criteria->compare('sm_totalamt',$this->sm_totalamt,true);
        $criteria->compare('sm_total_tax_amt',$this->sm_total_tax_amt,true);
        $criteria->compare('sm_disc_rate',$this->sm_disc_rate,true);
        $criteria->compare('sm_disc_amt',$this->sm_disc_amt,true);
        $criteria->compare('sm_netamt',$this->sm_netamt,true);
        $criteria->compare('sm_sign',$this->sm_sign);
        $criteria->compare('sm_stataus',$this->sm_stataus,true);
        $criteria->compare('sm_refe_code',$this->sm_refe_code,true);
        $criteria->compare('imvoucher',$this->imvoucher,true);
        $criteria->compare('inserttime',$this->inserttime,true);
        $criteria->compare('updatetime',$this->updatetime,true);
        $criteria->compare('insertuser',$this->insertuser,true);
        $criteria->compare('updateuser',$this->updateuser,true);

        $criteria -> order = "id DESC";

         $criteria->with = array('customer');
         $criteria->compare('customer.cm_name', $this->customer_search, true );

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
