<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Jólnir',
  'release_version'  => '6.1',
  'release_filename' => 'elementaryos-6.1-stable.20211218-rc.iso',
  'release_size'     => '2.47 GB',
  'release_magnet'   => '79c043454fc643b05aea16de848e5dce6eb8c9d9',
  'release_sha256'   => '35c8086bc0af8ccc5ef8629225b215b1742b3a90b475f9f47723b18a315d86a7',
  'release_faq'      => 'https://github.com/elementary/os/wiki/elementary-OS-6.1-Jólnir-FAQ',

  'previous_title'    => 'Hera',
  'previous_version'  => '5.1.7',
  'previous_filename' => 'elementaryos-5.1-stable.20200814.iso',
  'previous_size'     => '1.49 GB',
  'previous_magnet'   => '73e9c0288c0b62c2646b695219b550fd231fede4',

  'chart_enable'         => false,
  'chart_link_project'   => 'elementary',
  'chart_link_milestone' => 'loki-rc1',
  'chart_link_name'      => 'Loki RC1 Milestone',

  'stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',
  'stripe_pk' => 'pk_test_hoigesrjgoisrhgilgjrsfjs',

  'previous_stripe_sk' => 'sk_test_hoigesrjgoisrhgilgjrsfjs',

  'slack_token' => 'asdf-1234567890-7418529630-a7854123692-8412487519',

  'mandrill_key' => 'aaaaaaaaaaaaaaaaaaaaaa',

  'sentry_dsn' => false,

  'twitter_consumer_key'    => 'test_ckey',
  'twitter_consumer_secret' => 'test_csecret',
  'twitter_access_token'    => 'test_atoken',
  'twitter_access_secret'   => 'test_asecret',
);
