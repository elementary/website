<?php

header('strict-transport-security: max-age=31536000;');

// WARNING:
// Do NOT use "includeSubDomains"
// We have insecure sub-domains

// "preload" would not do anything as we don't meet the requirements
// https://hstspreload.appspot.com/

// Compatibility
// http://caniuse.com/#feat=stricttransportsecurity

// No content, send only this.
header($_SERVER['SERVER_PROTOCOL'].' 204 No Content');
