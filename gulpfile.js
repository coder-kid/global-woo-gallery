const gulp         = require('gulp');
const rename       = require('gulp-rename');
const sass         = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps   = require('gulp-sourcemaps');
const uglify       = require('gulp-uglify');

const files = {
    css_src    : 'admin/assets/sass/gwpg.sass',
    css_dest   : './admin/assets/css',
    style_watch: 'admin/assets/sass/**/*.sass',
    js_src     : 'admin/assets/js/gwpg.js',
    js_dest    : './admin/assets/js',
    js_watch   : 'admin/assets/js/*.js'
};

gulp.task('style', function() {
    gulp.src( files.css_src )
    .pipe( sourcemaps.init() )
    .pipe( sass({
        errLogToConsole: true,
        outputStyle: 'compressed'
    }) )
    .on('error', console.error.bind(console))
    .pipe( autoprefixer( {
        browsers: ['last 10 versions'],
        cascade: false
    } ) )
    .pipe( rename( {suffix: '.min'}) )
    .pipe( sourcemaps.write( './' ) )
    .pipe( gulp.dest(files.css_dest) )
});

gulp.task('js', function() {
    gulp.src( files.js_src )
    .pipe( rename( {suffix: '.min'} ) )
    .pipe( uglify() )
    .pipe( gulp.dest( files.js_dest ) )
});

gulp.task('default', ['style', 'js']);

gulp.task('watch', ['default'], function() {
    gulp.watch(files.style_watch, ['style']);
    gulp.watch(files.js_watch, ['js']);
});