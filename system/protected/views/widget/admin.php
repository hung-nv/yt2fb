<section class="content-header">
    <h1>
        Managa Widget
        <!--<small>Preview</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::app()->homeUrl; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('widget/admin'); ?>">Widget</a></li>
        <li class="active">All</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4">
            <?php
            $this->renderPartial('_home', array('home'=>$home));
            ?>
        </div>
        
        <div class="col-md-4">
            <?php
            $this->renderPartial('_category', array('category'=>$category));
            ?>
        </div>
        
        <div class="col-md-4">
            <?php
            $this->renderPartial('_post', array('post'=>$post));
            ?>
        </div>
    </div>
</section><!-- /.content -->
