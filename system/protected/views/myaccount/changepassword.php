<section class="content-header">
    <h1>
        User
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void()"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('site/setting'); ?>">User</a></li>
        <li class="active">All</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Change Password</h3>                                    
                </div>

                <div class="box-body">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'account-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions' => array('data-toggle' => 'validator')
                    )); ?>
                    
                        <?php echo $form->errorSummary($model, 'Vui lòng sửa các lỗi bên dưới:', '', array('class' => 'alert alert-warning alert-dismissable')); ?>
                    
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'oldPassword'); ?>
                            <?php echo $form->passwordField($model, 'oldPassword', array('class' => 'form-control', 'required' => 'required')); ?>
                            <?php echo $form->error($model, 'oldPassword', array('class' => 'text-error')); ?>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'password'); ?>
                            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'id' => 'inputPass', 'required' => 'required')); ?>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'rePassword'); ?>
                            <?php echo $form->passwordField($model, 'rePassword', array('class' => 'form-control', 'data-match' => '#inputPass', 'data-match-error' => 'Mật khẩu không khớp.')); ?>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <?php echo CHtml::submitButton('Update', array('class' => 'btn btn-success', 'style' => 'margin-top:20px;')); ?>
                        </div>
                            
                    <?php $this->endWidget(); ?>
                </div>
                
            </div>
        </div>
    </div>
</section>