<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Circe',
  'release_version'  => '8.1',
  'release_filename' => 'elementaryos-8.1-stable-amd64.20251205.iso',
  'release_size'     => '3.3 GB',
  'release_magnet'   => '',
  'release_sha256'   => '809634a8ca527656c331e613f84d3cd528bb84cce71f0d238f3d0128db752e66',
  'release_faq'      => 'https://github.com/elementary/os/wiki/OS-8-FAQ',

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
