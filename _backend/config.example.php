<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Circe',
  'release_version'  => '8.1',
  'release_size'     => '3.3 GB',
  'release_faq'      => 'https://github.com/elementary/os/wiki/OS-8-FAQ',

  'release_filename' => 'elementaryos-8.1-stable-amd64.20260107.iso',
  'release_magnet'   => '9268ffc00ee78831a2b3fdf74ff243a207e27b69',
  'release_sha256'   => '24cc821cefa2600ce54686f406e6782eafe658ce56e190dea331a60c6cd13c99',
  
  'release_arm_filename' => 'elementaryos-8.1-stable-arm64.20260107.iso',
  'release_arm_magnet'   => 'e73b799d78b2c92817db84ac9c115304bd783604',
  'release_arm_sha256'   => '05b3996604e8b80424a20ab9f2aec97695aecef2099b68cf9e7236cfc0d4f818',

  'previous_title'    => 'Circe',
  'previous_version'  => '8.0.2',
  'previous_filename' => 'elementaryos-8.0-stable-amd64.20250902rc.iso',
  'previous_size'     => '3.3 GB',
  'previous_magnet'   => '36d2dec9234ae7196062b60eca32b08f01c77143',

  'stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',
  'stripe_pk' => 'pk_test_hoigesrjgoisrhgilgjrsfjs',

  // Classic token that requires 'read:org', 'read:user', 'public_repo' scopes for `/api/sponsors_goals` endpoint
  'gh_sponsors_token' => 'ghp_1234567890abcdefghij',

  'previous_stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',

  'slack_token' => 'asdf-1234567890-7418529630-a7854123692-8412487519',

  'sentry_dsn' => false,
);
