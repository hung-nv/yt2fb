<?php

class MyAccountController extends AccessController {

    public $layout = '//layouts/column1';

    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('changepassword', 'view'),
                'users' => array('@'),
            //'expression' => (string) Yii::app()->user->authenticate($this->moduleId)
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    public function actionChangePassword() {
        $model = $this->loadModel(Yii::app()->user->id);
        $model->isChangePassword = TRUE;
        $model->password = NULL;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('changepassword', array(
            'model' => $model,
        ));
    }
    
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}