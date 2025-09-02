<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Circe',
  'release_version'  => '8.0.2',
  'release_filename' => 'elementaryos-8.0-stable-amd64.20250902rc.iso',
  'release_size'     => '3.3 GB',
  'release_magnet'   => '1cf38b09ad0b81997cff779033a21e7f66e24745',
  'release_sha256'   => 'c0ee5f9c1fa27a42fe864a6360ca17b3b40504f258ade3e4cfe7b17d94f8acc6',
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
