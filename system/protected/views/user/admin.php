<section class="content-header">
    <h1>
        Managa User
        <small>admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void()"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('news/admin'); ?>">User</a></li>
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


                <div class="news-search-form" style="margin-bottom: 20px;padding: 0 10px;">
                    <?php
                    $this->renderPartial('_search', array(
                        'model' => $model,
                    ));
                    ?>
                </div><!-- search-form -->

                <div class="box-body table-responsive">

                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'news-grid',
                        'htmlOptions' => array('class' => 'dataTables_wrapper form-inline'),
                        'itemsCssClass' => 'table table-bordered table-hover dataTable',
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
                        //'rowCssClassExpression' => '$data->parent_id == 0 ? "parent" : "child"',
                        'dataProvider' => $model->search(),
                        //'ajaxUpdate' => true,
                        'columns' => array(
                            'id',
                            'username',
                            'module',
                            array(
                                'name' => 'status',
                                'value' => '$data->status=="1"?"Yes":"No"',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    'style' => 'text-align: center;'
                                )
                            ),
                            array(
                                'class' => 'CButtonColumn',
                                'template' => '{edit}{delete}',
                                'buttons' => array(
                                    'edit' => array(
                                        'label' => '',
                                        'options' => array('class' => 'glyphicon glyphicon-edit', 'title' => 'Update', 'style' => 'margin-right: 5px;'),
                                        'imageUrl' => FALSE,
                                        'url' => 'Yii::app()->createUrl("user/update",array("id"=>$data->id))',
                                    ),
                                    'delete' => array(
                                        'label' => '',
                                        'options' => array('class' => 'glyphicon glyphicon-remove', 'title' => 'Delete'),
                                        'imageUrl' => FALSE,
                                        'click' => 'function(){
                                            if(confirm("Do you want to delete?")) {
                                                $.ajax({
                                                    type: "post",
                                                    dataType: "json",
                                                    url: $(this).attr("href"),
                                                    success: function(result) {
                                                         location.reload();
                                                    }
                                                });
                                            }
                                            return false;
                                        }',
                                        'url' => 'Yii::app()->createUrl("user/del", array("id"=>$data->id))',
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