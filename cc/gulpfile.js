var gulp     = require('gulp'),
    cssmin   = require('gulp-cssmin'),
    sass     = require('gulp-sass'),
    uglify   = require('gulp-uglify'),
    watchify = require('gulp-watchify'),
    source   = require('vinyl-source-stream'),
    buffer   = require('vinyl-buffer'),
    sourcemaps = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer');

gulp.task('default', ['watch']);

var isDist = false;
gulp.task('enable-dist-mode', function() { isDist = true; });

gulp.task('watch', ['browserify', 'sass'], function() {
  gulp.watch('scss/**/*.scss', ['sass']);
});

gulp.task('dist', ['enable-dist-mode', 'browserify', 'sass']);

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
      browsers: ['> 1%', 'last 2 versions',  'Firefox ESR']
    }))
    .pipe(sourcemaps.write('../maps'));
    if (isDist) {
      result = result.pipe(cssmin());
    }
    return result.pipe(gulp.dest('./css'));
});

gulp.task('browserify', watchify(function(watchify) {
    var result = gulp.src('src/app.js')
        .pipe(watchify({watch:!isDist}));
    if (isDist) {
      result = result.pipe(buffer()).pipe(uglify());
    }
    return result.pipe(gulp.dest('./js'));
}));

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
