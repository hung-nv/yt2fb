<?php if (isset($member) && $member): ?>
    <div class="col-sm-12 col-xs-12">
        <ul class="top-user text-right">
            <li class="dropdown user user-menu">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
                    <img alt="User Image" class="user-image" src="<?php echo Yii::app()->request->baseUrl; ?>/images/user2-160x160.jpg" />
                    <span><?php echo $member->name; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img alt="User Image" class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/images/user2-160x160.jpg" />
                        <p>
                            <?php echo $member->email; ?><br />
                            <?php if ($member->vip_status == 1): ?>
                                <small>VIP đến <?php echo date('d-m-Y H:i:s', strtotime($member->vip_end)); ?> - <span style="font-weight: bold;"><?php echo $member->point; ?></span> point</small>
                            <?php else: ?>
                                <small>Lên VIP để sử dụng đầy đủ tính năng</small>
                            <?php endif; ?>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="col-xs-4 text-center">
                            <a href="#">Profile</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="#">Lên VIP</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Thoát</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
<?php endif; ?>