<?php

/**
 * This is the model class for table "hr_personalinfo".
 *
 * The followings are the available columns in table 'hr_personalinfo':
 * @property integer $id
 * @property string $empid
 * @property string $empname
 * @property string $doj
 * @property string $doc
 * @property string $grade
 * @property string $deptname
 * @property string $designation
 * @property string $bank
 * @property string $acccode
 * @property string $currency
 * @property string $exchangerate
 * @property string $amount
 * @property string $leaveplan
 * @property string $dob
 * @property string $gender
 * @property string $present
 * @property string $parmanent
 * @property string $cellno
 * @property string $phone
 * @property string $email
 * @property string $branch
 * @property string $status
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Personalinfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hr_personalinfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('empid, bank, acccode, leaveplan, gender, email, branch', 'length', 'max'=>50),
			array('empname', 'length', 'max'=>150),
			array('grade', 'length', 'max'=>10),
			array('deptname, designation', 'length', 'max'=>100),
			array('currency, exchangerate, amount, cellno, phone, status, insertuser, updateuser', 'length', 'max'=>20),
			array('present, parmanent', 'length', 'max'=>300),
			array('doj, doc, dob, inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, empid, empname, doj, doc, grade, deptname, designation, bank, acccode, currency, exchangerate, amount, leaveplan, dob, gender, present, parmanent, cellno, phone, email, branch, status, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'empid' => 'Employee ID',
			'empname' => 'Employee Name',
			'doj' => 'Date of Joining',
			'doc' => 'Date of Confirmation',
			'grade' => 'Position',
			'deptname' => 'Department',
			'designation' => 'Designation',
			'bank' => 'Bank / Cash in Hand',
			'acccode' => 'Bank A/C No',
			'currency' => 'Currency',
			'exchangerate' => 'Exchange Rate',
			'amount' => 'Total Salary / Wages',
			'leaveplan' => 'Leave Plan',
			'dob' => 'Date of Birth',
			'gender' => 'Gender',
			'present' => 'Present Address',
			'parmanent' => 'Parmanent Address',
			'cellno' => 'Cell No',
			'phone' => 'Land Phone',
			'email' => 'Email',
			'branch' => 'Branch',
			'status' => 'Status',
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
		$criteria->compare('empid',$this->empid,true);
		$criteria->compare('empname',$this->empname,true);
		$criteria->compare('doj',$this->doj,true);
		$criteria->compare('doc',$this->doc,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('deptname',$this->deptname,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('acccode',$this->acccode,true);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('exchangerate',$this->exchangerate,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('leaveplan',$this->leaveplan,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('present',$this->present,true);
		$criteria->compare('parmanent',$this->parmanent,true);
		$criteria->compare('cellno',$this->cellno,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('branch',$this->branch,true);
		$criteria->compare('status',$this->status,true);
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
	 * @return Personalinfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
