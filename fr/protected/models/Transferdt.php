<?php

/**
 * This is the model class for table "im_transferdt".
 *
 * The followings are the available columns in table 'im_transferdt':
 * @property integer $id
 * @property string $im_transfernum
 * @property string $cm_code
 * @property string $im_unit
 * @property integer $im_quantity
 * @property string $im_rate
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Transferhd $imTransfernum
 * @property CmProductmaster $cmCode
 */
class Transferdt extends CActiveRecord
{
	public $im_status;
	public $cm_name;
    public $branch;

    public $product_search;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_transferdt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_code', 'required'),
			array('im_quantity', 'numerical', 'integerOnly'=>true),
			array('im_transfernum, cm_code, im_unit, insertuser, updateuser', 'length', 'max'=>50),
			array('im_rate', 'length', 'max'=>20),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, im_transfernum, cm_code,product_search, im_unit, im_quantity, im_rate, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
			array('im_quantity','numerical', 'integerOnly'=>TRUE),
			array('cm_code', 'cmCode'),
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
			'imTransfernum' => array(self::BELONGS_TO, 'Transferhd', 'im_transfernum'),
			'product' => array(self::BELONGS_TO, 'Productmaster', 'cm_code'),
		
			'im_status' => array(self::BELONGS_TO, 'Transferhd', 'im_status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'im_transfernum' => 'Transfer Number',
			'cm_code' => 'Poduct Code',
			'im_unit' => 'Transfer Unit',
			'im_quantity' => 'Transfer Quantity',
			'im_rate' => 'Rate',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',

			'cm_name'=> 'Product Name',
            'product_search'=> 'Product Name',
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
	public function search($im_transfernum)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = "im_transfernum = '$im_transfernum' ";
		
		$criteria->compare('id',$this->id);
		$criteria->compare('im_transfernum',$this->im_transfernum,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('im_unit',$this->im_unit,true);
		$criteria->compare('im_quantity',$this->im_quantity);
		$criteria->compare('im_rate',$this->im_rate,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
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
	 * @return Transferdt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
