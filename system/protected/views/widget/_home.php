<div class="box">
    <div class="box-header">
        <h3 class="box-title">Home</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body table-responsive no-padding">
        <table class="table">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="text-align: center;">Widget</th>
                </tr>
                <?php if (isset($home) && $home): ?>
                    <?php $i = 1; ?>
                    <?php foreach ($home as $item): ?>
                        <tr>
                            <td style="vertical-align: middle;"><?php echo $i; ?></td>
                            <td>
                                <div class="panel panel-default" style="margin: 0;">
                                    <div class="panel-heading" role="tab" id="headingOne"> 
                                        <h4 class="panel-title" style="font-size: 14px;"> 
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                                                <?php echo $item->title; ?>
                                            </a> 
                                        </h4> 
                                    </div> 
                                    <div style="height: 0px;" aria-expanded="false" id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"> 
                                        <div class="panel-body">
                                            <?php echo $item->getInfor(); ?>

                                            <br />
                                            <a href="<?php echo Yii::app()->createUrl('widget/update', array('id' => $item->id)); ?>" class="btn bg-orange margin btn-xs" role="button">Update</a>
                                            <a href="<?php echo Yii::app()->createUrl('widget/del', array('id' => $item->id)); ?>" class="btn bg-orange margin btn-xs" role="button">Delete</a>
                                        </div> 
                                    </div> 
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>