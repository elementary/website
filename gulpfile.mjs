/**
 * gulpfile.mjs
 * Does things with things for other built things
 */

import gulp from "gulp";
import cache from "gulp-cached";
import changed from "gulp-changed";
import rev from "gulp-rev";
import rename from "gulp-rename";
import { spawn } from "child_process";

import imagemin from "gulp-imagemin";

import postcss from "gulp-postcss";
import postcssPresetEnv from "postcss-preset-env";
import cssnano from "cssnano";

import webpack from "webpack";
import webpackConfig from "./webpack.config.babel.js";

/**
 * png
 * Optimizes png images
 *
 * @returns {Task} - a gulp task for png files
 */
gulp.task("png", () => {
  const base = "_images";
  const src = ["_images/**/*.png"];
  const dest = "images";

  return gulp
    .src(src, { base })
    .pipe(changed(dest))
    .pipe(cache("png"))
    .pipe(imagemin())
    .pipe(gulp.dest(dest));
});

/**
 * jpg
 * Optimizes jpg images
 *
 * @returns {Task} - a gulp task for jpg images
 */
gulp.task("jpg", () => {
  const base = "_images";
  const src = ["_images/**/*.jpg", "_images/**/*.jpeg"];
  const dest = "images";

  return gulp
    .src(src, { base })
    .pipe(changed(dest))
    .pipe(cache("jpg"))
    .pipe(imagemin())
    .pipe(gulp.dest(dest));
});

/**
 * gif
 * Optimizes gif images
 *
 * @returns {Task} - a gulp task for gif images
 */
gulp.task("gif", () => {
  const base = "_images";
  const src = ["_images/**/*.gif", "_images/**/*.gif"];
  const dest = "images";

  return gulp
    .src(src, { base })
    .pipe(changed(dest))
    .pipe(cache("gif"))
    .pipe(imagemin())
    .pipe(gulp.dest(dest));
});

/**
 * svg
 * Optimizes svg image outputs with svgo
 *
 * @returns {Task} - a gulp task for svg optimizes
 */
gulp.task("svg", () => {
  const base = "_images";
  const src = [
    "_images/**/*.svg",

    "!_images/icons/**/*.svg",
    "_images/icons/actions/symbolic/appointment-symbolic.svg",
    "_images/icons/actions/symbolic/edit-clear-all-symbolic.svg",
    "_images/icons/actions/symbolic/window-maximize-symbolic.svg",
    "_images/thirdparty-icons/apps/64/io.elementary.code.svg",
    "_images/icons/categories/64/preferences-desktop-wallpaper.svg",
    "_images/icons/devices/symbolic/audio-input-microphone-symbolic.svg",
    "_images/icons/places/128/distributor-logo.svg",
    "_images/icons/places/64/distributor-logo.svg",
    "_images/icons/status/symbolic/changes-prevent-symbolic.svg",
    "_images/icons/status/symbolic/notification-disabled-symbolic.svg",
    "_images/thirdparty-icons/apps/32/multitasking-view.svg",
  ];
  const dest = "images";

  return gulp
    .src(src, { allowEmpty: true, base })
    .pipe(changed(dest))
    .pipe(cache("svg"))
    .pipe(imagemin())
    .pipe(gulp.dest(dest));
});

/**
 * images
 * Optimizes all images
 *
 * @returns {Task} - a gulp task for all image optimizations
 */
gulp.task("images", gulp.parallel("png", "jpg", "svg", "gif"));

/**
 * styles
 * Builds all stylesheets
 *
 * @returns {Task} - a gulp task for building stylesheets
 */
gulp.task("styles", () => {
  const base = "_styles";
  const src = ["_styles/**/*.css"];
  const dest = "styles";

  return gulp
    .src(src, { base })
    .pipe(changed(dest))
    .pipe(postcss([postcssPresetEnv(), cssnano()]))
    .pipe(rev())
    .pipe(gulp.dest(dest))
    .pipe(
      rename({
        dirname: "styles", // rename dir in manifest
      }),
    )
    .pipe(rev.manifest("manifest.json"))
    .pipe(gulp.dest(dest));
});

/**
 * scripts
 * Runs webpack to build JavaScript
 */

gulp.task("scripts", () => {
  return new Promise((resolve, reject) => {
    webpack(webpackConfig, (err, stats) => {
      if (err) {
        console.log(err);
        reject(err);
      }
      console.log(
        stats.toString({
          chunks: false,
          colors: true,
        }),
      );
      resolve();
    });
  });
});

/**
 * default
 * Builds all asset files
 *
 * @returns {Task} - a gulp task for building
 */
gulp.task("default", gulp.parallel("styles", "scripts"));

/**
 * watch
 * Watches for asset changes and builds what it needs to
 *
 * @returns {Task} - a gulp task for building
 */
gulp.task(
  "watch",
  gulp.series("default", function watch() {
    gulp.watch("_images/**/*.png", gulp.series("png"));
    gulp.watch("_images/**/*.jpg", gulp.series("jpg"));
    gulp.watch("_images/**/*.svg", gulp.series("svg"));

    gulp.watch("_styles/**/*.css", gulp.series("styles"));
    gulp.watch("_scripts/**/*.js", gulp.series("scripts"));

    spawn("php", ["-S", "0.0.0.0:8000", "router.php"], {
      stdio: "inherit",
    });
  }),
);
