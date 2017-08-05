<?php

class CategoriesController extends AccessController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $module = 'categories';
    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Categories;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Categories'])) {
            $model->attributes = $_POST['Categories'];

            if (isset($_POST['Categories']['groupsSelected']) && $_POST['Categories']['groupsSelected'])
                $model->groups = implode(',', $model->groupsSelected);

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
    public function actionGetinfor($id) {
        $this->layout = '/layouts/blank';
        $model = Yii::app()->db->createCommand('select * from categories where id=' . $id)->queryRow();
        echo json_encode($model);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDel($id) {
        $this->loadModel($id)->delete();
        echo json_encode($id);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->categories = true;
        $modelSearch = new Categories('search');
        $modelSearch->unsetAttributes();  // clear any default values
        if (isset($_GET['Categories']))
            $modelSearch->attributes = $_GET['Categories'];

        $model = new Categories;
        if (isset($_POST['Categories'])) {
            $model->title = $_POST['Categories']['title'];
            $model->alias = $_POST['Categories']['alias'];
            $model->parent_id = $_POST['Categories']['parent_id'];
            $model->showas = $_POST['Categories']['showas'];
            $model->status = $_POST['Categories']['status'];
            $model->meta_description = $_POST['Categories']['meta_description'];
            $model->meta_title = $_POST['Categories']['meta_title'];

            if (isset($_POST['Categories']['groupsSelected']) && $_POST['Categories']['groupsSelected'])
                $model->groups = implode(',', $_POST['Categories']['groupsSelected']);

            if (isset($_POST['Categories']['id']) && $_POST['Categories']['id']) {
                $model->updateByPk($_POST['Categories']['id'], array(
                    'title' => $model->title,
                    'alias' => $model->alias,
                    'parent_id' => $model->parent_id,
                    'showas' => $model->showas,
                    'groups' => $model->groups,
                    'meta_description' => $model->meta_description,
                    'meta_title' => $model->meta_title,
                    'status' => $model->status
                ));
                Yii::app()->user->setFlash('categories', 'Update successful!');
                $this->redirect(array('admin'));
            } else {
                if ($model->save()) {
                    Yii::app()->user->setFlash('categories', 'Create category successful!');
                    $this->redirect(array('admin'));
                }
            }
        }

        $this->render('adminCate', array(
            'modelSearch' => $modelSearch,
            'model' => $model
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Categories the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Categories::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Categories $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'categories-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
