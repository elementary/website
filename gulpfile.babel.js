/**
 * gulpfile.babel.js
 * Does things with things for other built things
 */

import gulp from 'gulp'
import cache from 'gulp-cached'
import changed from 'gulp-changed'

import imagemin from 'gulp-imagemin'
import svgo from 'gulp-svgo'

import postcss from 'gulp-postcss'
import cssnext from 'postcss-cssnext'

const browsers = [
    'last 4 version',
    'not ie <= 11'
]

/**
 * png
 * Optimizes png images
 *
 * @returns {Task} - a gulp task for png files
 */
gulp.task('png', () => {
    const base = '_images'
    const src = ['_images/**/*.png']
    const dest = 'images'

    return gulp.src(src, { base })
    .pipe(changed(dest))
    .pipe(cache('png'))
    .pipe(imagemin())
    .pipe(gulp.dest(dest))
})

/**
 * jpg
 * Optimizes jpg images
 *
 * @returns {Task} - a gulp task for jpg images
 */
gulp.task('jpg', () => {
    const base = '_images'
    const src = ['_images/**/*.jpg', '_images/**/*.jpeg']
    const dest = 'images'

    return gulp.src(src, { base })
    .pipe(changed(dest))
    .pipe(cache('jpg'))
    .pipe(imagemin())
    .pipe(gulp.dest(dest))
})

/**
 * svg
 * Optimizes svg image outputs with svgo
 *
 * @returns {Task} - a gulp task for svg optimizes
 */
gulp.task('svg', () => {
    const base = '_images'
    const src = [
        '_images/**/*.svg',

        '!_images/icons/**/*.svg',
        '_images/icons/actions/48/document-export.svg',
        '_images/icons/actions/symbolic/edit-clear-symbolic.svg',
        '_images/icons/actions/symbolic/edit-find-symbolic.svg',
        '_images/icons/actions/symbolic/view-filter-symbolic.svg',
        '_images/icons/actions/symbolic/view-grid-symbolic.svg',
        '_images/icons/actions/symbolic/window-maximize-symbolic.svg',
        '_images/icons/apps/128/accessories-text-editor.svg',
        '_images/icons/apps/128/application-default-icon.svg',
        '_images/icons/apps/128/system-software-install.svg',
        '_images/icons/apps/128/utilities-terminal.svg',
        '_images/icons/apps/32/accessories-camera.svg',
        '_images/icons/apps/32/archive-manager.svg',
        '_images/icons/apps/32/office-calendar.svg',
        '_images/icons/apps/32/onboard.svg',
        '_images/icons/apps/32/postscript-viewer.svg',
        '_images/icons/apps/32/preferences-desktop.svg',
        '_images/icons/apps/32/system-file-manager.svg',
        '_images/icons/apps/32/system-software-install.svg',
        '_images/icons/apps/48/internet-web-browser.svg',
        '_images/icons/apps/48/ubiquity.svg',
        '_images/icons/apps/48/utilities-terminal.svg',
        '_images/icons/apps/64/accessories-calculator.svg',
        '_images/icons/apps/64/accessories-camera.svg',
        '_images/icons/apps/64/accessories-screenshot.svg',
        '_images/icons/apps/64/accessories-text-editor.svg',
        '_images/icons/apps/64/internet-mail.svg',
        '_images/icons/apps/64/internet-web-browser.svg',
        '_images/icons/apps/64/multimedia-audio-player.svg',
        '_images/icons/apps/64/multimedia-photo-manager.svg',
        '_images/icons/apps/64/multimedia-video-player.svg',
        '_images/icons/apps/64/office-calendar.svg',
        '_images/icons/apps/64/preferences-desktop.svg',
        '_images/icons/apps/64/system-file-manager.svg',
        '_images/icons/apps/64/system-software-install.svg',
        '_images/icons/apps/64/utilities-terminal.svg',
        '_images/icons/apps/64/web-browser.svg',
        '_images/icons/categories/32/preferences-desktop-display.svg',
        '_images/icons/categories/32/preferences-system-time.svg',
        '_images/icons/categories/48/preferences-system-network.svg',
        '_images/icons/categories/64/preferences-desktop-wallpaper.svg',
        '_images/icons/devices/64/scanner.svg',
        '_images/icons/mimes/48/office-database.svg',
        '_images/icons/places/128/distributor-logo.svg',
        '_images/icons/places/64/distributor-logo.svg',
        '_images/icons/status/48/dialog-warning.svg',
        '_images/thirdparty-icons/apps/32/multitasking-view.svg'
    ]
    const dest = 'images'

    return gulp.src(src, { base })
    .pipe(changed(dest))
    .pipe(cache('svg'))
    .pipe(svgo())
    .pipe(gulp.dest(dest))
})

/**
 * images
 * Optimizes all images
 *
 * @returns {Task} - a gulp task for all image optimizations
 */
gulp.task('images', gulp.parallel('png', 'jpg', 'svg'))

/**
 * styles
 * Builds all stylesheets
 *
 * @returns {Task} - a gulp task for building stylesheets
 */
gulp.task('styles', () => {
    const base = '_styles'
    const src = ['_styles/**/*.css']
    const dest = 'styles'

    return gulp.src(src, { base })
    .pipe(changed(dest))
    .pipe(postcss([
        cssnext({ browsers })
    ]))
    .pipe(gulp.dest(dest))
})

/**
 * default
 * Builds all asset files
 *
 * @returns {Task} - a gulp task for building
 */
gulp.task('default', gulp.parallel('images', 'styles'))

/**
 * watch
 * Watches for asset changes and builds what it needs to
 *
 * @returns {Task} - a gulp task for building
 */
gulp.task('watch', gulp.series('default', function watch () {
    gulp.watch('_images/**/*.png', gulp.series('png'))
    gulp.watch('_images/**/*.jpg', gulp.series('jpg'))
    gulp.watch('_images/**/*.svg', gulp.series('svg'))

    gulp.watch('_styles/**/*.css', gulp.series('styles'))
}))
