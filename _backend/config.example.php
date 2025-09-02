<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Circe',
  'release_version'  => '8.0.2',
  'release_filename' => 'elementaryos-8.0-stable.20250801rc.iso',
  'release_size'     => '3.7 GB',
  'release_magnet'   => '9fc5fc91c60d5cd9b3979105fc7470a3489840c2',
  'release_sha256'   => 'ebcb36a3889bb45ba9f73e54b0412b41e0ace9374138e23649e462b26e644c85',
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
