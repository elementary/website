/**
 * gulpfile.babel.js
 * Does things with things for other built things
 */

import gulp from 'gulp'

import imagemin from 'gulp-imagemin'
import resize from 'gulp-responsive'
import svgo from 'gulp-svgo'
import webp from 'gulp-webp'

import postcss from 'gulp-postcss'
import cssnext from 'postcss-cssnext'

const browsers = [
    'last 4 version',
    'not ie <= 11'
]

/**
 * image
 * Optimizes all normal image types
 *
 * @returns {Task} - a gulp task for image types
 */
gulp.task('image', () => {
    const base = '_images'
    const src = ['_images/**/*.png', '_images/**/*.jpg', '_images/**/*.jpeg', '_images/**/*.webp']
    const dest = 'images'

    return gulp.src(src, { base })
    .pipe(imagemin())
    .pipe(gulp.dest(dest))
})

/**
 * webp
 * Optimizes all normal images with webp
 *
 * @returns {Task} - a gulp task for webp awesomesause
 */
gulp.task('webp', () => {
    const base = '_images'
    const dest = 'images'

    const prefix = '_images/**/*'
    const suffix = ['png', 'jpg', 'jpeg', 'webp']

    const srcHi = [...suffix.map((e) => `${prefix}@2x.${e}`)]
    const srcLo = [...suffix.map((e) => `${prefix}.${e}`), ...srcHi.map((p) => `!${p}`)]

    const options = {
        errorOnEnlargement: false,
        errorOnUnusedImage: false,
        lossless: true,
        progressive: true,
        quality: 100,
        skipOnEnlargement: true,
        withMetadata: false,
        withoutEnlargement: true
    }

    const lodpi = gulp.src(srcLo, { base })
    .pipe(webp({ lossless: true }))
    .pipe(resize({
        '**/*': [{
            width: 200,
            rename: { suffix: '-small' }
        }, {
            width: 600,
            rename: { suffix: '-medium' }
        }, {
            width: 1000,
            rename: { suffix: '-large' }
        }, {
            rename: { suffix: '-original' }
        }]
    }, options))
    .pipe(gulp.dest(dest))

    const hidpi = gulp.src(srcHi, { base })
    .pipe(webp({ lossless: true }))
    .pipe(resize({
        '**/*': [{
            width: 400,
            rename: { suffix: '-small' }
        }, {
            width: 1200,
            rename: { suffix: '-medium' }
        }, {
            width: 2000,
            rename: { suffix: '-large' }
        }, {
            rename: { suffix: '-original' }
        }]
    }, options))
    .pipe(gulp.dest(dest))

    return Promise.all([lodpi, hidpi])
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
    .pipe(svgo())
    .pipe(gulp.dest(dest))
})

/**
 * images
 * Optimizes all images
 *
 * @returns {Task} - a gulp task for all image optimizations
 */
gulp.task('images', gulp.parallel('image', 'webp', 'svg'))

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
