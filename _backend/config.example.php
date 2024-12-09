<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Circe',
  'release_version'  => '8',
  'release_filename' => 'elementaryos-8.0-stable.20241122rc.iso',
  'release_size'     => '3.2 GB',
  'release_magnet'   => 'd52eea45cd83f947983192e1ce2ef723ce992fec',
  'release_sha256'   => '2567c1d2ab97a89562af82f8e8f9fcfa0192784596da73a520b2a34bad0227c8',
  'release_faq'      => 'https://github.com/elementary/os/wiki/OS-8-FAQ',

  'previous_title'    => 'Horus',
  'previous_version'  => '7.1',
  'previous_filename' => 'elementaryos-7.1-stable.20230926rc.iso',
  'previous_size'     => '3.0 GB',
  'previous_magnet'   => '80c702510aa2e68640389be9414df9e8f2cef618',

  'stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',
  'stripe_pk' => 'pk_test_hoigesrjgoisrhgilgjrsfjs',

  // Classic token that requires 'read:org', 'read:user', 'public_repo' scopes for `/api/sponsors_goals` endpoint
  'gh_sponsors_token' => 'ghp_1234567890abcdefghij',

  'previous_stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',

  'slack_token' => 'asdf-1234567890-7418529630-a7854123692-8412487519',

  'sentry_dsn' => false,
);
