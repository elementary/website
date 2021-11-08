<?php

// Example of config file, add your own values.
// Config will fall back to what is present here.

return array(
  'release_title'    => 'Odin',
  'release_version'  => '6',
  'release_filename' => 'elementaryos-6.0-stable.20211103.iso',
  'release_size'     => '2.39 GB',
  'release_magnet'   => '0539d48ed49200d6cf50f2b5f397a3a8f0d779b1',
  'release_sha256'   => 'cf9c3ad03277ce93d8c089454c32316b0de464efda911833572cff62b4e7105a',
  'release_faq'      => 'https://github.com/elementary/os/wiki/elementary-OS-6-Odin-FAQ',

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

  'sentry_key' => false,
  'sentry_pub' => false,

  'twitter_consumer_key'    => 'test_ckey',
  'twitter_consumer_secret' => 'test_csecret',
  'twitter_access_token'    => 'test_atoken',
  'twitter_access_secret'   => 'test_asecret',
);
