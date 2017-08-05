<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CWebUser
 *
 */
class UWebUser extends CWebUser {

    private $account;
    public $returnUrl = 'index.php?r=categories/admin';
    public $moduleSelected;

    public function getMainMenu() {
        $menu = array();
        $account = $this->getAccount();
        
        if ($account) {
            $moduleList = Yii::app()->params['module'];
            $accountModules = explode(',', $account->module);
            foreach ($accountModules as $item) {
                if (isset($moduleList[$item]))
                    $menu[] = array('label' => $moduleList[$item]['name'], 'url' => $moduleList[$item]['url']);
            }
        }
        if ($this->isGuest) {
            $menu[] = array('label' => 'Login', 'url' => array('/site/login'));
        } else {
            $menu[] = array('label' => 'Change Password', 'url' => array('/myaccount/changepassword'));
            $menu[] = array('label' => 'Logout (' . $this->name . ')', 'url' => array('/site/logout'));
        }
        return $menu;
    }
    
    public function authenticate($module) {
        $account = $this->getAccount();
        if ($account) {
            $accountModules = explode(',', $account->module);
            return in_array($module, $accountModules);
        }
        return FALSE;
    }

    public function getAccount() {
        if (!$this->account)
            $this->account = User::model()->findByAttributes(array('username' => $this->name, 'status' => 1));
        return $this->account;
    }
}

?>