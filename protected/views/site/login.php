<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
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
                    <h1 class="login-heading">Welcome to YT2FB</h1>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'login-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    ));
                    ?>
                    <?php echo $form->errorSummary($model, '', '', array('class' => 'callout callout-danger')); ?>
                    
                    <?php echo $form->textField($model,'username', array('class'=>'input-txt', 'placeholder' => 'Email', 'required' => 'required')); ?>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'input-txt', 'placeholder' => 'Mật khẩu', 'required' => 'required')); ?>
                    
                    <div class="login-footer">
                        <a href="<?php echo Yii::app()->createUrl('site/forgotpassword'); ?>" class="lnk">
                            <span class="icon icon--min">ಠ╭╮ಠ</span> 
                            Quên mật khẩu
                        </a><br />
                        <a href="<?php echo Yii::app()->createUrl('site/signup'); ?>" class="lnk">Đăng ký</a>
                        <button type="submit" class="btn btn--right">Sign in  </button>

                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </body>
</html>
