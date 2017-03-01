<?php

/**
 * _backend/html.php
 * HTML helper functions
 */

namespace HTML {

  /**
   * $picture_sizes
   * All avalible sizes for built images. See gulpfile.babel.js for more info
   */
  $picture_sizes = [320, 640, 1280, 2560];

  /**
   * source_webp
   * Responsible for super awesome HTML5 webp source tag generation
   *
   * @param {String} $path - Src to file without size or dpi formats
   * @param {Number} $max - Max width of the image
   * @param {Number} $scale - Max density of the image
   */
  function source_webp (string $path, int $max, int $scale = 1) {
    global $picture_sizes;

    $path_parts = pathinfo($path);

    $sources = array();

    $requested_sizes = array_filter($picture_sizes, function ($size) use ($max) {
      return ($size < $max);
    });
    $requested_sizes[] = $max;
    $requested_sizes = array_reverse($requested_sizes);

    foreach ($requested_sizes as $index => $size) {
      $src_path = $path_parts['dirname'] . '/' . $path_parts['filename'];
      $media_scale = '';

      if ($index !== count($requested_sizes) - 1) {
        $media_scale = 'media="(min-width: ' . $requested_sizes[$index + 1] . 'px)"';
      }

      if ($scale !== 1) {
        $src_path = $src_path . '@' . $scale . 'x';

        $media_scales = array();

        $media_scales[] = "(-webkit-min-device-pixel-ratio: $scale)";
        $media_scales[] = '(min-resolution: ' . $scale . 'dppx)';
        $media_scales[] = '(min-resolution: ' . $scale * 96 . 'dpi)';

        if ($index !== count($requested_sizes) - 1) {
          foreach ($media_scales as &$query) {
            $query = '(min-width: ' . $requested_sizes[$index + 1] . 'px) and ' . $query;
          }
        }

        $media_scale = 'media="' . join($media_scales, ', ') . '"';
      }

      if (in_array($size, $picture_sizes)) {
        $src_path = $src_path . "-$size";
      }
      $src_path = $src_path . '.webp';

      $sources[] = "<source srcset=\"$src_path\" $media_scale />";
    }

    echo join($sources, "\n");
  }
}
