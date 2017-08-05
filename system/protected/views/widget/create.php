<section class="content-header">
    <h1>
        Manage Widget
        <small>Create</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript: void();"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('widget/admin'); ?>">Widget</a></li>
        <li class="active">Create</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</section><!-- /.content -->