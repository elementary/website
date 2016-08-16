/**
 * gulpfile.js
 * Transforms static assets to something usable by the browser
 */

const gulp = require('gulp')

gulp.task('styles', () => {
    gulp.src('_styles/*.css')
        .pipe(gulp.dest('styles'))
})

gulp.task('watch', () => {
    gulp.watch('_styles/*.css', ['styles'])
})

gulp.task('default', ['styles'])
