<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionGetlink($id) {
        $youtube = YoutubeLink::model()->findByPk($id);
        if (!isset($youtube) && !$youtube)
            $this->redirect('site/error');

        $this->meta = array(
            'title' => 'Chuyển đổi link video để chạy trên Facebook',
            'description' => ''
        );

        $link = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $id . '-' . $this->convertLink($youtube->fb_headline);

        $iframe = 'https://www.youtube.com/embed/' . $youtube->youtube_id;

        $this->render('getlink', array(
            'youtube' => $youtube,
            'link' => $link,
            'iframe' => $iframe
        ));
    }

    public function actionMakevideo($id, $alias) {
        $this->layout = '//layouts/blank';

        $youtube = YoutubeLink::model()->findByAttributes(array('id' => $id, 'status' => 1));

        if ((!isset($youtube) && !$youtube) || $this->convertLink($youtube->fb_headline) != $alias)
            $this->redirect('site/error');

        $youtube->view += 1;
        $youtube->save();

        $ip = $_SERVER['REMOTE_ADDR'];

        //block ip fb
        $iparr = explode('.', $ip);
        if (isset($iparr) && $iparr)
            array_pop($iparr);
        $ipblock = implode('.', $iparr);

        $fb = file("ipblock.txt", FILE_IGNORE_NEW_LINES);
        //end
        //allow ip thailand
        $ipno = $this->Dot2LongIP($ip);
        $sql = "select * from ipcountry where $ipno <= ipTo order by ipTo limit 1";
        $iplocation = Ipcountry::model()->findBySql($sql);

        $ua = $_SERVER['HTTP_USER_AGENT'];

        if (in_array($ipblock, $fb) || preg_match('/facebookexternalhit/si', $ua))
            $check = false;
        else
            $check = true;

        if ($youtube->member_id != null && $check) {
            $member = Member::model()->findByPk($youtube->member_id);
            if ($member->vip_status == 1 && (strtotime($member->vip_end) > strtotime(date('Y-m-d H:i:s')))) {
                $murl = $youtube->murl_redirect;
            }
        } else {
            $murl = '';
        }

        $this->render('makevideo', array(
            'youtube' => $youtube,
            'murl' => $murl
        ));
    }

    function Dot2LongIP($IPaddr) {
        if ($IPaddr == "") {
            return 0;
        } else {
            $ips = explode(".", "$IPaddr");
            return ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
        }
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

        $youtube = new YoutubeLink;

        if (isset($_POST['YoutubeLink'])) {
            $youtube->attributes = $_POST['YoutubeLink'];

            if (isset($_POST['YoutubeLink']['fb_headline']) && $_POST['YoutubeLink']['fb_headline'])
                $youtube->fb_headline = $_POST['YoutubeLink']['fb_headline'];
            else
                $youtube->fb_headline = $_POST['save-title'];

            if (isset($_POST['YoutubeLink']['fb_description']) && $_POST['YoutubeLink']['fb_description'])
                $youtube->fb_description = $_POST['YoutubeLink']['fb_description'];
            else
                $youtube->fb_description = $_POST['save-description'];

            if (isset($_POST['YoutubeLink']['fb_sitename']) && $_POST['YoutubeLink']['fb_sitename'])
                $youtube->fb_sitename = $_POST['YoutubeLink']['fb_sitename'];

            $youtube->imgFile = CUploadedFile::getInstance($youtube, 'fb_thumbnail');
            if (isset($youtube->imgFile) && $youtube->imgFile) {
                $fileName = preg_replace('/\s+/', '', time() . '_' . $this->cv2url($youtube->imgFile->getName()));
                $youtube->imgFile->saveAs('images/yt_thumbs/' . $fileName);
                $filesave = 'http://' . $_SERVER['HTTP_HOST'] . '/images/yt_thumbs/' . $fileName;
                $youtube->fb_thumbnail = $filesave;
            } else {
                $youtube->fb_thumbnail = $_POST['save-image'];
            }

            if (isset($_POST['YoutubeLink']['purl_redirect']) && $_POST['YoutubeLink']['purl_redirect'])
                $youtube->purl_redirect = $_POST['YoutubeLink']['purl_redirect'];

            if (isset($_POST['YoutubeLink']['murl_redirect']) && $_POST['YoutubeLink']['murl_redirect'])
                $youtube->murl_redirect = $_POST['YoutubeLink']['murl_redirect'];

            $youtube->youtube_id = $_POST['save-yid'];

            if (!Yii::app()->user->isGuest)
                $youtube->member_id = Yii::app()->user->id;

            if ($youtube->save()) {
                $this->redirect(Yii::app()->createUrl('site/getlink', array('id' => $youtube->id)));
            }
        }

        $setting = Setting::model()->findByPk(1);
        $this->meta = array(
            'title' => $setting->meta_title,
            'description' => $setting->meta_description
        );

        $this->render('index', array(
            'youtube' => $youtube
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionGetinforvideo() {
        $this->layout = '//layouts/blank';

        if (Yii::app()->getRequest()->getParam('url'))
            $url_youtube = Yii::app()->getRequest()->getParam('url');

        $videoid = $this->getYTid($url_youtube);
    }

    function get_infor_youtube($url) {

        $youtube = "http://www.youtube.com/oembed?url=" . $url . "&format=json";

        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);
    }

    function get_youtube_content($url) {
        if (!function_exists('curl_init')) {
            die('CURL is not installed!');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($http_status == '403') ? false : $output;
    }

    function getYTid($ytURL) {

        $ytvIDlen = 11; // This is the length of YouTube's video IDs
        // The ID string starts after "v=", which is usually right after 
        // "youtube.com/watch?" in the URL
        $idStarts = strpos($ytURL, "?v=");

        // In case the "v=" is NOT right after the "?" (not likely, but I like to keep my 
        // bases covered), it will be after an "&":
        if ($idStarts === FALSE)
            $idStarts = strpos($ytURL, "&v=");
        // If still FALSE, URL doesn't have a vid ID
        if ($idStarts === FALSE)
            die("YouTube video ID not found. Please double-check your URL.");

        // Offset the start location to match the beginning of the ID string
        $idStarts +=3;

        // Get the ID string and return it
        $ytvID = substr($ytURL, $idStarts, $ytvIDlen);

        return $ytvID;
    }

    function convertLink($string) {
        $a = array("\\", '*', '^', '`', '~', '$', 'ä', '%', ' - ', '\"', '#', '…', 'Ấ', "'", '"', ")", "(", "ễ", ";", ",", "&", "&quot;", "“", "”", "/", "Á", "À", "Ả", "Ã", "Ạ", "Ó", "Ò", "Ỏ", "Õ", "Ọ", "Ă", "Ắ", "Ằ", "Ẳ", "Ẵ", "Ặ", "Ô", "Ố", "Ồ", "Ổ", "Ỗ", "Ộ", "Â", "Ã", "Á", "À", "Ả", "Ẫ", "Ậ", "Ơ", "Ớ", "Ờ", "Ở", "Ỡ", "Ợ", "É", "È", "Ẻ", "Ẽ", "Ẹ", "Ú", "Ù", "Ủ", "Ũ", "Ụ", "Ê", "Ễ", "Ề", "Ể", "Ệ", "Ư", "Ứ", "Ừ", "Ử", "Ữ", "Ự", "Í", "Ì", "Ỉ", "Ĩ", "Ị", "Ý", "Ỳ", "Ỷ", "Ỹ", "Ỵ", "Đ", "á", "à", "ả", "ã", "ạ", "ó", "ò", "ỏ", "õ", "ọ", "ă", "ắ", "ằ", "ẳ", "ẵ", "ặ", "ô", "ố", "ồ", "ổ", "ỗ", "ộ", "â", "ã", "ấ", "ầ", "ẩ", "ẫ", "ậ", "ơ", "ớ", "ờ", "ở", "ỡ", "ợ", "é", "è", "ẻ", "ê", "ế", "ề", "ệ", "ẽ", "ẹ", "ú", "ù", "ủ", "ũ", "ụ", "ê", "ẽ", "ề", "ể", "ệ", "ư", "ứ", "ừ", "ử", "ữ", "ự", "í", "ì", "ỉ", "ĩ", "ị", "ý", "ỳ", "ỷ", "ỹ", "ỵ", "đ", "!", "@", "?", ".", ":");
        $b = array('', '', '', '', '', '', 'a', '', '', '', '', '', '', '', '', "", "", "e", "", "", "", "", "", "", " ", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "u", "i", "i", "i", "i", "i", "y", "y", "y", "y", "y", "d", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "a", "a", "a", "a", "a", "a", "a", "o", "o", "o", "o", "o", "o", "e", "e", "e", "e", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "e", "e", "e", "e", "e", "u", "u", "u", "u", "u", "u", "i", "i", "i", "i", "i", "y", "y", "y", "y", "y", "d", "", "", "", "", "" . "");
        $string = strtolower(str_replace($a, $b, trim($string)));
        $string = preg_replace('/\s{2}+/', ' ', $string);
        $string = str_replace(" ", "-", $string);
        $string = preg_replace('/\-{2}+/', '-', $string);
        return $string;
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
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = '//layouts/blank';

        $setting = Setting::model()->findByPk(1);
        $this->meta = array(
            'title' => 'Đăng nhập - ' . $setting->meta_title,
            'description' => $setting->meta_description,
            'keywords' => $setting->meta_keywords
        );

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionForgotpassword() {
        $this->layout = '//layouts/blank';

        $setting = Setting::model()->findByPk(1);
        $this->meta = array(
            'title' => 'Lấy lại mật khẩu - ' . $setting->meta_title,
            'description' => $setting->meta_description,
            'keywords' => $setting->meta_keywords
        );

        $member = new Member;
        $member->isForgot = true;

        if (isset($_POST['Member'])) {
            $member->attributes = $_POST['Member'];
            $member->email = $_POST['Member']['email'];

            if ($member->validate()) {

                $message = "<html><head><title>Mail active</title>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                  </head><body>Chào bạn.<br />
                  Thông tin tài khoản của bạn đã được thay đổi:<br />
                  Email: " . $member->email . "<br />
                  Password: " . $this->generateRandomString() . "<br />
                  <br />

                  Chúc bạn có 1 ngày làm việc hiệu quả và may mắn!<br />
                  </body></html>";

                $mail = new PHPMailer();
                $mail->IsSMTP(); // set mailer to use SMTP
                $mail->SMTPDebug = FALSE;
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "tls";
                $mail->Port = "587";
                $mail->Username = 'contact.yt2fb@gmail.com';
                $mail->Password = 'admin@#123';
                $from = "noreply@socool.info";
                $mail->ClearAddresses();

                $to = $member->email; // Recipients email ID
                $name = "socool.info"; // Recipient's name
                //Set who the message is to be sent from
                $mail->setFrom('contact.yt2fb@gmail.com', 'Contact.fbadspro');

                //Set an alternative reply-to address
                $mail->addReplyTo($from, 'Contact.FBADSPRO');

                //Set who the message is to be sent to
                $mail->addAddress($to, $name);
                $mail->WordWrap = 50; // set word wrap
                //$mail->Body = $message;
                $mail->CharSet = 'UTF-8';
                $mail->IsHTML(true); // send as HTML

                $mail->Subject = 'Yêu cầu lấy lại mật khẩu | FBADSPRO';
                $mail->MsgHTML($message);

                if ($mail->Send()) {
                    Yii::app()->user->setFlash('getpass', 'Chúng tôi đã gửi mail cho bạn, vui lòng kiểm tra lại hòm thư!');
                }

                //Yii::app()->user->setFlash('getpass', 'Chúng tôi đã gửi mail cho bạn, vui lòng kiểm tra lại hòm thư!');
            }
        }

        $this->render('forgot', array(
            'member' => $member
        ));
    }

    public function actionSignup() {
        $this->layout = '//layouts/blank';

        $setting = Setting::model()->findByPk(1);
        $this->meta = array(
            'title' => 'Đăng ký thành viên - ' . $setting->meta_title,
            'description' => $setting->meta_description,
            'keywords' => $setting->meta_keywords
        );

        $member = new Member;

        if (isset($_POST['Member'])) {
            $member->attributes = $_POST['Member'];
            $member->password = md5($_POST['Member']['password']);
            $member->email = $_POST['Member']['email'];
            $member->name = $_POST['Member']['name'];
            $member->point = 100;
            $member->vip_start = date('Y-m-d H:i:s', time());
            $member->vip_end = date('Y-m-d H:i:s', time() + 86400);
            $member->vip_start = 1;

            if ($member->save()) {

                $message = "<html><head><title>Mail active</title>
                  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                  </head><body>Chào bạn " . $member->name . ".<br />
                  Bạn đã đăng ký thành công tài khoản tại YT2FB:<br />
                  Email: " . $member->email . "<br />
                  Password: ******<br />
                  <br />

                  Chúc bạn có 1 ngày làm việc hiệu quả và may mắn!<br />
                  </body></html>";

                $mail = new PHPMailer();
                $mail->IsSMTP(); // set mailer to use SMTP
                $mail->SMTPDebug = FALSE;
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "tls";
                $mail->Port = "587";
                $mail->Username = 'contact.yt2fb@gmail.com';
                $mail->Password = 'admin@#123';
                $from = "noreply@socool.info";
                $mail->ClearAddresses();

                $to = $member->email; // Recipients email ID
                $name = "socool.info"; // Recipient's name
                //Set who the message is to be sent from
                $mail->setFrom('contact.yt2fb@gmail.com', 'Contact.yt2fb');

                //Set an alternative reply-to address
                $mail->addReplyTo($from, 'Contact.yt2fb');

                //Set who the message is to be sent to
                $mail->addAddress($to, $name);
                $mail->WordWrap = 50; // set word wrap
                //$mail->Body = $message;
                $mail->CharSet = 'UTF-8';
                $mail->IsHTML(true); // send as HTML

                $mail->Subject = 'Đăng ký tài khoản YT2FB';
                $mail->MsgHTML($message);

                if ($mail->Send()) {
                    Yii::app()->user->setFlash('reg_success', 'Đăng ký thành công!');
                    header('Refresh: 5;url=' . $this->createUrl('site/login'));
                }

                //Yii::app()->user->setFlash('reg_success', 'Đăng ký thành công!');
                //header('Refresh: 5;url=' . $this->createUrl('site/login'));
            }
        }

        $this->render('signup', array(
            'member' => $member
        ));
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}