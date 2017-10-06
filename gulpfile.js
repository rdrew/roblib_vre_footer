
var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
//var breakpoint = require('breakpoint-sass');

gulp.task('browser-sync', function() {

var findCss     = new RegExp("<link.*" + "upei_vre_footer" + "*\/css\/upei_vre_footer.*", "g");
//var findJs      = new RegExp("<script.*" + THEMENAME + "*\/dist\/assets\/js\/app.*", "g");
var PROXY       = 'https://biomedical-optics.discoveryspace.ca/';
// root assets dir (contains /css/ and /js/ etc)
var assetsDir   = '.';
// path to file within assets dir
var fileReplace = '/css/upei_vre_footer.css';
var replaceCss = '<link rel="stylesheet" type="text/css" href="' + fileReplace + '"/>';
//===========================

  browserSync({
    proxy: PROXY,
    serveStatic: [assetsDir],
    files: fileReplace,
    rewriteRules: [
        {
            match: findCss,
            fn: function (req, res, match) {
                return replaceCss;
            }
        }
    ]
  });
});



gulp.task('styles', function(){
  gulp.src(['src/sass/**/*.scss'])
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit('end');
    }}))
        .pipe(sass({
            //includePaths: require('breakpoint-sass').includePaths
        }))
    .pipe(autoprefixer('last 2 versions'))
    .pipe(gulp.dest('css/'))
});

gulp.task('bs', ['browser-sync'], function(){
  gulp.watch("src/sass/**/*.scss", ['styles']);
});

gulp.task('default', function(){
  gulp.watch("src/sass/**/*.scss", ['styles']);
});

