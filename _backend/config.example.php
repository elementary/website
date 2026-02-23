<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Circe',
  'release_version'  => '8.1.1',
  'release_size'     => '3.3 GB',
  'release_faq'      => 'https://github.com/elementary/os/wiki/OS-8-FAQ',

  'release_filename' => 'elementaryos-8.1-stable-amd64.20260219.iso',
  'release_magnet'   => '03148319face5909b193f1f980d0bcf9139a09ec',
  'release_sha256'   => 'bda93040d08c05911fb159f8150bf8f4ef2db6567ef6e2acd197cb6f395d3446',
  
  'release_arm_filename' => 'elementaryos-8.1-stable-arm64.20260219.iso',
  'release_arm_magnet'   => '90b3382caff769f4c7779ef90a5ab30eedda73d4',
  'release_arm_sha256'   => '85116d48c406ae7cd60c936050a099d4b8610321273f6f0a694796db4d4e86ba',

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
