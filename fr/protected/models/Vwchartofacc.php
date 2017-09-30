<?php

/**
 * This is the model class for table "am_vw_chartofacc".
 *
 * The followings are the available columns in table 'am_vw_chartofacc':
 * @property integer $id
 * @property string $am_accounttype
 * @property string $Group_One
 * @property string $Group_Two
 * @property string $Group_Three
 * @property string $Group_Four
 * @property string $am_accountcode
 * @property string $am_description
 * @property string $am_accountusage
 * @property string $am_analyticalcode
 * @property string $am_status
 */
class Vwchartofacc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'am_vw_chartofacc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('am_accountcode, am_description', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('am_accounttype, am_accountcode, am_accountusage, am_status', 'length', 'max'=>50),
			array('Group_One, Group_Two, Group_Three, Group_Four', 'length', 'max'=>101),
			array('am_description', 'length', 'max'=>100),
			array('am_analyticalcode', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, am_accounttype, Group_One, Group_Two, Group_Three, Group_Four, am_accountcode, am_description, am_accountusage, am_analyticalcode, am_status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'am_accounttype' => 'Account Type',
			'Group_One' => 'Group One',
			'Group_Two' => 'Group Two',
			'Group_Three' => 'Group Three',
			'Group_Four' => 'Group Four',
			'am_accountcode' => 'Account Code',
			'am_description' => 'Account Description',
			'am_accountusage' => 'Account Usage',
			'am_analyticalcode' => 'Analytic Type',
			'am_status' => 'Status',
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
		$criteria->compare('am_accounttype',$this->am_accounttype,true);
		$criteria->compare('Group_One',$this->Group_One,true);
		$criteria->compare('Group_Two',$this->Group_Two,true);
		$criteria->compare('Group_Three',$this->Group_Three,true);
		$criteria->compare('Group_Four',$this->Group_Four,true);
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('am_description',$this->am_description,true);
		$criteria->compare('am_accountusage',$this->am_accountusage,true);
		$criteria->compare('am_analyticalcode',$this->am_analyticalcode,true);
		$criteria->compare('am_status',$this->am_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vwchartofacc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
