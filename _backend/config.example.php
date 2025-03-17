<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Circe',
  'release_version'  => '8.0.1',
  'release_filename' => 'elementaryos-8.0-stable.20250314rc.iso',
  'release_size'     => '3.3 GB',
  'release_magnet'   => '',
  'release_sha256'   => 'fb9f6bbbba8c2b4dd9d11de2c072b46fc35341b8c0a44ee323c095e865c47551',
  'release_faq'      => 'https://github.com/elementary/os/wiki/OS-8-FAQ',

  'previous_title'    => 'Circe',
  'previous_version'  => '8',
  'previous_filename' => 'elementaryos-8.0-stable.20241122rc.iso',
  'previous_size'     => '3.2 GB',
  'previous_magnet'   => 'd52eea45cd83f947983192e1ce2ef723ce992fec',

  'stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',
  'stripe_pk' => 'pk_test_hoigesrjgoisrhgilgjrsfjs',

  // Classic token that requires 'read:org', 'read:user', 'public_repo' scopes for `/api/sponsors_goals` endpoint
  'gh_sponsors_token' => 'ghp_1234567890abcdefghij',

  'previous_stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',

  'slack_token' => 'asdf-1234567890-7418529630-a7854123692-8412487519',

  'sentry_dsn' => false,
);
