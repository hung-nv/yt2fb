<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'widget-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('role' => 'form', 'data-toggle' => 'validator')
        ));
?>

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <?php echo $form->errorSummary($model, 'Vui lòng sửa các lỗi bên dưới:', '', array('class' => 'callout callout-danger')); ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'title'); ?>
                <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'required' => 'required')); ?>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'categorySelected'); ?>
                <?php echo $form->dropDownList($model, 'categorySelected', $model->getListCategory(), array('class' => 'form-control', 'multiple' => 'multiple', 'required' => 'required')); ?>
                <div class="help-block with-errors"></div>
            </div>

            <label>Tiêu chí</label>
            <div class="form-group">
                <div class="checkbox">
                    <label class="lbcheck">
                        <input name="Widget[order_box][]" value="1" <?php if ($model->order_box == 1): ?> checked="checked" <?php endif; ?> type="radio">
                        Mới nhất
                    </label>

                    <label class="lbcheck">
                        <input name="Widget[order_box][]" value="2" <?php if ($model->order_box == 2): ?> checked="checked" <?php endif; ?> type="radio">
                        Xem nhiều
                    </label>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'limited'); ?>
                <?php echo $form->textField($model, 'limited', array('class' => 'form-control', 'required' => 'required')); ?>
                <div class="help-block with-errors"></div>
            </div>

            <label>Là tin hot?</label>
            <div class="form-group">
                <div class="checkbox">
                    <label class="lbcheck">
                        <input name="Widget[is_hot][]" <?php if ($model->is_hot == 0): ?> checked="checked" <?php endif; ?> value="0" type="radio">
                        Không
                    </label>
                    <label class="lbcheck">
                        <input name="Widget[is_hot][]" <?php if ($model->is_hot == 1): ?> checked="checked" <?php endif; ?> value="1" type="radio">
                        Có
                    </label>
                </div>
            </div>

            <label>Trang hiển thị</label>
            <div class="form-group">
                <div class="checkbox">
                    <label style="width: 33%; float: left;">
                        <input name="Widget[show][]" <?php if ($model->show == 1): ?> checked="checked" <?php endif; ?> value="1" type="radio">
                        Trang chủ
                    </label>
                    <label style="width: 33%; float: left;">
                        <input name="Widget[show][]" <?php if ($model->show == 2): ?> checked="checked" <?php endif; ?> value="2" type="radio">
                        Trang danh mục
                    </label>
                    <label style="width: 33%; float: left;">
                        <input name="Widget[show][]" <?php if ($model->show == 3): ?> checked="checked" <?php endif; ?> value="3" type="radio">
                        Trang chi tiết
                    </label>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'css'); ?>
                <?php echo $form->dropDownList($model, 'css', array(1 => 'Kiểu 1', 2 => 'Kiểu 2', 3 => 'Kiểu 3'), array('class' => 'form-control', 'required' => 'required')); ?>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'order_by'); ?>
                <?php echo $form->textField($model, 'order_by', array('class' => 'form-control', 'required' => 'required')); ?>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo $form->dropDownList($model, 'status', array(1 => 'Yes', 0 => 'No'), array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'status'); ?>
            </div>

            <div class="form-group">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Tạo mới' : 'Cập nhật', array('class' => 'btn btn-success', 'style' => 'margin-top:20px;')); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>