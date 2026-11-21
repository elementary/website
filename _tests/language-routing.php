<?php

/**
 * _tests/language-routing.php
 * Checks how language codes in addresses are parsed, redirected and turned
 * into canonical URLs. Run as `php _tests/language-routing.php`.
 */

require_once __DIR__ . '/../_backend/vendor/autoload.php';

use App\Lib\LanguageRoute;

echo "##################################\n";
echo "Starting language routing checking\n";
echo "##################################\n";

$failures = 0;

function check($label, $actual, $expected)
{
    global $failures;
    if ($actual !== $expected) {
        $failures++;
        echo 'FAIL: ' . $label . "\n";
        echo '  expected: ' . var_export($expected, true) . "\n";
        echo '  actual:   ' . var_export($actual, true) . "\n";
    }
}

$isLang = fn($c) => in_array($c, ['en', 'fr', 'de', 'pt_BR', 'zh_CN'], true);
$d = fn($uri, $user = null) => LanguageRoute::decide($uri, $isLang, $user);

check('parse nested', LanguageRoute::parse('/fr/de/support'), ['codes' => ['fr', 'de'], 'rest' => '/support']);
check('parse single', LanguageRoute::parse('/fr/'), ['codes' => ['fr'], 'rest' => '/']);
check('parse trailing code', LanguageRoute::parse('/fr/de'), ['codes' => ['fr', 'de'], 'rest' => '/']);
check('parse bare code untouched', LanguageRoute::parse('/fr'), ['codes' => [], 'rest' => '/fr']);
check('parse none', LanguageRoute::parse('/support'), ['codes' => [], 'rest' => '/support']);
check('parse not a code', LanguageRoute::parse('/fr/support'), ['codes' => ['fr'], 'rest' => '/support']);

check('invalid stripped', [$d('/hu/support')['status'], $d('/hu/support')['location']], [301, '/support']);
check('nested to first', $d('/fr/de/it/support')['location'], '/fr/support');
check('first valid kept', $d('/hu/fr/support')['location'], '/fr/support');
check('trailing code', $d('/fr/de')['location'], '/fr/');
check('long chain one hop', $d('/' . str_repeat('fr/', 12) . 'support')['location'], '/fr/support');
check('query kept', $d('/fr/de/support?x=1&lang=de')['location'], '/fr/support?x=1&lang=de');
check('path wins over ?lang', [$d('/fr/support?lang=de')['lang'], $d('/fr/support?lang=de')['status']], ['fr', null]);
check('prefixed sets cookie', $d('/fr/support')['cookie'], 'fr');
check('en redirects', [$d('/en/support')['status'], $d('/en/support')['location'], $d('/en/support')['cookie']], [302, '/support', 'en']);
check('detect redirect', [$d('/support', 'de')['status'], $d('/support', 'de')['location'], $d('/support', 'de')['vary']], [302, '/de/support', true]);
check('detect home', $d('/', 'pt_BR')['location'], '/pt_BR/');
check('english served', [$d('/support', 'en')['status'], $d('/support')['lang'], $d('/support')['vary']], [null, 'en', true]);
check('prefixed no vary', $d('/fr/support')['vary'], false);
check('no open redirect, rule 1', $d('/hu//evil.com')['location'], '/evil.com');
check('no open redirect, /en//', $d('/en//evil.com')['location'], '/en/evil.com');
check('no open redirect, rule 3', $d('/en/evil.com')['location'], '/evil.com');
check('no open redirect, backslash', $d('/hu/\\evil.com')['location'], '/evil.com');
check('double slash cleaned', $d('/fr//support')['location'], '/fr/support');
$isLangHant = fn($c) => in_array($c, ['en', 'fr', 'zh_Hant'], true);
check('unroutable user language served as English', LanguageRoute::decide('/support', $isLangHant, 'zh_Hant'), ['lang' => 'en', 'status' => null, 'location' => null, 'cookie' => null, 'vary' => true]);
check('url en', LanguageRoute::url('en', '/support'), 'https://elementary.io/support');
check('url fr', LanguageRoute::url('fr', '/'), 'https://elementary.io/fr/');

if ($failures > 0) {
    echo $failures . " check(s) failed\n";
    exit(1);
}

echo "###################################\n";
echo "Language routing checking complete!\n";
echo "###################################\n";
