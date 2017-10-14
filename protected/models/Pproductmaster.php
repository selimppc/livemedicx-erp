<?php

/**
 * This is the model class for table "cm_productmaster".
 *
 * The followings are the available columns in table 'cm_productmaster':
 * @property string $cm_code
 * @property string $cm_name
 * @property string $cm_description
 * @property string $image
 * @property string $cm_class
 * @property string $cm_group
 * @property string $cm_category
 * @property string $currency
 * @property string $exchange_rate
 * @property string $cm_sellrate
 * @property string $cm_costprice
 * @property string $cm_sellunit
 * @property string $cm_sellconfact
 * @property string $cm_purunit
 * @property string $cm_purconfact
 * @property string $cm_selltax
 * @property string $cm_stkunit
 * @property string $cm_stkconfac
 * @property string $cm_packsize
 * @property string $cm_stocktype
 * @property string $cm_generic
 * @property string $cm_supplierid
 * @property string $cm_mfgcode
 * @property integer $cm_maxlevel
 * @property integer $cm_minlevel
 * @property integer $cm_reorder
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Pproductmaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cm_productmaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_code, cm_name, image, currency, exchange_rate, cm_selltax', 'required'),
			array('cm_maxlevel, cm_minlevel, cm_reorder', 'numerical', 'integerOnly'=>true),
			array('cm_code, cm_class, cm_group, cm_category, cm_sellunit, cm_purunit, cm_stkunit, cm_packsize, cm_stocktype, cm_supplierid, cm_mfgcode, insertuser, updateuser', 'length', 'max'=>50),
			array('cm_name, cm_description', 'length', 'max'=>200),
			array('image', 'length', 'max'=>256),
			array('currency', 'length', 'max'=>15),
			array('exchange_rate, cm_sellrate, cm_costprice, cm_sellconfact, cm_purconfact, cm_selltax, cm_stkconfac', 'length', 'max'=>20),
			array('cm_generic', 'length', 'max'=>100),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cm_code, cm_name, cm_description, image, cm_class, cm_group, cm_category, currency, exchange_rate, cm_sellrate, cm_costprice, cm_sellunit, cm_sellconfact, cm_purunit, cm_purconfact, cm_selltax, cm_stkunit, cm_stkconfac, cm_packsize, cm_stocktype, cm_generic, cm_supplierid, cm_mfgcode, cm_maxlevel, cm_minlevel, cm_reorder, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'cm_code' => 'Cm Code',
			'cm_name' => 'Cm Name',
			'cm_description' => 'Cm Description',
			'image' => 'Image',
			'cm_class' => 'Cm Class',
			'cm_group' => 'Cm Group',
			'cm_category' => 'Cm Category',
			'currency' => 'Currency',
			'exchange_rate' => 'Exchange Rate',
			'cm_sellrate' => 'Cm Sellrate',
			'cm_costprice' => 'Cm Costprice',
			'cm_sellunit' => 'Cm Sellunit',
			'cm_sellconfact' => 'Cm Sellconfact',
			'cm_purunit' => 'Cm Purunit',
			'cm_purconfact' => 'Cm Purconfact',
			'cm_selltax' => 'Cm Selltax',
			'cm_stkunit' => 'Cm Stkunit',
			'cm_stkconfac' => 'Cm Stkconfac',
			'cm_packsize' => 'Cm Packsize',
			'cm_stocktype' => 'Cm Stocktype',
			'cm_generic' => 'Cm Generic',
			'cm_supplierid' => 'Cm Supplierid',
			'cm_mfgcode' => 'Cm Mfgcode',
			'cm_maxlevel' => 'Cm Maxlevel',
			'cm_minlevel' => 'Cm Minlevel',
			'cm_reorder' => 'Cm Reorder',
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

		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('cm_name',$this->cm_name,true);
		$criteria->compare('cm_description',$this->cm_description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('cm_class',$this->cm_class,true);
		$criteria->compare('cm_group',$this->cm_group,true);
		$criteria->compare('cm_category',$this->cm_category,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('exchange_rate',$this->exchange_rate,true);
		$criteria->compare('cm_sellrate',$this->cm_sellrate,true);
		$criteria->compare('cm_costprice',$this->cm_costprice,true);
		$criteria->compare('cm_sellunit',$this->cm_sellunit,true);
		$criteria->compare('cm_sellconfact',$this->cm_sellconfact,true);
		$criteria->compare('cm_purunit',$this->cm_purunit,true);
		$criteria->compare('cm_purconfact',$this->cm_purconfact,true);
		$criteria->compare('cm_selltax',$this->cm_selltax,true);
		$criteria->compare('cm_stkunit',$this->cm_stkunit,true);
		$criteria->compare('cm_stkconfac',$this->cm_stkconfac,true);
		$criteria->compare('cm_packsize',$this->cm_packsize,true);
		$criteria->compare('cm_stocktype',$this->cm_stocktype,true);
		$criteria->compare('cm_generic',$this->cm_generic,true);
		$criteria->compare('cm_supplierid',$this->cm_supplierid,true);
		$criteria->compare('cm_mfgcode',$this->cm_mfgcode,true);
		$criteria->compare('cm_maxlevel',$this->cm_maxlevel);
		$criteria->compare('cm_minlevel',$this->cm_minlevel);
		$criteria->compare('cm_reorder',$this->cm_reorder);
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
	 * @return Pproductmaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
