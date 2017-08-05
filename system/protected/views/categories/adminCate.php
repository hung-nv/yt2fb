<section class="content-header">
    <h1>
        Managa Categories
        <!--<small>Preview</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::app()->homeUrl; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('categories/admin'); ?>">Categories</a></li>
        <li class="active">All</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-5">
            <?php
            $this->renderPartial('_form', array(
                'model' => $model
            ))
            ?>
        </div>

        <div class="col-md-7">
            <div class="box">
                <div class="search-form col-xs-6">
                    <?php
                    $this->renderPartial('_search', array(
                        'modelSearch' => $modelSearch,
                    ));
                    ?>
                </div><!-- search-form -->

                <div class="box-body table-responsive">
                    <?php
                    $csrf = '';
                    if (Yii::app()->request->enableCsrfValidation) {
                        $csrf = "\n\t\tdata:{ '" . Yii::app()->request->csrfTokenName . "':'" . Yii::app()->request->csrfToken . "' },";
                    }
                    ?>

                    <?php
                    $this->widget('zii.widgets.grid.CGridView', array(
                        'id' => 'categories-grid',
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
                        'rowCssClassExpression' => '$data->parent_id == 0 ? "parent" : "child"',
                        'dataProvider' => $modelSearch->search(),
                        //'ajaxUpdate' => true,
                        'afterAjaxUpdate' => 'function(id,data){$("select").selectmenu()}',
                        'columns' => array(
                            'id',
                            array(
                                'name' => 'title',
                                'value' => '$data->getTitle()',
                                'type' => 'raw',
                                'htmlOptions' => array(
                                    'class' => 'child-active'
                                )
                            ),
                            //'parent_id',
                            array(
                                'name' => 'parent_id',
                                'value' => '$data->getParent()'
                            ),
//                            array(
//                                'name' => 'status',
//                                'value' => '$data->status=="1"?"Yes":"No"',
//                                'type' => 'raw',
//                                'htmlOptions' => array(
//                                    'style' => 'text-align: center;'
//                                )
//                            ),
                            array(
                                'class' => 'CButtonColumn',
                                'template' => '{edit}{delete}',
                                'htmlOptions' => array('style' => 'width:15%;'),
                                'buttons' => array
                                    (
                                    'edit' => array
                                        (
                                        'label' => '',
                                        'options' => array('class' => 'glyphicon glyphicon-edit', 'title' => 'Update', 'style' => 'margin-right: 5px;'),
                                        'imageUrl' => FALSE,
                                        'click' => 'function(){
                                            $.ajax({
                                                type: "post",
                                                dataType: "json",
                                                url: $(this).attr("href"),
                                                success: function(data) {
                                                    //console.log(data["title"]);
                                                    $("#Categories_title").val(data["title"]);
                                                    $("#Categories_alias").val(data["alias"]);
                                                    $("#Categories_parent_id").val(data["parent_id"]);
                                                    $("#Categories_status").val(data["status"]);
                                                    $("#Categories_meta_description").val(data["meta_description"]);
                                                    $("#Categories_meta_title").val(data["meta_title"]);
                                                    $("#Categories_showas").val(data["showas"]);
                                                    $("#set_id").val(data["id"]);
                                                    
                                                    var str = data["groups"];
                                                    console.log(str);
                                                    if(str.indexOf("[top]") != -1)
                                                        $("#check1").prop("checked", true);
                                                    else
                                                        $("#check1").prop("checked", false);
                                                    
                                                    if(str.indexOf("[right]") != -1)
                                                        $("#check2").prop("checked", true);
                                                    else
                                                        $("#check2").prop("checked", false);
                                                        
                                                    if(str.indexOf("[bottom]") != -1)
                                                        $("#check3").prop("checked", true);
                                                    else
                                                        $("#check3").prop("checked", false);
                                                        
                                                    if(str.indexOf("[left]") != -1)
                                                        $("#check4").prop("checked", true);
                                                    else
                                                        $("#check4").prop("checked", false);
                                                }
                                            });
                                            return false;
                                          }
                                        ',
                                        'url' => 'Yii::app()->createUrl("categories/getinfor",array("id"=>$data->id))',
                                    ),
                                    'delete' => array
                                        (
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
                                        'url' => 'Yii::app()->createUrl("categories/del", array("id"=>$data->id))',
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
<script>
</script>