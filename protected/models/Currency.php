<?php

/**
 * This is the model class for table "cm_currency".
 *
 * The followings are the available columns in table 'cm_currency':
 * @property integer $id
 * @property string $cm_currency
 * @property string $cm_description
 * @property string $cm_exchangerate
 * @property integer $cm_active
 * @property string $inserttime
 * @property string $updatetime
 * @property string $insertuser
 * @property string $updateuser
 */
class Currency extends CActiveRecord
{
    const ACTIVE_YES = 1;
    const ACTIVE_NO = 0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cm_currency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cm_active', 'numerical', 'integerOnly'=>true),
			array('cm_currency', 'length', 'max'=>10),
            array('cm_currency','unique'),
			array('cm_description', 'length', 'max'=>100),
			array('cm_exchangerate', 'length', 'max'=>20),
			array('insertuser, updateuser', 'length', 'max'=>50),
			array('inserttime, updatetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cm_currency, cm_description, cm_exchangerate, cm_active, inserttime, updatetime, insertuser, updateuser', 'safe', 'on'=>'search'),
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
			'cm_currency' => 'Currency',
			'cm_description' => 'Description/ Country',
			'cm_exchangerate' => 'Exchange Rate',
			'cm_active' => 'Active',
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
		$criteria->compare('cm_currency',$this->cm_currency,true);
		$criteria->compare('cm_description',$this->cm_description,true);
		$criteria->compare('cm_exchangerate',$this->cm_exchangerate,true);
		$criteria->compare('cm_active',$this->cm_active);
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
	 * @return Currency the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getActiveOptions(){
        return array(
            self::ACTIVE_YES => 'Yes',
            self::ACTIVE_NO => 'No',
        );
    }

    public function getCurrencyOptions()
    {
        $list=array(
            'AFN'=>'AFN-Afghan afghani',
            'ALL'=>'ALL-Albanian lek',
            'DZD'=>'DZD-Algerian dinar',
            'AOA'=>'AOA-Angolan kwanza',
            'ARS'=>'ARS-Argentine peso',
            'AMD'=>'AMD-Armenian dram',
            'AWG'=>'AWG-Aruban florin',
            'AUD'=>'AUD-Australian dollar',
            'AZN'=>'AZN-Azerbaijani manat',
            'BSD'=>'BSD-Bahamian dollar',
            'BHD'=>'BHD-Bahraini dinar',
            'BDT'=>'BDT-Bangladeshi taka',
            'BBD'=>'BBD-Barbados dollar',
            'BYR'=>'BYR-Belarusian ruble',
            'BZD'=>'BZD-Belize dollar',
            'BMD'=>'BMD-Bermudian dollar',
            'BTN'=>'BTN-Bhutanese ngultrum',
            'BOB'=>'BOB-Bolivian Boliviano',
            'BOV'=>'BOV-Bolivian Mvdol (funds code)',
            'BAM'=>'BAM-Bosnia and Herzegovina convertible mark',
            'BWP'=>'BWP-Botswana pula',
            'BRL'=>'BRL-Brazilian real',
            'BND'=>'BND-Brunei dollar',
            'BGN'=>'BGN-Bulgarian lev',
            'BIF'=>'BIF-Burundian franc',
            'XOF'=>'XOF-CFA franc BCEAO',
            'XAF'=>'XAF-CFA franc BEAC',
            'XPF'=>'XPF-CFP franc',
            'KHR'=>'KHR-Cambodian riel',
            'CAD'=>'CAD-Canadian dollar',
            'CVE'=>'CVE-Cape Verde escudo',
            'KYD'=>'KYD-Cayman Islands dollar',
            'CLF'=>'CLF-Chilean Unidad de Fomento (funds code)',
            'CLP'=>'CLP-Chilean peso',
            'CNY'=>'CNY-Chinese yuan',
            'XTS'=>'XTS-Code reserved for testing purposes',
            'COU'=>'COU-Colombian Unidad de Valor Real',
            'COP'=>'COP-Colombian peso',
            'KMF'=>'KMF-Comoro franc',
            'CDF'=>'CDF-Congolese franc',
            'CRC'=>'CRC-Costa Rican colon',
            'HRK'=>'HRK-Croatian kuna',
            'CUP'=>'CUP-Cuban peso',
            'CUC'=>'CUC-Cuban peso convertible',
            'CZK'=>'CZK-Czech koruna',
            'DKK'=>'DKK-Danish krone',
            'DJF'=>'DJF-Djiboutian franc',
            'DOP'=>'DOP-Dominican peso',
            'XCD'=>'XCD-East Caribbean dollar',
            'EGP'=>'EGP-Egyptian pound',
            'ERN'=>'ERN-Eritrean nakfa',
            'ETB'=>'ETB-Ethiopian birr',
            'XBA'=>'XBA-European Composite Unit',
            'XBB'=>'XBB-European Monetary Unit',
            'EUR'=>'EUR-European Union euro',
            'XBD'=>'XBD-European Unit of Account 17',
            'XBC'=>'XBC-European Unit of Account 9',
            'FKP'=>'FKP-Falkland Islands pound',
            'FJD'=>'FJD-Fiji dollar',
            'GMD'=>'GMD-Gambian dalasi',
            'GEL'=>'GEL-Georgian lari',
            'GHS'=>'GHS-Ghanaian cedi',
            'GIP'=>'GIP-Gibraltar pound',
            'XAU'=>'XAU-Gold (one troy ounce)',
            'GTQ'=>'GTQ-Guatemalan quetzal',
            'GNF'=>'GNF-Guinean franc',
            'GYD'=>'GYD-Guyanese dollar',
            'HTG'=>'HTG-Haitian gourde',
            'HNL'=>'HNL-Honduran lempira',
            'HKD'=>'HKD-Hong Kong dollar',
            'HUF'=>'HUF-Hungarian forint',
            'ISK'=>'ISK-Icelandic króna',
            'INR'=>'INR-Indian rupee',
            'IDR'=>'IDR-Indonesian rupiah',
            'IRR'=>'IRR-Iranian rial',
            'IQD'=>'IQD-Iraqi dinar',
            'ILS'=>'ILS-Israeli new shekel',
            'JMD'=>'JMD-Jamaican dollar',
            'JPY'=>'JPY-Japanese yen',
            'JOD'=>'JOD-Jordanian dinar',
            'KZT'=>'KZT-Kazakhstani tenge',
            'KES'=>'KES-Kenyan shilling',
            'KWD'=>'KWD-Kuwaiti dinar',
            'KGS'=>'KGS-Kyrgyzstani som',
            'LAK'=>'LAK-Lao kip',
            'LVL'=>'LVL-Latvian lats',
            'LBP'=>'LBP-Lebanese pound',
            'LSL'=>'LSL-Lesotho loti',
            'LRD'=>'LRD-Liberian dollar',
            'LYD'=>'LYD-Libyan dinar',
            'LTL'=>'LTL-Lithuanian litas',
            'MOP'=>'MOP-Macanese pataca',
            'MKD'=>'MKD-Macedonian denar',
            'MGA'=>'MGA-Malagasy ariary',
            'MWK'=>'MWK-Malawian kwacha',
            'MYR'=>'MYR-Malaysian ringgit',
            'MVR'=>'MVR-Maldivian rufiyaa',
            'MRO'=>'MRO-Mauritanian ouguiya',
            'MUR'=>'MUR-Mauritian rupee',
            'MXV'=>'MXV-Mexican Unidad de Inversion (funds code)',
            'MXN'=>'MXN-Mexican peso',
            'MDL'=>'MDL-Moldovan leu',
            'MNT'=>'MNT-Mongolian tugrik',
            'MAD'=>'MAD-Moroccan dirham',
            'MZN'=>'MZN-Mozambican metical',
            'MMK'=>'MMK-Myanmar kyat',
            'NAD'=>'NAD-Namibian dollar',
            'NPR'=>'NPR-Nepalese rupee',
            'ANG'=>'ANG-Netherlands Antillean guilder',
            'NZD'=>'NZD-New Zealand dollar',
            'NIO'=>'NIO-Nicaraguan córdoba',
            'NGN'=>'NGN-Nigerian naira',
            'XXX'=>'XXX-No currency',
            'KPW'=>'KPW-North Korean won',
            'NOK'=>'NOK-Norwegian krone',
            'OMR'=>'OMR-Omani rial',
            'PKR'=>'PKR-Pakistani rupee',
            'XPD'=>'XPD-Palladium (one troy ounce)',
            'PAB'=>'PAB-Panamanian balboa',
            'PGK'=>'PGK-Papua New Guinean kina',
            'PYG'=>'PYG-Paraguayan guaraní',
            'PEN'=>'PEN-Peruvian nuevo sol',
            'PHP'=>'PHP-Philippine peso',
            'XPT'=>'XPT-Platinum (one troy ounce)',
            'PLN'=>'PLN-Polish zloty',
            'QAR'=>'QAR-Qatari riyal',
            'RON'=>'RON-Romanian new leu',
            'RUB'=>'RUB-Russian rouble',
            'RWF'=>'RWF-Rwandan franc',
            'SHP'=>'SHP-Saint Helena pound',
            'WST'=>'WST-Samoan tala',
            'SAR'=>'SAR-Saudi riyal',
            'RSD'=>'RSD-Serbian dinar',
            'SCR'=>'SCR-Seychelles rupee',
            'SLL'=>'SLL-Sierra Leonean leone',
            'XAG'=>'XAG-Silver (one troy ounce)',
            'SGD'=>'SGD-Singapore dollar',
            'SBD'=>'SBD-Solomon Islands dollar',
            'SOS'=>'SOS-Somali shilling',
            'ZAR'=>'ZAR-South African rand',
            'KRW'=>'KRW-South Korean won',
            'SSP'=>'SSP-South Sudanese pound',
            'XDR'=>'XDR-Special drawing rights',
            'LKR'=>'LKR-Sri Lankan rupee',
            'SDG'=>'SDG-Sudanese pound',
            'SRD'=>'SRD-Surinamese dollar',
            'SZL'=>'SZL-Swazi lilangeni',
            'SEK'=>'SEK-Swedish krona',
            'CHE'=>'CHE-Swiss WIR Euro (complementary currency)',
            'CHW'=>'CHW-Swiss WIR Franc (complementary currency)',
            'CHF'=>'CHF-Swiss franc',
            'SYP'=>'SYP-Syrian pound',
            'STD'=>'STD-São Tomé and Príncipe dobra',
            'TWD'=>'TWD-Taiwan new dollar',
            'TJS'=>'TJS-Tajikistani somoni',
            'TZS'=>'TZS-Tanzanian shilling',
            'THB'=>'THB-Thai baht',
            'TOP'=>'TOP-Tongan pa?anga',
            'TTD'=>'TTD-Trinidad and Tobago dollar',
            'TND'=>'TND-Tunisian dinar',
            'TRY'=>'TRY-Turkish lira',
            'TMT'=>'TMT-Turkmenistani manat',
            'XFU'=>'XFU-UIC franc (special settlement currency)',
            'UGX'=>'UGX-Ugandan shilling',
            'UAH'=>'UAH-Ukrainian hryvnia',
            'AED'=>'AED-United Arab Emirates dirham',
            'GBP'=>'GBP-United Kingdom pound sterling',
            'USD'=>'USD-United States dollar',
            'USN'=>'USN-United States dollar next day (funds code)',
            'USS'=>'USS-United States dollar same day (funds code)',
            'UYU'=>'UYU-Uruguayan peso',
            'UYI'=>'UYI-Uruguayan unidad indexada (funds code)',
            'UZS'=>'UZS-Uzbekistan som',
            'VUV'=>'VUV-Vanuatu vatu',
            'VEF'=>'VEF-Venezuelan bolívar fuerte',
            'VND'=>'VND-Vietnamese dong',
            'YER'=>'YER-Yemeni rial',
            'ZMW'=>'ZMW-Zambian kwacha',
        );
        asort($list);
        return $list;
    }

}
