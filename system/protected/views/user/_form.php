<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('role' => 'form', 'data-toggle' => 'validator')
)); ?>

<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo $form->errorSummary($model, 'Vui lòng sửa các lỗi bên dưới:', '', array('class' => 'callout callout-danger')); ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'username'); ?>
                <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'required' => 'required')); ?>
                <div class="help-block with-errors"></div>
            </div>

            <?php if($model->isNewRecord): ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'password'); ?>
                <?php echo $form->textField($model, 'password', array('class' => 'form-control', 'required' => 'required')); ?>
                <div class="help-block with-errors"></div>
            </div>
            <?php endif; ?>
            
            <div class="form-group">
                <?php echo $form->labelEx($model, 'fullname'); ?>
                <?php echo $form->textField($model, 'fullname', array('class' => 'form-control', 'required' => 'required')); ?>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'module'); ?>
                <?php echo $form->checkBoxList($model, 'moduleSelected', $model->getListModule(), array('template' => '<li>{input}{label}</li>', 'container' => 'ul class="module-list"', 'separator' => '')); ?>
                <?php echo $form->error($model, 'module'); ?>
            </div>
            
            <div class="clearfix"></div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo $form->dropDownList($model, 'status', array(1 => 'Yes', 0 => 'No'), array('class' => 'form-control', 'style' => 'width: 30%;')); ?>
                <?php echo $form->error($model, 'status'); ?>
            </div>
            
            <div class="form-group">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', array('class' => 'btn btn-success', 'style' => 'margin-top:20px;')); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>