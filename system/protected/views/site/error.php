<section class="content-header">
    <h1>
        404 Error Page
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::app()->homeUrl; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">404 error</li>
    </ol>
</section>

<section class="content">
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
            <p>
                <?php echo CHtml::encode($message); ?>
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
</section>