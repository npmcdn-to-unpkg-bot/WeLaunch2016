var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var livereload = require('gulp-livereload');
var fs = require('node-fs');
var fse = require('fs-extra');
var json = require('json-file');
var styleguide = require('devbridge-styleguide');
var themeName = json.read('./package.json').get('themeName');
var themeDir = '../' + themeName;

input  = {
  'sass': 'assets/scss/**/**/*.scss',
  'javascript': 'assets/js/**/*.js',
  'imagess':'assets/images/*.{png,jpg,gif}'
},

output = {
  'sass': '.',
  'javascript': './js',
  'imagess':'./images'
};


// Compile Our Sass
gulp.task('sass', function() {
  return gulp.src(input.sass)
    .pipe(sass())
    .pipe(autoprefixer({
  			browsers: ['last 2 versions'],
  			cascade: false
  		}))
    .pipe(gulp.dest(output.sass))
    .pipe(livereload());

});

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src(input.javascript)
        .pipe(concat('custom.js'))
        .pipe(gulp.dest(output.javascript))
        .pipe(rename('custom.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(output.javascript))
        .pipe(livereload());
});

gulp.task('img', function() {
  return gulp.src(input.imagess)
    .pipe(imagemin({
      optimizationLevel: 7,
      progressive: true
    }))
    .pipe(gulp.dest(output.imagess))
    .pipe(livereload());
});


gulp.task('watch', function() {
    livereload.listen();
    gulp.watch(input.javascript, ['scripts']);
    gulp.watch(input.sass, ['sass']);
    gulp.watch('images/*.{png,jpg,gif}', ['img']);

    gulp.watch( './**/*.php' ).on( 'change', function( file ) {
      // reload browser whenever any PHP file changes
      livereload.changed( file );
    } );
});


// Default Task
gulp.task('default', ['sass', 'scripts', 'img', 'watch']);
