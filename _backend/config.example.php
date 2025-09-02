<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Circe',
  'release_version'  => '8.0.2',
  'release_filename' => 'elementaryos-8.0-stable-amd64.20250902rc.iso',
  'release_size'     => '3.5 GB',
  'release_magnet'   => '19e3fa024c654d4e644a77dd1bb43756fd905ae7',
  'release_sha256'   => 'a8c22b3cfd4b2432e74a1db5894b433f76cad130c1f41ee1f0d2e98a5c48e02e',
  'release_faq'      => 'https://github.com/elementary/os/wiki/OS-8-FAQ',

  'previous_title'    => 'Circe',
  'previous_version'  => '8.0.1',
  'previous_filename' => 'elementaryos-8.0-stable.20250314rc.iso',
  'previous_size'     => '3.3 GB',
  'previous_magnet'   => 'ca69606c5767ec131cc6d6618885b8920ca3f8e8',

  'stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',
  'stripe_pk' => 'pk_test_hoigesrjgoisrhgilgjrsfjs',

  // Classic token that requires 'read:org', 'read:user', 'public_repo' scopes for `/api/sponsors_goals` endpoint
  'gh_sponsors_token' => 'ghp_1234567890abcdefghij',

  'previous_stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',

  'slack_token' => 'asdf-1234567890-7418529630-a7854123692-8412487519',

  'sentry_dsn' => false,
);
