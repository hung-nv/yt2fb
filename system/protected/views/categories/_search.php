<?php

/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>

<?php

$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>

<?php echo CHtml::submitButton('Search', array('class' => 'btn btn-success btn-flat', 'style' => 'float: right; margin-left: 10px;')); ?>

<?php echo $form->textField($modelSearch,'search',array('class'=>'form-control', 'style' => 'width: auto; float: right;')); ?>

<?php $this->endWidget(); ?>