/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        config.filebrowserBrowseUrl = 'https://bangoiluoi.com/public/admin/plugins/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'https://bangoiluoi.com/public/admin/plugins/ckfinder/ckfinder.html?type=Images';
	 
	config.filebrowserFlashBrowseUrl = 'https://bangoiluoi.com/public/admin/plugins/ckfinder/ckfinder.html?type=Flash';
	 
	config.filebrowserUploadUrl = 'https://bangoiluoi.com/public/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	 
	config.filebrowserImageUploadUrl = 'https://bangoiluoi.com/public/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	 
	config.filebrowserFlashUploadUrl = 'https://bangoiluoi.com/public/admin/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};
