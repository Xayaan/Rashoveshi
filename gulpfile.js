
elixir = require('laravel-elixir');
require('laravel-elixir-livereload');

var paths = {
    'jquery': 'resources/bower_components/jquery/',
    'foundation': 'resources/bower_components/foundation-sites/',
    'motion_ui': 'resources/bower_components/font-ui/',
    'font_awesome': 'resources/bower_components/font-awesome/',
    'resourcesPath' : "resources/"
}

elixir(function(mix) {
    // CSS & JS FOR SITE
    mix.scripts([
        "bower_components/jquery/dist/jquery.js",
        "bower_components/foundation-sites/dist/foundation.min.js",
        "bower_components/motion-ui/dist/motion-ui.js",
        "bower_components/thaanaKeyboard/jquery.thaana.js",
        "assets/js/rashoveshi/jquery.easing.js",
        "assets/js/rashoveshi/royalslider.js",
        "assets/js/rashoveshi/jquery.timeago.js",
        "assets/js/rashoveshi/globals.js",
        "assets/js/rashoveshi/sticky.js"
        ], 'public/js/rashoveshi-01.js',  paths.resourcesPath )
    
    .sass(['rashoveshi-01.scss'],'resources/assets/css/rashoveshi-01.css', {includePaths:  [paths.foundation + 'scss', paths.motion_ui]})

    .styles([
       "royalslider.css",
       "rashoveshi-01.css",
       "custom.css"
       ], 'public/css/rashoveshi-01.css')

    .copy(
      'resources/bower_components/font-awesome/fonts',
      'public/build/fonts'
      )


    /** Stylesheet for Badha */
    .sass(['badha-01.scss'],'resources/assets/css/badha-01.css', {includePaths:  [paths.foundation + 'scss', paths.font_awesome + 'scss']})

    .copy('resources/bower_components/font-awesome/fonts','public/build/fonts')
    .copy('resources/bower_components/semantic-ui/dist/semantic.css','resources/assets/css/semantic.css')
    .copy('resources/bower_components/dropzone/dist/dropzone.css','resources/assets/css/dropzone.css')
    .copy('resources/bower_components/datetimepicker/jquery.datetimepicker.css','resources/assets/css/jquery.datetimepicker.css')
    .copy('resources/bower_components/ckeditor/basic.conf.js', 'public/build/js/ckeditor/basic.conf.js')
    .copy('resources/bower_components/ckeditor/smiley.conf.js', 'public/build/js/ckeditor/smiley.conf.js')
    .copy('resources/bower_components/ckeditor/plugins/smiley', 'public/build/js/ckeditor/plugins/smiley')
    /* .copy('resources/bower_components/medium-editor/dist/css/medium-editor.css','resources/assets/css/medium-editor.css')
    .copy('resources/bower_components/medium-editor/dist/css/themes/default.css','resources/assets/css/medium-default-theme.css')
    .copy('resources/bower_components/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.css','resources/assets/css/medium-editor-insert-plugin.css')*/
    .copy('resources/bower_components/semantic-ui/dist/themes','public/build/css/themes')

    .styles([
        "semantic.css",
        "jquery.datetimepicker.css",
        "medium-editor.css",
        "medium-default-theme.css",
        'medium-editor-insert-plugin.css',
        "badha-01.css",
        ], 'public/css/badha-01.css')

    mix.scripts([
        "bower_components/jquery/dist/jquery.js",
        "bower_components/semantic-ui/dist/semantic.js",
        "bower_components/fastclick/lib/fastclick.js",
        "bower_components/jquery.cookie/jquery.cookie.js",
        "bower_components/jquery-placeholder/jquery.placeholder.js",
        "bower_components/dropzone/dist/dropzone.js",
        "bower_components/datetimepicker/jquery.datetimepicker.js",
        /* "bower_components/medium-editor/dist/js/medium-editor.js",*/
        /** MEDIUM INSERT PLUGIN 
        "bower_components/medium-editor/dist/js/medium-editor.js",
        "bower_components/handlebars/handlebars.runtime.min.js",
        "bower_components/jquery-sortable/source/js/jquery-sortable-min.js",
        "bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js",
        "bower_components/blueimp-file-upload/js/jquery.iframe-transport.js",
        "bower_components/blueimp-file-upload/js/jquery.fileupload.js",
        "bower_components/medium-editor-insert-plugin/dist/js/medium-editor-insert-plugin.js",
        "bower_components/thaanaKeyboard/jquery.thaana.js",
        "bower_components/masonry/dist/masonry.pkgd.min.js",
        END OF MEDIUM INSERT PLUGIN */

        /* "assets/js/badha/medium-jtk.js",*/
        "assets/js/badha/globals.js"
        ], 'public/js/badha-01.js',  paths.resourcesPath )


mix.version([
    "css/badha-01.css",
    "css/rashoveshi-01.css",
    "js/badha-01.js", 
    "js/rashoveshi-01.js"
    ]);


mix.livereload();



});
