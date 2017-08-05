<section class="content-header">
    <h1>
        Manage Pages
        <small>Update</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript: void();"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('news/adminpage'); ?>">Pages</a></li>
        <li class="active">All</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <?php $this->renderPartial('_formpage', array('model' => $model)); ?>
    </div>
</section><!-- /.content -->