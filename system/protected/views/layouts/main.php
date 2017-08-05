<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
    </head>

    <body class="skin-blue">
        <header class="header">
            <a class="logo" href="<?php echo Yii::app()->homeUrl; ?>">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Admin
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav role="navigation" class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a role="button" data-toggle="offcanvas" class="navbar-btn sidebar-toggle" href="#">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo Yii::app()->user->account->fullname; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img alt="User Image" class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/user.jpg" />
                                    <p>
                                        <?php echo Yii::app()->user->account->fullname; ?>
                                        <small>Member since Nov. 2015</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a class="btn btn-default btn-flat" href="<?php echo Yii::app()->createUrl('myaccount/changepassword'); ?>">Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" href="<?php echo Yii::app()->createUrl('site/logout'); ?>">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 919px;">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas" style="min-height: 1633px;">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img alt="User Image" class="img-circle" src="<?php echo Yii::app()->request->baseUrl; ?>/img/user.jpg" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo Yii::app()->user->account->fullname; ?></p>

                            <a href="javascript: void();"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="javascript: void();">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <?php if (strlen(strstr(Yii::app()->user->account->module, 'categories')) > 0): ?>
                            <li class="treeview <?php if ($this->categories): ?>active<?php endif; ?>">
                                <a href="javascript: void();">
                                    <i class="fa fa-bars"></i>
                                    <span>Categories</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li <?php if ($this->categories): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('categories/admin'); ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>All Category</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="treeview <?php if ($this->post || $this->tags): ?>active<?php endif; ?>" style="display: block;">
                            <a href="javascript: void();">
                                <i class="fa fa-edit"></i>
                                <span>Post</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'news/admin')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('news/admin'); ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> All Posts</a></li>
                                <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'news/create')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('news/create'); ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Create Posts</a></li>
                                <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'tag/admin')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('tag/admin'); ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> All Tags</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php if ($this->pages): ?>active<?php endif; ?>" style="display: block;">
                            <a href="javascript: void();">
                                <i class="fa fa-book"></i>
                                <span>Pages</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'news/adminpage')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('news/adminpage'); ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> All Pages</a></li>
                                <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'news/createpage')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('news/createpage'); ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Create Pages</a></li>
                            </ul>
                        </li>
                        <?php if (strlen(strstr(Yii::app()->user->account->module, 'member')) > 0): ?>
                            <li class="<?php if ($this->member): ?>active<?php endif; ?>">
                                <a href="<?php echo Yii::app()->createUrl('member/admin'); ?>">
                                    <i class="fa fa-users"></i> <span>Member</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if (strlen(strstr(Yii::app()->user->account->module, 'youtubeLink')) > 0): ?>
                            <li class="<?php if ($this->youtube): ?>active<?php endif; ?>">
                                <a href="<?php echo Yii::app()->createUrl('youtubeLink/admin'); ?>">
                                    <i class="fa fa-video-camera"></i> <span>Youtube Link</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if (strlen(strstr(Yii::app()->user->account->module, 'user')) > 0): ?>
                            <li class="treeview <?php if ($this->user): ?>active<?php endif; ?>">
                                <a href="javascript: void();">
                                    <i class="fa fa-user"></i> <span>User</span>
                                    <i class="fa pull-right fa-angle-down"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'user/admin')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('user/admin'); ?>"" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> All User</a></li>
                                    <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'user/create')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('user/create'); ?>"" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Add User</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <?php if (strlen(strstr(Yii::app()->user->account->module, 'widget')) > 0): ?>
                            <li class="treeview <?php if ($this->widget): ?>active<?php endif; ?>">
                                <a href="javascript: void();">
                                    <i class="fa fa-th"></i> <span>Widget</span>
                                    <i class="fa pull-right fa-angle-down"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'widget/admin')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('widget/admin'); ?>"" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> All Widget</a></li>
                                    <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'widget/create')) > 0): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->createUrl('widget/create'); ?>"" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Add Widget</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                        <?php if (strlen(strstr(Yii::app()->user->account->module, 'setting')) > 0): ?>
                            <li <?php if (strlen(strstr(Yii::app()->urlManager->parseUrl(Yii::app()->request), 'site/setting')) > 0): ?>class="active"<?php endif; ?>>
                                <a href="<?php echo Yii::app()->createUrl('site/setting'); ?>">
                                    <i class="fa fa-cog"></i> <span>Setting</span>
                                    <small class="badge pull-right bg-red">3</small>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <?php echo $content; ?>
            </aside><!-- /.right-side -->
        </div>

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/AdminLTE/app.js" type="text/javascript"></script>

        <?php if ($this->isEditor): ?>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <?php endif; ?>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/validator.js"></script>

        <!-- Page script -->
        <?php if ($this->isEditor): ?>
            <script type="text/javascript">
                $(function() {
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('editor1', {
                        filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?Type=Images',
                        filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?Type=Flash',
                        filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                    });
                });
            </script>
        <?php endif; ?>
        <script type="text/javascript">
            $(function() {
                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});

                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
    </body>
</html>