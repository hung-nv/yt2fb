<?php

class MemberController extends AccessController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $module = 'member';
    public $member = true;

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
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Member('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Member']))
            $model->attributes = $_GET['Member'];
        
        
        if(isset($_POST['Vip'])) {
            $id = $_POST['Vip']['id'];
            $month = $_POST['Vip']['number'];
            $member = Member::model()->findByPk($id);
            $member->vip_status = 1;
            $member->vip_end = date('Y-m-d H:i:s', time() + $month*30*86400);
            $member->point += 3000;
            if($member->save())
                $this->redirect(array('admin'));
            else
                var_dump ($member->getError());
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Member the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Member::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Member $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'member-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
