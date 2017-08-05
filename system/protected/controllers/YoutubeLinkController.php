<?php

class YoutubeLinkController extends AccessController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $module = 'youtubeLink';
    public $youtube = true;

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDel($id) {
        $youtube = $this->loadModel($id);

        if (isset($youtube) && $youtube) {
            if ($youtube->delete())
                $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new YoutubeLink('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['YoutubeLink']))
            $model->attributes = $_GET['YoutubeLink'];

        if (isset($_POST['Ads'])) {
            $id = $_POST['Ads']['id'];
            $headline = $_POST['Ads']['fb_headline'];
            $description = $_POST['Ads']['fb_description'];
            $direct = $_POST['Ads']['murl_redirect'];
            $sql = 'update youtube_link set fb_headline = "' . $headline . '", fb_description="' . $description . '", murl_redirect="' . $direct . '" where id=' . $id;
            $cmd = Yii::app()->db->createCommand($sql);

            if ($cmd->execute())
                $this->redirect(array('admin'));
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return YoutubeLink the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = YoutubeLink::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param YoutubeLink $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'youtube-link-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
