<?php


class Requisitionhd extends CActiveRecord
{
	public $cm_description;
	public $cm_orgname;
    public $supplier_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pp_requisitionhd';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pp_requisitionno', 'required'),
			array('pp_requisitionno, cm_supplierid, pp_branch, pp_status, insertuser, updateuser', 'length', 'max'=>50),
			array('pp_note', 'length', 'max'=>250),
			array('pp_date,pp_currency,pp_exchrate, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pp_requisitionno, supplier_search, cm_supplierid, supplier_search, pp_date,pp_currency,pp_exchrate, pp_branch, pp_note, pp_status, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'requisitiondts' => array(self::HAS_MANY, 'Requisitiondt', 'pp_requisitionno'),
            'supplier' => array(self::BELONGS_TO, 'Suppliermaster', 'cm_supplierid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pp_requisitionno' => 'Requisition No',
			'cm_supplierid' => 'Supplier ID',
			'pp_date' => 'Date',
            'pp_currency'=> 'Currency',
            'pp_exchrate'=> 'Exchange Rate',
			'pp_branch' => 'Branch',
			'cm_description'=> 'Branch Name',
			'pp_note' => 'Reference',
			'pp_status' => 'Status',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',

			'cm_orgname' => 'Supplier Name',

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
		$criteria->compare('pp_requisitionno',$this->pp_requisitionno,true);
		$criteria->compare('cm_supplierid',$this->cm_supplierid,true);
		$criteria->compare('cm_orgname',$this->cm_orgname,true);

		$criteria->compare('pp_date',$this->pp_date,true);
        $criteria->compare('pp_currency',$this->pp_currency,true);
        $criteria->compare('pp_exchrate',$this->pp_exchrate,true);
		$criteria->compare('pp_branch',$this->pp_branch,true);
		$criteria->compare('pp_note',$this->pp_note,true);
		$criteria->compare('pp_status',$this->pp_status,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

        $criteria->order = "id DESC";

        $criteria->with = array( 'supplier' );
        $criteria->compare( 'supplier.cm_orgname', $this->supplier_search, true );

		//$criteria->select = 't.*, n.cm_orgname';
		//$criteria->join = 'INNER JOIN cm_suppliermaster n ON t.cm_supplierid = n.cm_supplierid';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Requisitionhd the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
