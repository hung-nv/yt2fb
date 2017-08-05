<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $this->meta['title']; ?></title>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <?php
        $cs = Yii::app()->clientScript;
        $themePath = Yii::app()->request->baseUrl . '/themes';

        /**
         * StyleSHeets
         */
        $cs->registerCssFile($themePath . '/assets/css/bootstrap.css');
        $cs->registerCssFile($themePath . '/assets/css/bootstrap-theme.css');

        /**
         * JavaScripts
         */
        $cs->registerCoreScript('jquery', CClientScript::POS_END);
        $cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/assets/js/bootstrap.min.js', CClientScript::POS_END);
        $cs->registerScript('tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY);
        ?>

        <div class="container">
            <div class="row">
                <div class="login col-sm-4 col-sm-offset-4 col-xs-12">
                    <h1 class="login-heading">Đăng ký miễn phí</h1>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'signup-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>
                    <?php if (Yii::app()->user->hasFlash('reg_success')): ?>
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo Yii::app()->user->getFlash('reg_success'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php echo $form->errorSummary($member, '', '', array('class' => 'callout callout-danger')); ?>

                    <input type="text" name="Member[name]" placeholder="Họ tên" class="input-txt" required />
                    <input type="email" name="Member[email]" placeholder="Email" class="input-txt" required />
                    <input type="password" name="Member[password]" placeholder="Mật khẩu" class="input-txt" id="password" required />
                    <input type="password" name="Member[rePassword]" placeholder="Xác nhận mật khẩu" class="input-txt" id="confirm_password" required />

                    <div class="form-group" style="margin-top: 20px;">
                        <div class="checkbox">
                            <label style="line-height: 20px; font-size: 14px; color: #fff;">
                                <input type="checkbox" required>Tôi đồng ý với điều khoản của trang
                            </label>
                        </div>
                    </div>
                    <div class="login-footer">
                        <button type="submit" class="btn btn--right">Đăng ký  </button>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script>
            var password = document.getElementById("password")
                    , confirm_password = document.getElementById("confirm_password");

            function validatePassword() {
                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Xác nhận không chính xác!");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>
    </body>
</html>
