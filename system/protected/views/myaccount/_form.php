<?php
/* @var $this AccountController */
/* @var $model Account */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'account-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'oldPassword'); ?>
        <?php echo $form->passwordField($model, 'oldPassword', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'oldPassword'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'rePassword'); ?>
        <?php echo $form->passwordField($model, 'rePassword', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'rePassword'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Change'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->