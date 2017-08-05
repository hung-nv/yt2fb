<section class="content-header">
    <h1>
        Managa Member
        <small>admin</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void()"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('member/admin'); ?>">Member</a></li>
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
                        'id' => 'member-grid',
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
                        //'rowCssClassExpression' => '$data->parent_id == 0 ? "parent" : "child"',
                        'dataProvider' => $model->search(),
                        //'ajaxUpdate' => true,
                        'columns' => array(
                            array(
                                'name' => 'id',
                                'value' => '$data->id',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    'style' => 'text-align: center;vertical-align: middle;'
                                )
                            ),
                            array(
                                'name' => 'inforMember',
                                'value' => '$data->getInforMember()',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    //'style' => 'width:41.6667%'
                                )
                            ),
                            array(
                                'name' => 'action',
                                'value' => '$data->getaction()',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    'style' => 'text-align: center;vertical-align: middle;'
                                )
                            ),
                            
//                            array(
//                                'class' => 'CButtonColumn',
//                                'htmlOptions' => array('style' => 'vertical-align: middle; text-align: center;'),
//                                'template' => '{delete}',
//                                'buttons' => array
//                                    (
//                                    'delete' => array
//                                        (
//                                        'label' => '',
//                                        'url' => 'Yii::app()->createUrl("member/del", array("id"=>$data->id))',
//                                        'options' => array('class' => 'glyphicon glyphicon-remove', 'title' => 'Delete'),
//                                        'imageUrl' => FALSE
//                                    ),
//                                ),
//                            ),
                        ),
                    ));
                    ?>

                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section><!-- /.content -->