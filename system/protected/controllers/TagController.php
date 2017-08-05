<?php

class TagController extends AccessController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $module  = 'tag';

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
        $this->post = true;
        $model = new Tag('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Tag']))
            $model->attributes = $_GET['Tag'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Tag the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Tag::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Tag $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tag-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
