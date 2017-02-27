var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass(['app.scss'])
        .styles([
            '../../../bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css',
            '../../../bower_components/AdminLTE/dist/css/AdminLTE.css',
            '../../../bower_components/AdminLTE/dist/css/skins/skin-green.css',
            '../../../bower_components/AdminLTE/plugins/select2/select2.min.css',
            '../../../bower_components/AdminLTE/plugins/iCheck/square/blue.css',
            '../../../node_modules/prismjs/themes/prism.css',
            '../../../bower_components/AdminLTE/plugins/datepicker/datepicker3.css',
            '../../../bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css',
            '../../../bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css',
        ]);


    mix.scripts([
        '../../../bower_components/jquery/dist/jquery.min.js',
        '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js',
        '../../../bower_components/AdminLTE/plugins/select2/select2.full.min.js',
        '../../../bower_components/AdminLTE/plugins/datatables/jquery.dataTables.js',
        '../../../bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.js',
        '../../../bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js',
        '../../../bower_components/AdminLTE/plugins/fastclick/fastclick.js',
        '../../../bower_components/AdminLTE/plugins/iCheck/iCheck.js',
        '../../../node_modules/prismjs/prism.js',
        '../../../bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js',
        '../../../bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.js',
        '../../../bower_components/AdminLTE/dist/js/app.js',
        '../../../bower_components/bootstrap-switch/dist/js/bootstrap-switch.js',
        //'../../../bower_components/AdminLTE/dist/js/pages/dashboard2.js',
    ]);

    // mix.browserify('admin.js');

    mix.copy('bower_components/AdminLTE/plugins/iCheck/square/blue.png', 'public/build/css/blue.png');
    mix.copy('bower_components/AdminLTE/plugins/iCheck/square/blue@2x.png', 'public/build/css/blue@2x.png');
    mix.copy('/Users/JesusO/Sites/logcentral/bower_components/bootstrap/fonts', 'public/build/fonts/bootstrap/');


  // Versioning
    mix.version(['public/css/app.css', 'public/css/all.css', 'public/js/all.js']);
});
