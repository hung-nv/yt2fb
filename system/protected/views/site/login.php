<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>ADMIN | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="bg-black">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('data-toggle' => 'validator', 'role' => 'form'),
        ));
        ?>
        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <div class="body bg-gray">
                <div class="form-group">
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => 'User ID', 'required' => 'required')); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required')); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->checkBox($model, 'rememberMe'); ?>Remember me
                </div>
            </div>
            <div class="footer">                                                               
                <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>        

        <?php $this->endWidget(); ?>
    </body>
</html>