<?php

/**
 * This is the model class for table "im_grndetail".
 *
 * The followings are the available columns in table 'im_grndetail':
 * @property integer $id
 * @property string $im_grnnumber
 * @property string $cm_code
 * @property string $im_BatchNumber
 * @property string $im_ExpireDate
 * @property integer $im_RcvQuantity
 * @property string $im_costprice
 * @property string $im_unit
 * @property integer $im_unitqty
 * @property string $im_rowamount
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property Grnheader $imGrnnumber
 * @property CmProductmaster $cmCode
 */
class Grndetail extends CActiveRecord
{
	public $im_grnnumber;
	public $pp_purordnum;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_grndetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('im_BatchNumber, im_RcvQuantity, im_ExpireDate', 'required'),
			array('im_RcvQuantity, im_unitqty', 'numerical', 'integerOnly'=>true),
			array('im_grnnumber, cm_code, im_BatchNumber, im_unit, insertuser, updateuser', 'length', 'max'=>50),
			array('im_costprice, im_rowamount', 'length', 'max'=>20),
			array('im_ExpireDate, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, im_grnnumber, cm_code, im_BatchNumber, im_ExpireDate, im_RcvQuantity, im_costprice, im_unit, im_unitqty, im_rowamount, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
			//array('im_RcvQuantity', 'imRcvQuantity'),
		);
	}

	/*
	 * 
	 * 
	public function imRcvQuantity($im_RcvQuantity)
	{
		if(!empty($this->im_RcvQuantity))  
	    {     
	        $record = VwPurchasedt::model()->findByAttributes(array('cm_code' => $this->cm_code))->pp_quantity;
	        if($record < $this->im_RcvQuantity)
	        {
	            $this->addError($im_RcvQuantity, 'Received quantity must be Less OR Equal to Quantity');
	        }
	    }
	 }
	 
	 */
	 
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'imGrnnumber' => array(self::BELONGS_TO, 'Grnheader', 'im_grnnumber'),
			'cmCode' => array(self::BELONGS_TO, 'CmProductmaster', 'cm_code'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'im_grnnumber' => 'GRN Number',
			'cm_code' => 'Product Code',
			'im_BatchNumber' => 'Batch Number',
			'im_ExpireDate' => 'Expire Date',
			'im_RcvQuantity' => 'Received Quantity',
			'im_costprice' => 'Cost Price',
			'im_unit' => 'Unit ',
			'im_unitqty' => 'Unit Quantity',
			'im_rowamount' => 'Total Value',
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
		$criteria->compare('im_grnnumber',$this->im_grnnumber,true);
		$criteria->compare('cm_code',$this->cm_code,true);
		$criteria->compare('im_BatchNumber',$this->im_BatchNumber,true);
		$criteria->compare('im_ExpireDate',$this->im_ExpireDate,true);
		$criteria->compare('im_RcvQuantity',$this->im_RcvQuantity);
		$criteria->compare('im_costprice',$this->im_costprice,true);
		$criteria->compare('im_unit',$this->im_unit,true);
		$criteria->compare('im_unitqty',$this->im_unitqty);
		$criteria->compare('im_rowamount',$this->im_rowamount,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
		
	
	public function grnSearch($pp_purordnum)
	{
		
		$criteria=new CDbCriteria;
		
		$criteria->condition = "t.im_grnnumber = '$pp_purordnum' ";
		$criteria->order= 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grndetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	

	

        
        public function getGrnData(){
        	
        		$criteria=new CDbCriteria;
                $criteria->together = true;
                
		        $sql = Yii::app()->db->createCommand()
					    ->select('t.im_grnnumber, t.im_purordnum, r.cm_code, r.pp_quantity, r.pp_unit, r.pp_unitqty, r.pp_purchasrate, p.cm_description, p.cm_code')
					    ->from('im_grnheader t')
					    ->join('pp_purchaseorddt r', 't.im_purordnum = r.pp_purordnum')
					    ->join('cm_productmaster p', 'p.cm_code = r.cm_code') ;
					    //->where('id=:id', array(':id'=>$id))
					    //->order('im_grnnumber DESC')
					    //->queryAll();
		
		        return Yii::app()->db->createCommand($sql)->queryAll();
            }
            
            
            
}
