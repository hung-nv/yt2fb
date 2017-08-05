<?php

/**
 * This is the model class for table "ipcountry".
 *
 * The followings are the available columns in table 'ipcountry':
 * @property string $ipFROM
 * @property string $ipTO
 * @property string $countrySHORT
 * @property string $countryLONG
 */
class Ipcountry extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ipcountry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ipFROM, ipTO', 'length', 'max'=>10),
			array('countrySHORT', 'length', 'max'=>2),
			array('countryLONG', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ipFROM, ipTO, countrySHORT, countryLONG', 'safe', 'on'=>'search'),
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
			'ipFROM' => 'Ip From',
			'ipTO' => 'Ip To',
			'countrySHORT' => 'Country Short',
			'countryLONG' => 'Country Long',
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

		$criteria->compare('ipFROM',$this->ipFROM,true);
		$criteria->compare('ipTO',$this->ipTO,true);
		$criteria->compare('countrySHORT',$this->countrySHORT,true);
		$criteria->compare('countryLONG',$this->countryLONG,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ipcountry the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
