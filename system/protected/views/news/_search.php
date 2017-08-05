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
        ));
?>
<div class="col-md-8">
    <div class="row">
        <div class="col-md-3">
            <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'placeholder' => 'Enter title')); ?>
        </div>

        <div class="col-md-3">
            <?php echo $form->dropDownList($model, 'tag', News::model()->getListCategory(1), array('class' => 'form-control')); ?>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <?php echo $form->textField($model, 'date', array('class' => 'form-control pull-right', 'id' => 'reservation', 'placeholder' => 'Choose Date ranger')); ?>
            </div>
        </div>

        <div class="col-md-3">
            <?php echo $form->dropDownList($model, 'status', array('' => 'Select...', 1 => 'Yes', 2 => 'No'), array('class' => 'form-control')); ?>
        </div>
    </div>
</div>
<div class="row">
    <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-success btn-flat')); ?>
</div>

<?php $this->endWidget(); ?>