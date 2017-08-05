<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public $name;
    public $fullname;
    public $id;
    
    public function getId() {
        return $this->id;
    }
        /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $users = array();

        $cmd = Yii::app()->db->createCommand();
        $cmd->select('id,name, email')
                ->from('member')
                ->where('email=:username AND password=:password AND status=:status', array(':username' => $this->username, ':password' => md5($this->password), ':status' => '1'));
        $data = $cmd->queryRow();

        if (!Member::model()->count('email=:username', array(':username' => $this->username)))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$data)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode = self::ERROR_NONE;
        if (!$this->errorCode) {
            $this->name = $this->username;
            //$this->fullname = $data['full_name'];
            $this->id = $data['id'];
            return TRUE;
        }
        return FALSE;
    }
}