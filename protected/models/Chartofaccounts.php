<?php

/**
 * This is the model class for table "am_chartofaccounts".
 *
 * The followings are the available columns in table 'am_chartofaccounts':
 * @property string $am_accountcode
 * @property string $am_description
 * @property string $am_accounttype
 * @property string $am_accountusage
 * @property string $am_groupone
 * @property string $am_grouptwo
 * @property string $am_groupthree
 * @property string $am_groupfour
 * @property string $am_analyticalcode
 * @property string $am_branch
 * @property string $am_status
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Chartofaccounts extends CActiveRecord
{
	public $group_one;
	public $group_two;
	public $group_three;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'am_chartofaccounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('id', 'numerical', 'integerOnly'=>true),
			array('am_accountcode, am_description', 'required'),
            array('am_accountcode','unique'),
			array('am_accountcode, am_accounttype, am_accountusage, am_groupone, am_grouptwo, am_groupthree, am_groupfour, am_branch, am_status, insertuser, updateuser', 'length', 'max'=>50),
			array('am_description', 'length', 'max'=>100),
			array('am_analyticalcode', 'length', 'max'=>10),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, am_accountcode, am_description, am_accounttype, am_accountusage, am_groupone, am_grouptwo, am_groupthree, am_groupfour, am_analyticalcode, am_branch, am_status, inserttime, updatetime, insertuser, updateuser, date_first, date_last', 'safe', 'on'=>'search'),
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
            'id'=>'ID',
			'am_accountcode' => 'Account Code',
			'am_description' => 'Description',
			'am_accounttype' => 'Account Type',
			'am_accountusage' => 'A/C Record Type',
			'am_groupone' => 'Group One',
			'am_grouptwo' => 'Group Two',
			'am_groupthree' => 'Group Three',
			'am_groupfour' => 'Group Four',
			'am_analyticalcode' => 'Analytic Code',
			'am_branch' => 'Branch',
			'am_status' => 'Status',
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
		$criteria->compare('am_accountcode',$this->am_accountcode,true);
		$criteria->compare('am_description',$this->am_description,true);
		$criteria->compare('am_accounttype',$this->am_accounttype,true);
		$criteria->compare('am_accountusage',$this->am_accountusage,true);
		$criteria->compare('am_groupone',$this->am_groupone,true);
		$criteria->compare('am_grouptwo',$this->am_grouptwo,true);
		$criteria->compare('am_groupthree',$this->am_groupthree,true);
		$criteria->compare('am_groupfour',$this->am_groupfour,true);
		$criteria->compare('am_analyticalcode',$this->am_analyticalcode,true);
		$criteria->compare('am_branch',$this->am_branch,true);
		$criteria->compare('am_status',$this->am_status,true);
		$criteria->compare('inserttime',$this->inserttime,true);
		$criteria->compare('updatetime',$this->updatetime,true);
		$criteria->compare('insertuser',$this->insertuser,true);
		$criteria->compare('updateuser',$this->updateuser,true);
		
		$criteria->select = 't.*, m.am_description as group_one, n.am_description as group_two, o.am_description as group_three';
		//$criteria->select = 't.*, m.am_description as group_one, n.am_description as group_two, o.am_description as group_three';
		$criteria->join = 'INNER JOIN am_group_one m ON t.am_groupone = m.am_groupone';
		$criteria->join .= ' INNER JOIN am_group_two n ON t.am_groupone = n.am_groupone';
		$criteria->join .= ' INNER JOIN am_group_three o ON t.am_groupone = o.am_groupone';
		//$criteria->join .= ' INNER JOIN am_group_three o ON t.am_groupone = n.am_groupone AND t.am_grouptwo = n.am_grouptwo AND t.am_groupthree = o.am_groupthree';
		
		//var_dump($criteria);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function searchNew()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
        $criteria->compare('am_accountcode',$this->am_accountcode,true);
        $criteria->compare('am_description',$this->am_description,true);
        $criteria->compare('am_accounttype',$this->am_accounttype,true);
        $criteria->compare('am_accountusage',$this->am_accountusage,true);
        $criteria->compare('am_groupone',$this->am_groupone,true);
        $criteria->compare('am_grouptwo',$this->am_grouptwo,true);
        $criteria->compare('am_groupthree',$this->am_groupthree,true);
        $criteria->compare('am_groupfour',$this->am_groupfour,true);
        $criteria->compare('am_analyticalcode',$this->am_analyticalcode,true);
        $criteria->compare('am_branch',$this->am_branch,true);
        $criteria->compare('am_status',$this->am_status,true);
        $criteria->compare('inserttime',$this->inserttime,true);
        $criteria->compare('updatetime',$this->updatetime,true);
        $criteria->compare('insertuser',$this->insertuser,true);
        $criteria->compare('updateuser',$this->updateuser,true);

        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Chartofaccounts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getAccountType()
	{
		return array(
			'Asset' => 'Asset',
			'Liability' => 'Liability',
			'Income' => 'Income',
			'Expenses' => 'Expenses',
		);
	}
	
	public function getAccountUsage()
	{
		return array(
			'Ledger' => 'Ledger',
			'AP' => 'AP',
			'AR' => 'AR',
		);
	}


    function getChartOfAccount()
    {
        return $this->am_accountcode.' - '.$this->am_description;
    }
	
	
}
