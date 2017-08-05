<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id
 * @property string $username
 * @property string $fullname
 * @property string $password
 * @property string $module
 * @property integer $status
 */
class User extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public $moduleSelected;
    private $oldUserName;
    public $oldPassword;
    public $rePassword;
    public $isChangePassword = FALSE;

    public function afterFind() {
        $this->moduleSelected = explode(',', $this->module);
        $this->oldUserName = $this->username;
        return parent::afterFind();
    }

    public function beforeSave() {
        $this->module = implode(',', $this->moduleSelected);
        if ($this->isChangePassword)
            $this->password = md5($this->password);
        return parent::beforeSave();
    }

    public function afterSave() {
        $this->password = NULL;
        return parent::afterSave();
    }

    public function getListModule() {
        $moduleList = Yii::app()->params['module'];
        $result = array();
        foreach ($moduleList as $key => $value) {
            $result[$key] = $value['name'];
        }

        return $result;
    }

    public function getModuleListNames() {
        $moduleList = Yii::app()->params['module'];
        $result = array();
        foreach ($this->moduleSelected as $value) {
            $result[] = $moduleList[$value]['name'];
        }
        return implode(', ', $result);
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'admin';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.

        if ($this->isNewRecord) {
            $rules[] = array('username', 'unique');
        } else if (!$this->isChangePassword) {
            $rules[] = array('username', 'checkUserName');
        }

        if ($this->isChangePassword) {
            //$rules[] = array('rePassword', 'compare', 'compareAttribute' => 'password');
            $rules[] = array('oldPassword', 'checkOldPassword');
            $rules[] = array('oldPassword, rePassword', 'required');
        }
        return $rules;
    }

    public function checkUserName($attribute, $params) {
        if ($this->username != $this->oldUserName) {
            if ($this->findAllByAttributes(array('username' => $this->username)))
                $this->addError($attribute, 'Username "' . $this->username . '" has already been taken.');
        }
    }

    public function checkOldPassword($attribute, $params) {
        if (!$this->findAllByAttributes(array('id' => $this->id, 'password' => md5($this->oldPassword)))) {
            $this->addError($attribute, 'Mật khẩu cũ không đúng');
        }
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
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'module' => 'Module',
            'fullname' => 'Fullname',
            'status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('module', $this->module, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}