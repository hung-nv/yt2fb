<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'categories-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Create Category</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'placeholder' => 'Enter title')); ?>
            <?php echo $form->error($model, 'title'); ?>
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

        <label>Location</label>
        <div class="checkbox" style="margin-top:0">
            <label class="lbcheck">
                <div class="icheckbox_minimal" style="position: relative;" aria-checked="false" aria-disabled="false">
                    <input checked="checked" type="checkbox" name="Categories[showas]" value="[top]" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                </div> Top
            </label>

            <label class="lbcheck">
                <div class="icheckbox_minimal" style="position: relative;" aria-checked="false" aria-disabled="false">
                    <input type="checkbox" name="Categories[showas]" value="[right]" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                </div> Right
            </label>

            <label class="lbcheck">
                <div class="icheckbox_minimal" style="position: relative;" aria-checked="false" aria-disabled="false">
                    <input type="checkbox" name="Categories[showas]" value="[bottom]" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                </div> Bottom
            </label>

            <label class="lbcheck">
                <div class="icheckbox_minimal" style="position: relative;" aria-checked="false" aria-disabled="false">
                    <input type="checkbox" name="Categories[showas]" value="[left]" style="position: absolute; opacity: 0;">
                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
                </div> Left
            </label>
        </div>


        <div class="form-group"> 
            <div class="radio">
                <label class="">
                    <div class="iradio_minimal" aria-checked="true" aria-disabled="false" style="position: relative;">
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="" style="position: absolute; opacity: 0;">
                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                    </div>
                    Category ?
                </label>
            </div>
            <div class="radio">
                <label class="">
                    <div class="iradio_minimal" aria-checked="false" aria-disabled="false" style="position: relative;">
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" style="position: absolute; opacity: 0;">
                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                    </div>
                    Paging ?
                </label>
            </div>
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