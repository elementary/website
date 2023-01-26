<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Horus',
  'release_version'  => '7',
  'release_filename' => 'elementaryos-6.1-stable.20211218-rc.iso',
  'release_size'     => '2.8 GB',
  'release_magnet'   => '79c043454fc643b05aea16de848e5dce6eb8c9d9',
  'release_sha256'   => '35c8086bc0af8ccc5ef8629225b215b1742b3a90b475f9f47723b18a315d86a7',
  'release_faq'      => 'https://github.com/elementary/os/wiki/OS-7-Horus-FAQ',

  'previous_title'    => 'Jólnir',
  'previous_version'  => '6.1',
  'previous_filename' => 'elementaryos-6.1-stable.20211218-rc.iso',
  'previous_size'     => '2.47 GB',
  'previous_magnet'   => '79c043454fc643b05aea16de848e5dce6eb8c9d9',

  'chart_enable'         => false,
  'chart_link_project'   => 'elementary',
  'chart_link_milestone' => 'loki-rc1',
  'chart_link_name'      => 'Loki RC1 Milestone',

  'stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',
  'stripe_pk' => 'pk_test_hoigesrjgoisrhgilgjrsfjs',

  'previous_stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',

  'slack_token' => 'asdf-1234567890-7418529630-a7854123692-8412487519',

  'mandrill_key' => 'aaaaaaaaaaaaaaaaaaaaaa',

  'sentry_key' => false,
  'sentry_pub' => false,

  'twitter_consumer_key'    => 'test_ckey',
  'twitter_consumer_secret' => 'test_csecret',
  'twitter_access_token'    => 'test_atoken',
  'twitter_access_secret'   => 'test_asecret',
);
