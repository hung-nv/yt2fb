<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessController
 *
 * @author BUI VAN UY
 */
class AccessController extends Controller {

    public $layout = '//layouts/column2';
    public $defaultAction = 'admin';
    public $module;

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'del', 'create', 'update', 'delete', 'getinfor', 'adminpage', 'createpage', 'updatepage'),
                'users' => array('@'),
                'expression' => (string) Yii::app()->user->authenticate($this->module)
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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
            $this->account = User::model()->findByAttributes(array('username' => Yii::app()->user->name, 'status' => 1));
        return $this->account;
    }

}

?>