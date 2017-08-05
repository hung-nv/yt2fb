/*
 Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see license.txt or http://cksource.com/ckfinder/license
 */

        CKFinder.customConfig = function(config)
{
    // Define changes to default configuration here.
    // For the list of available options, check:
    // http://docs.cksource.com/ckfinder_2.x_api/symbols/CKFinder.config.html

    // Sample configuration options:
    // config.uiColor = '#BDE31E';
    // config.language = 'fr';
    // config.removePlugins = 'basket';
    var domain = 'http://localhost/cmsadmin/js/plugins/';

    config.filebrowserBrowseUrl = domain + 'ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = domain + 'ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = domain + 'ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = domain + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = domain + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = domain + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
