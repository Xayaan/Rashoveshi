// CKEditor smiley config
CKEDITOR.editorConfig = function( config ) {
	config.toolbar = [
		{ name: 'insert', items: [ 'Smiley' ] },
	];
	config.removePlugins = 'elementspath';
    config.resize_enabled = false;
    config.toolbarLocation = 'bottom';
};
