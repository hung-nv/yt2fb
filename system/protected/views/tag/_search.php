<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<div class="col-md-3">
    <div class="row">
        <div class="col-md-12">
            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'placeholder' => 'Enter name')); ?>
        </div>
    </div>
</div>
<div class="row">
    <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-success btn-flat')); ?>
</div>

<?php $this->endWidget(); ?>