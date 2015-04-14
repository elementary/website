<?php

header('strict-transport-security: max-age=31536000;');

// WARNING:
// Do NOT use "includeSubDomains"
// We have insecure sub-domains

// "preload" would not do anything as we don't meet the requirements
// https://hstspreload.appspot.com/

// Compatibility
// http://caniuse.com/#feat=stricttransportsecurity

// We're going to pretend this is JavaScript, so we can log something.
header('Content-Type: application/javascript');
?>console.log('HSTS Loaded');
