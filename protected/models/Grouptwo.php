<?php

/**
 * This is the model class for table "am_group_two".
 *
 * The followings are the available columns in table 'am_group_two':
 * @property integer $id
 * @property string $am_groupone
 * @property string $am_grouptwo
 * @property string $am_description
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 *
 * The followings are the available model relations:
 * @property GroupThree[] $groupThrees
 * @property GroupThree[] $groupThrees1
 * @property GroupOne $amGroupone
 */
class Grouptwo extends CActiveRecord
{
    public $group_one_search;
    public $group1;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'am_group_two';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('am_groupone, am_grouptwo, am_description, insertuser, updateuser', 'length', 'max'=>50),
			array('inserttime, updatetime', 'safe'),
            array('am_groupone, am_grouptwo', 'required'),
            array('am_grouptwo', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, am_groupone, group_one_search, am_grouptwo, am_description, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'groupThrees' => array(self::HAS_MANY, 'GroupThree', 'am_groupone'),
			'groupThrees1' => array(self::HAS_MANY, 'GroupThree', 'am_grouptwo'),
			'grouponed' => array(self::BELONGS_TO, 'Groupone', 'am_groupone'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'am_groupone' => 'Group One',
			'am_grouptwo' => 'Group Two Code',
			'am_description' => 'Group Two Description',
			'inserttime' => 'Inserttime',
			'updatetime' => 'Updatetime',
			'insertuser' => 'Insertuser',
			'updateuser' => 'Updateuser',
            'group_one_search'=>'Group One',
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
	public function search($group1)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

        $criteria -> condition = "am_groupone = '$group1'";

		$criteria->compare('id',$this->id);
		$criteria->compare('am_groupone',$this->am_groupone,true);
		$criteria->compare('am_grouptwo',$this->am_grouptwo,true);
		$criteria->compare('am_description',$this->am_description,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);
		$criteria->order = 'id DESC';

        //$criteria->with = array( 'grouponed' );
        //$criteria->compare( 'grouponed.am_description', $this->group_one_search, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
	                'pageSize' => 15,
	            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grouptwo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
