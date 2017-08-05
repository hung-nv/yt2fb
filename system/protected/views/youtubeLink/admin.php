<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lightbox.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lightbox.css" />
<section class="content-header">
    <h1>
        Managa Youtube Link
        <small>admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void()"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('youtubeLink/admin'); ?>">Youtube Link</a></li>
        <li class="active">All</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Advance Search</h3>                                    
                </div>


                <div class="news-search-form" style="margin-bottom: 20px;">
                    <?php
                    $this->renderPartial('_search', array(
                        'model' => $model,
                    ));
                    ?>
                </div><!-- search-form -->

                <div class="box-body table-responsive">

                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'youtube-grid',
                        'htmlOptions' => array('class' => 'dataTables_wrapper form-inline'),
                        'itemsCssClass' => 'table table-hover dataTable',
                        'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
                        'pager' => array(
                            'header' => '',
                            'class' => 'CLinkPager',
                            'htmlOptions' => array(
                                'class' => 'pagination',
                            ),
                            'selectedPageCssClass' => 'active',
                            'hiddenPageCssClass' => 'disabled',
                            'firstPageCssClass' => 'hidden',
                            'prevPageLabel' => '«',
                            'nextPageLabel' => '»',
                            'lastPageCssClass' => 'hidden'
                        ),
                        'summaryCssClass' => 'summaryPosts',
                        'template' => "{summary}\n{items}\n{pager}",
                        'dataProvider' => $model->search(),
                        //'ajaxUpdate' => true,
                        'columns' => array(
                            'id',
                            array(
                                'name' => 'adsfb',
                                'value' => '$data->getAdsFb()',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    'style' => 'width: 50%;'
                                )
                            ),
                            array(
                                'name' => 'updateAds',
                                'value' => '$data->getupdate()',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    'style' => 'vertical-align: middle;'
                                )
                            ),
                            array(
                                'name' => 'member_id',
                                'value' => '$data->author',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    'style' => 'vertical-align: middle;'
                                )
                            ),
                            array(
                                'name' => 'view',
                                'value' => '$data->view',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    'style' => 'vertical-align: middle;'
                                )
                            ),
                            array(
                                'class' => 'CButtonColumn',
                                'template' => '{delete}',
                                'buttons' => array(
                                    'delete' => array
                                        (
                                        'label' => '',
                                        'url' => 'Yii::app()->createUrl("youtubeLink/del", array("id"=>$data->id))',
                                        'options' => array('class' => 'glyphicon glyphicon-remove', 'title' => 'Delete'),
                                        'imageUrl' => FALSE
                                    ),
                                ),
                            ),
                        ),
                    ));
                    ?>

                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section><!-- /.content -->