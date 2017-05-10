var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var jshint = require('gulp-jshint');
var destination = './dist';
var source = './angular/js';
var jsLocation = [
    source + '/*.js',
    source + '/controllers/*.js',
    source + '/directives/*.js',
    source + '/services/*.js',
];

gulp.task('css', function () {
    return gulp.src(source + '/assets/css/styles.less')
        .pipe(plugins.less())
        .pipe(plugins.csscomb())
        .pipe(plugins.cssbeautify({indent: '  '}))
        // .pipe(plugins.autoprefixer())
        .pipe(gulp.dest(destination + '/assets/css/'));
});


gulp.task('minify', function () {
    return gulp.src(destination + '/assets/css/*.css')
        .pipe(plugins.csso())
        .pipe(plugins.rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(destination + '/assets/css/'));
});


gulp.task('js-dev', function () {
    return gulp.src(jsLocation)
        .pipe(concat('global.min.js'))
        .pipe(gulp.dest(destination + '/assets/js/'));
});

gulp.task('js-prod', function () {
    return gulp.src(jsLocation)
        // .pipe(uglify())
        .pipe(concat('global.min.js'))
        .pipe(gulp.dest(destination + '/assets/js/'));
});


gulp.task('jshint', function () {
    gulp.src(jsLocation)
        .pipe(jshint({
            devel: true,
            globalstrict: true
        }))
        .pipe(jshint.reporter('default'));
});

gulp.task('build', ['css']);


gulp.task('dev', ['js-dev']);

gulp.task('prod', ['js-prod']);

gulp.task('watch', function () {
    gulp.watch(jsLocation, ['js-dev']);
});


gulp.task('default', ['build']);