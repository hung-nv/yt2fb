<div class="box">
    <div class="box-header">
        <h3 class="box-title">Post</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body table-responsive no-padding">
        <?php if (isset($post) && $post): ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="text-align: center;">Widget</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($post as $item): ?>
                        <tr>
                            <td style="vertical-align: middle;"><?php echo $i; ?></td>
                            <td>
                                <div class="panel panel-default" style="margin: 0;">
                                    <div class="panel-heading" role="tab" id="headingOne"> 
                                        <h4 class="panel-title" style="font-size: 14px;"> 
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePost<?php echo $i; ?>" aria-expanded="false" aria-controls="collapsePost<?php echo $i; ?>">
                                                <?php echo $item->title; ?>
                                            </a> 
                                        </h4> 
                                    </div> 
                                    <div style="height: 0px;" aria-expanded="false" id="collapsePost<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"> 
                                        <div class="panel-body">
                                            <?php echo $item->getInfor(); ?>

                                            <br />
                                            <a href="<?php echo Yii::app()->createUrl('widget/update', array('id' => $item->id)); ?>" class="btn bg-orange margin btn-xs" role="button">Update</a>
                                        </div> 
                                    </div> 
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</div>