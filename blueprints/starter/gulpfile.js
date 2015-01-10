var gulp = require('gulp');
var elixir = require('laravel-elixir');
var concat = require('gulp-concat');

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

var bower = function(path) {
    return 'bower_components/' + path;
};

elixir.extend('scriptOut', function (scripts, dest) {
    gulp.task('scriptOut', function() {
        gulp.src(scripts)
            .pipe(concat(dest))
            .pipe(gulp.dest(elixir.config.jsOutput))
    });

    return this.queueTask('scriptOut');
});

elixir(function(mix) {
    mix.less('admin.less');

    mix.scriptOut([
        bower('jquery/dist/jquery.js'),
        bower('bootstrap/dist/js/bootstrap.js'),
        bower('sb-admin-2/js/plugins/metisMenu/metisMenu.js'),
        bower('sb-admin-2/js/sb-admin-2.js')
    ], 'admin.js');

    mix.scriptOut([
        bower('sb-admin-2/js/plugins/morris/raphael.min.js'),
        bower('sb-admin-2/js/plugins/morris/morris.js'),
        bower('sb-admin-2/js/plugins/morris/morris-data.js'),
    ], 'admin-morris.js');

    mix.publish('font-awesome/css/font-awesome.min.css', 'public/css/font-awesome.min.css')
        .publish('font-awesome/fonts', 'public/fonts');
});
