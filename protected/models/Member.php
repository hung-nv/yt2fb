<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $created_datetime
 * @property string $vip_start
 * @property string $vip_end
 * @property integer $vip_status
 * @property integer $status
 * @property integer $point
 */
class Member extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $rePassword, $agree;
    public $isForgot = false;

    public function tableName() {
        return 'member';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        if ($this->isForgot) {
            $rules[] = array('email', 'checkExits');
        } else {
            $rules = array(
                array('email, password, point', 'required'),
                array('vip_status, status, point', 'numerical', 'integerOnly' => true),
                array('email, name, password', 'length', 'max' => 255),
                array('vip_start, vip_end, created_datetime', 'safe'),
                array('email', 'validateEmail'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('email, name, password, created_datetime, vip_start, vip_end, vip_status, status, point', 'safe', 'on' => 'search'),
            );
        }

        return $rules;
    }

    public function validateEmail($attribute, $params) {
        if ($this->findByAttributes(array('email' => $this->email)))
            $this->addError($attribute, 'Email này đã được đăng ký! <a href="' . Yii::app()->createUrl('site/forgotpassword') . '">Quên mật khẩu?</a>');
    }
    
    public function checkExits($attribute, $params) {
        if (!$this->findByAttributes(array('email' => $this->email, 'status' => 1)))
            $this->addError($attribute, 'Email này chưa được đăng ký!');
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'email' => 'Email',
            'name' => 'Name',
            'password' => 'Password',
            'created_datetime' => 'Created Datetime',
            'vip_start' => 'Vip Start',
            'vip_end' => 'Vip End',
            'vip_status' => 'Vip Status',
            'status' => 'Status',
            'point' => 'Point',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('email', $this->email, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('created_datetime', $this->created_datetime, true);
        $criteria->compare('vip_start', $this->vip_start, true);
        $criteria->compare('vip_end', $this->vip_end, true);
        $criteria->compare('vip_status', $this->vip_status);
        $criteria->compare('status', $this->status);
        $criteria->compare('point', $this->point);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Member the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
