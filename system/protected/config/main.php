<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'CMS FBADSPRO',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'class' => 'UWebUser'
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=fbadspro_admin',
            'emulatePrepare' => true,
            'username' => 'fbadspro_admin',
            'password' => '@123456',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'module' => array(
            'setting' => array(
                'name' => 'Setting',
                'url' => array('/setting/admin')
            ),
            'member' => array(
                'name' => 'Member',
                'url' => array('/member/admin')
            ),
            'youtubeLink' => array(
                'name' => 'Youtube Link',
                'url' => array('/youtubeLink/admin')
            ),
            'categories' => array(
                'name' => 'Danh mục',
                'url' => array('/categories/admin')
            ),
            'news' => array(
                'name' => 'Bài viết',
                'url' => array('/news/admin')
            ),
            'pages' => array(
                'name' => 'Trang',
                'url' => array('/pages/admin')
            ),
            'user' => array(
                'name' => 'User',
                'url' => array('/user/admin')
            ),
//            'widget' => array(
//                'name' => 'Widget',
//                'url' => array('/widget/admin')
//            )
        )
    ),
);
