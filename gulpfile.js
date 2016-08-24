/**
 * gulpfile.js
 * Transforms static assets to something usable by the browser
 */

const gulp = require('gulp')
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')

const postcssConfig = require('./.postcss.json')

gulp.task('styles', () => {
    gulp.src('_styles/*.css')
        .pipe(postcss([
            autoprefixer(postcssConfig['autoprefixer'])
        ]))
        .pipe(gulp.dest('styles'))
})

gulp.task('watch', () => {
    gulp.watch('_styles/*.css', ['styles'])
})

gulp.task('default', ['styles'])
