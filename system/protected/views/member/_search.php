<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'enableAjaxValidation' => true,
    'htmlOptions' => array('role' => 'form', 'data-toggle' => 'validator')
        ));
?>
<div class="col-md-8">
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Enter Email')); ?>
        </div>

        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <?php echo $form->textField($model, 'date', array('class' => 'form-control pull-right', 'id' => 'reservation', 'placeholder' => 'Vip Register Ranger')); ?>
            </div>
        </div>

        <div class="col-md-4">
            <?php echo $form->dropDownList($model, 'status', array('' => 'Vip?', 1 => 'Yes', 2 => 'No'), array('class' => 'form-control')); ?>
        </div>
    </div>
</div>
<div class="row">
    <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-success btn-flat')); ?>
</div>

<?php $this->endWidget(); ?>