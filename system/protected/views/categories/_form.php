<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'categories-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('role' => 'form', 'data-toggle' => 'validator')
        ));
?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Create Category</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">

        <?php if (Yii::app()->user->hasFlash('categories')): ?>
            <div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo Yii::app()->user->getFlash('categories'); ?>
            </div>
        <?php endif; ?>

        <input type="hidden" value="" id="set_id" name="Categories[id]" />
        <div class="form-group">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'placeholder' => 'Enter title', 'required' => 'required', 'data-error' => '"Tên" không được để trống')); ?>
            <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'alias'); ?>
            <?php echo $form->textField($model, 'alias', array('class' => 'form-control', 'placeholder' => 'Enter alias')); ?>
            <?php echo $form->error($model, 'alias'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'parent_id'); ?>
            <?php echo $form->dropDownList($model, 'parent_id', $model->getListCategory(), array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'parent_id'); ?>
        </div>

        <label>Vị trí</label>
        <div class="form-group">
            <div class="checkbox">
                <label class="lbcheck">
                    <input checked="checked" id="check1" type="checkbox" name="Categories[groupsSelected][]" value="[top]">
                    Top
                </label>
                <label class="lbcheck">
                    <input type="checkbox" id="check2" name="Categories[groupsSelected][]" value="[right]">
                    Right
                </label>
                <label class="lbcheck">
                    <input type="checkbox" id="check3" name="Categories[groupsSelected][]" value="[bottom]">
                    Bottom
                </label>
                <label class="lbcheck">
                    <input type="checkbox" id="check4" name="Categories[groupsSelected][]" value="[left]">
                    Left
                </label>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'showas'); ?>
            <?php echo $form->dropDownList($model, 'showas', array('news' => 'Danh mục?', 'page' => 'Trang?'), array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'showas'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', array('' => 'Select...', 1 => 'Yes', 0 => 'No'), array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>
    </div><!-- /.box-body -->

</div>

<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">Meta Tag</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body" style="display: block;">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'meta_title'); ?>
            <?php echo $form->textField($model, 'meta_title', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'meta_title'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'meta_description'); ?>
            <?php echo $form->textField($model, 'meta_description', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'meta_description'); ?>
        </div>
    </div>
</div>

<div class="box-footer">
    <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary')); ?>
</div>
<?php $this->endWidget(); ?>