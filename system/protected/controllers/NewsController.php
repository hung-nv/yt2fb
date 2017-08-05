<?php

class NewsController extends AccessController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $module = 'news';

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
        $this->post = true;
        $this->isEditor = true;
        $model = new News;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];

            if (isset($_POST['News']['tagSelected']) && $_POST['News']['tagSelected'])
                $model->tag = implode(',', $_POST['News']['tagSelected']);

            $model->imgFile = CUploadedFile::getInstance($model, 'image');
            $model->author = Yii::app()->user->name;
            if ($model->save()) {
                $upload = false;

                if (isset($model->imgFile) && $model->imgFile) {
                    $fileName = preg_replace('/\s+/', '', $model->id . '_' . $this->cv2url($model->imgFile->getName()));
                    $model->imgFile->saveAs('../uploads/news/' . $fileName);
                    $upload = true;
                }

                if ($upload) {
                    $model->image = $fileName;
                    $model->save();
                    $this->redirect(array('admin'));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionCreatepage() {
        $this->pages = true;
        $this->isEditor = true;
        $model = new News;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];

            $model->ispage = 1;
            $model->author = Yii::app()->user->name;

            if ($model->save())
                $this->redirect(array('adminpage'));
        }

        $this->render('createpage', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->post = true;
        $this->isEditor = true;
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];
            $model->imgFile = CUploadedFile::getInstance($model, 'image');
            $model->updated_datetime = date('Y-m-d H:i:s', time());
            if (isset($_POST['News']['tagSelected']) && $_POST['News']['tagSelected'])
                $model->tag = implode(',', $_POST['News']['tagSelected']);

            if ($model->save()) {
                $upload = false;

                if (isset($model->imgFile) && $model->imgFile) {
                    if ($model->oldImage) {
                        if (file_exists('../uploads/news/' . $model->oldImage))
                            unlink('../uploads/news/' . $model->oldImage);
                    }

                    $fileName = preg_replace('/\s+/', '', $model->id . '_' . $this->cv2url($model->imgFile->getName()));
                    $model->imgFile->saveAs('../uploads/news/' . $fileName);
                    $upload = true;
                }

                if ($upload) {
                    $model->image = $fileName;
                    $model->save();
                    Yii::app()->user->setFlash('newsUpdate', 'Cập nhật thành công');
                    $this->redirect(array('update', 'id' => $model->id));
                }
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionUpdatepage($id) {
        $this->pages = true;
        $this->isEditor = true;
        $model = $this->loadModel($id);

        if (isset($_POST['News'])) {
            $model->attributes = $_POST['News'];
            $model->updated_datetime = date('Y-m-d H:i:s', time());

            if ($model->save()) {
                Yii::app()->user->setFlash('newsUpdate', 'Cập nhật thành công');
                $this->redirect(array('updatepage', 'id' => $model->id));
            }
        }

        $this->render('updatepage', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDel($id) {
        $news = $this->loadModel($id);

        if (isset($news) && $news) {
            if (file_exists('../uploads/news/' . $news->image) && $news->image)
                unlink('../uploads/news/' . $news->image);

            if ($news->delete())
                $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    function cv2url($text) {
        $text = str_replace(
                array(' ', '%', "/", "\\", '"', '``', '?', '<', '>', "#", "^", "`", "'", "=", "!", ":", ",,", "..", "*", "&", "--", "▄"), array('-', '', '', '', '', '', '', '', '', '', '', '', '', '-', '', '-', '', '', '', "-", "", ""), $text);
        $chars = array("a", "a", "e", "e", "o", "o", "u", "u", "i", "i", "d", "d", "y", "y");
        $uni[0] = array("á", "à", "ạ", "ả", "ã", "â", "ấ", "ầ", "ậ", "ẩ", "ẫ", "ă", "ắ", "ằ", "ặ", "ẳ", "� �");
        $uni[1] = array("Á", "À", "Ạ", "Ả", "Ã", "Â", "Ấ", "Ầ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ắ", "Ằ", "Ặ", "Ẳ", "� �");
        $uni[2] = array("é", "è", "ẹ", "ẻ", "ẽ", "ê", "ế", "ề", "ệ", "ể", "ễ");
        $uni[3] = array("É", "È", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ế", "Ề", "Ệ", "Ể", "Ễ");
        $uni[4] = array("ó", "ò", "ọ", "ỏ", "õ", "ô", "ố", "ồ", "ộ", "ổ", "ỗ", "ơ", "ớ", "ờ", "ợ", "ở", "� �");
        $uni[5] = array("Ó", "Ò", "Ọ", "Ỏ", "Õ", "Ô", "Ố", "Ồ", "Ộ", "Ổ", "Ỗ", "Ơ", "Ớ", "Ờ", "Ợ", "Ở", "� �");
        $uni[6] = array("ú", "ù", "ụ", "ủ", "ũ", "ư", "ứ", "ừ", "ự", "ử", "ữ");
        $uni[7] = array("Ú", "Ù", "Ụ", "Ủ", "Ũ", "Ư", "Ứ", "Ừ", "Ự", "Ử", "Ữ");
        $uni[8] = array("í", "ì", "ị", "ỉ", "ĩ");
        $uni[9] = array("Í", "Ì", "Ị", "Ỉ", "Ĩ");
        $uni[10] = array("đ");
        $uni[11] = array("Đ");
        $uni[12] = array("ý", "ỳ", "ỵ", "ỷ", "ỹ");
        $uni[13] = array("Ý", "Ỳ", "Ỵ", "Ỷ", "Ỹ");
        for ($i = 0; $i <= 13; $i++) {
            $text = str_replace($uni[$i], $chars[$i], $text);
        }
        return $text;
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->post = true;
        $model = new News('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['News']))
            $model->attributes = $_GET['News'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionAdminpage() {
        $this->pages = true;
        $model = new News('search');
        $model->unsetAttributes();  // clear any default values
        $model->page = true;
        if (isset($_GET['News']))
            $model->attributes = $_GET['News'];

        $this->render('adminpage', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return News the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = News::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param News $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
