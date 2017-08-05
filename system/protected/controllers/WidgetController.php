<?php

class WidgetController extends AccessController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    public function __construct($id, $module = null) {
        $this->module = 'widget';
        $this->widget = true;
        parent::__construct($id, $module);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Widget;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Widget'])) {
            $model->attributes = $_POST['Widget'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Widget'])) {
            $model->attributes = $_POST['Widget'];
            
            $model->order_box = $_POST['Widget']['order_box'][0];
            $model->is_hot = $_POST['Widget']['is_hot'][0];
            $model->show = $_POST['Widget']['show'][0];
            
            if(isset($_POST['Widget']['categorySelected']) && $_POST['Widget']['categorySelected'])
                $model->category_ids = implode(',',$_POST['Widget']['categorySelected']);
            
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDel($id) {
        $widget = $this->loadModel($id);
        
        if(isset($widget) && $widget) {
            $widget->delete();
            $this->redirect(array('admin'));
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $home = Widget::model()->findAllByAttributes(array(
           'show' => 1, 'status'  => 1
        ), array('order' => 'order_by'));
        
        $category = Widget::model()->findAllByAttributes(array(
           'show' => 2, 'status'  => 1
        ), array('order' => 'order_by'));
        
        $post = Widget::model()->findAllByAttributes(array(
           'show' => 3, 'status'  => 1
        ), array('order' => 'order_by'));
        
        $this->render('admin', array(
            'home' => $home,
            'category' => $category,
            'post' => $post
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Widget the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Widget::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Widget $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'widget-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
