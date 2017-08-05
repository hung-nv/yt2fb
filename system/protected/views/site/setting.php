<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<section class="content-header">
    <h1>
        Setting
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void()"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('site/setting'); ?>">Setting</a></li>
        <li class="active">All</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">General</h3>                                    
                </div>

                <div class="box-body">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'user-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions' => array('role' => 'form', 'data-toggle' => 'validator')
                    )); ?>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'meta_title'); ?>
                            <?php echo $form->textField($model, 'meta_title', array('class' => 'form-control', 'required' => 'required')); ?>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'meta_description'); ?>
                            <?php echo $form->textField($model, 'meta_description', array('class' => 'form-control', 'required' => 'required')); ?>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'meta_keywords'); ?>
                            <?php echo $form->textField($model, 'meta_keywords', array('class' => 'form-control')); ?>
                            <div class="help-block with-errors"></div>
                        </div>
                    
                        <div class="space"></div>
                        
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'phone'); ?>
                            <?php echo $form->textField($model, 'phone', array('class' => 'form-control')); ?>
                            <?php echo $form->error($model, 'phone'); ?>
                        </div>
                        
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'skype'); ?>
                            <?php echo $form->textField($model, 'skype', array('class' => 'form-control')); ?>
                            <?php echo $form->error($model, 'skype'); ?>
                        </div>

                        <div class="form-group">
                            <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-success', 'style' => 'margin-top:20px;')); ?>
                        </div>
                    <?php $this->endWidget(); ?>
                </div>
                
            </div>
        </div>
    </div>
</section>