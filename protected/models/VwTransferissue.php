<?php

/**
 * This is the model class for table "im_vw_transferissue".
 *
 * The followings are the available columns in table 'im_vw_transferissue':
 * @property string $ProCode
 * @property string $Batch
 * @property string $FromStore
 * @property string $IssueQty
 */
class VwTransferissue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'im_vw_transferissue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ProCode, Batch, FromStore', 'length', 'max'=>50),
			array('IssueQty', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ProCode, Batch, FromStore, IssueQty', 'safe', 'on'=>'search'),
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
			'ProCode' => 'Pro Code',
			'Batch' => 'Batch',
			'FromStore' => 'From Store',
			'IssueQty' => 'Issue Qty',
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

		$criteria->compare('ProCode',$this->ProCode,true);
		$criteria->compare('Batch',$this->Batch,true);
		$criteria->compare('FromStore',$this->FromStore,true);
		$criteria->compare('IssueQty',$this->IssueQty,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VwTransferissue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
