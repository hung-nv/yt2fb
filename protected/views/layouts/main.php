<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" media="screen, projection" />

        <title><?php echo $this->meta['title']; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fbadspro.js"></script>
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


        <?php echo $content; ?>

        <footer>
            <div class="container">
                <div class="inner">
                    <ul class="menu">
                        <?php if (!Yii::app()->user->isGuest): ?>
                            <li><a href="<?php echo Yii::app()->createUrl('site/login'); ?>">Chức năng VIP</a></li>
                            <li><a href="/copyright">Liên hệ</a></li>
                            <li><a href="/copyright">Điều khoản</a></li>
                        <?php else: ?>
                            <li><a href="<?php echo Yii::app()->createUrl('site/signup'); ?>">Đăng ký</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('site/login'); ?>">Đăng nhập</a></li>
                            <li><a href="/copyright">Điều khoản</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </footer>
    </body>
</html>