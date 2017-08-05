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
                    <h1 class="login-heading">Quên mật khẩu</h1>
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'forgot-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>
                    <?php if (Yii::app()->user->hasFlash('getpass')): ?>
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo Yii::app()->user->getFlash('getpass'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php echo $form->errorSummary($member, '', '', array('class' => 'callout callout-danger')); ?>

                    <input type="email" name="Member[email]" placeholder="Email" class="input-txt" required />

                    <div class="login-footer">
                        <a href="<?php echo Yii::app()->createUrl('site/login'); ?>" class="lnk">
                            Đăng nhập
                        </a><br />
                        <a href="<?php echo Yii::app()->createUrl('site/signup'); ?>" class="lnk">Đăng ký</a>
                        <button type="submit" class="btn btn--right">Submit  </button>

                    </div>
                    
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </body>
</html>
