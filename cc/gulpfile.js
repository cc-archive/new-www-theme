var gulp     = require('gulp'),
    $        = require('gulp-load-plugins')(),
    cssmin   = require('gulp-cssmin'),
    sass     = require('gulp-sass'),
    uglify   = require('gulp-uglify'),
    watchify = require('gulp-watchify'),
    source   = require('vinyl-source-stream'),
    buffer   = require('vinyl-buffer'),
    sourcemaps = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    gutil = require('gulp-util');

var sassPaths = [
  './node_modules/breakpoint-sass/stylesheets/'
];
var isDist = false;
gulp.task('enable-dist-mode', function() { isDist = true; });

// gulp.task('watch', ['browserify', 'sass'], function() {
//   gulp.watch('scss/**/*.scss', ['sass']);
// });

gulp.task('sass', function () {
    var result = gulp.src('scss/*.scss')
      .pipe(sourcemaps.init())
      .pipe(
        sass({
          includePaths: [
            './node_modules/breakpoint-sass/stylesheets/'
          ]
        })
        .on('error', sass.logError)
      )
    .pipe(autoprefixer({
      browsers: ['> 1%', 'last 3 versions', 'Firefox ESR', 'iOS >= 8']
    }))
    .pipe(sourcemaps.write('../maps'));
    if (isDist) {
      result = result.pipe(cssmin());
    }
    return result.pipe(gulp.dest('./css'));
});
function sasssrc() {
  return gulp.src('scss/app.scss')
    .pipe($.sass({
      includePaths: sassPaths,
      outputStyle: 'compressed' // if css compressed **file size**
    })
      .on('error', $.sass.logError))
    .pipe(autoprefixer({
      browsers: ['> 1%', 'last 3 versions', 'Firefox ESR', 'iOS >= 8']
    }))
    //.pipe(browserSync.stream());
    .pipe(gulp.dest('./css'));
};
gulp.task('browserify', watchify(function(watchify) {
    var result = gulp.src('src/app.js')
        .pipe(watchify({watch:!isDist}));
    if (isDist) {
      result = result.pipe(buffer()).pipe(uglify());
    }
    return result.pipe(gulp.dest('./js'));
}));
function watch() {
  gulp.watch("scss/*.scss", sasssrc)
}
gulp.task('watch', watch);
gulp.task('sasssrc', sasssrc);
gulp.task('dist', gulp.parallel('enable-dist-mode', 'browserify', 'sass'));
gulp.task('default', gulp.series('watch', watch));
// gulp.task('sass:dev', function () {
//   gulp.src('./scss/*.scss')
//     .pipe(sourcemaps.init())
//     .pipe(
//       sass({
//         includePaths: [
//           './node_modules/breakpoint-sass/stylesheets/'
//         ]
//       })
//       .on('error', sass.logError)
//     )
//     .pipe(autoprefixer({
//       browsers: ['last 2 version']
//     }))
//     .pipe(sourcemaps.write('../maps'))
//     .pipe(gulp.dest('./css'));
// });

// gulp.task('sass:watch', function () {
//   gulp.watch('./scss/**/*.scss', ['sass:dev']);
// });

// gulp.task('default', ['sass:dev', 'sass:watch']);
