<?php

/**
 * LanguageRoute.php
 * Parses language codes at the start of an address and decides whether to
 * serve the page, redirect it, set the language cookie or send Vary.
 */

namespace App\Lib;

class LanguageRoute
{
    /**
     * The shape of a language code in an address. Must match the nginx rules.
     */
    const CODE = '[a-z]{2}(?:_[A-Z]{2})?';

    const SITE_URL = 'https://elementary.io';

    /**
     * Splits the leading language codes from a path
     *
     * @param  string $path The request path, starting with /
     * @return array        ['codes' => string[], 'rest' => string]
     */
    public static function parse($path)
    {
        $code = self::CODE;

        // Only codes, with no trailing slash, e.g. /fr/de
        if (preg_match('#^/(' . $code . '(?:/' . $code . ')+)$#', $path, $matches)) {
            return ['codes' => explode('/', $matches[1]), 'rest' => '/'];
        }

        if (preg_match('#^/((?:' . $code . '/)+)(.*)$#', $path, $matches)) {
            $codes = array_values(array_filter(explode('/', $matches[1]), fn($s) => $s !== ''));
            // Extra slashes after the codes would make a redirect target
            // protocol-relative (//evil.com), so collapse them
            return ['codes' => $codes, 'rest' => '/' . ltrim($matches[2], '/\\')];
        }

        return ['codes' => [], 'rest' => $path];
    }

    /**
     * Decides what to do with a request
     *
     * @param  string      $requestUri The original request URI, with query string
     * @param  callable    $isLang     Returns whether a code is an available language
     * @param  string|null $userLang   The cookie or Accept-Language choice, if any
     * @return array                   ['lang', 'status', 'location', 'cookie', 'vary']
     */
    public static function decide($requestUri, callable $isLang, $userLang)
    {
        $path = parse_url($requestUri, PHP_URL_PATH);
        if (!is_string($path) || $path === '') {
            $path = '/';
        }
        $query = parse_url($requestUri, PHP_URL_QUERY);
        $suffix = (is_string($query) && $query !== '') ? '?' . $query : '';

        $result = ['lang' => 'en', 'status' => null, 'location' => null, 'cookie' => null, 'vary' => false];
        $parsed = self::parse($path);

        if (!empty($parsed['codes'])) {
            $valid = null;
            foreach ($parsed['codes'] as $code) {
                if ($isLang($code)) {
                    $valid = $code;
                    break;
                }
            }

            $clean = (($valid === null) ? '' : '/' . $valid) . $parsed['rest'];
            if ($clean !== $path) {
                $result['lang'] = $valid ?? 'en';
                $result['status'] = 301;
                $result['location'] = $clean . $suffix;
                return $result;
            }

            if ($valid === 'en') {
                $result['status'] = 302;
                $result['location'] = $parsed['rest'] . $suffix;
                $result['cookie'] = 'en';
                return $result;
            }

            $result['lang'] = $valid;
            $result['cookie'] = $valid;
            return $result;
        }

        $result['vary'] = true;
        // A language whose code the address can't carry would redirect forever
        $routable = $userLang !== null && preg_match('#^' . self::CODE . '$#', $userLang);
        if ($routable && $userLang !== 'en' && $isLang($userLang)) {
            $result['lang'] = $userLang;
            $result['status'] = 302;
            $result['location'] = '/' . $userLang . $parsed['rest'] . $suffix;
        }

        return $result;
    }

    /**
     * Builds the absolute URL of a page in a language
     *
     * @param  string $lang The language code
     * @param  string $path The page path, starting with /
     * @return string
     */
    public static function url($lang, $path)
    {
        return self::SITE_URL . (($lang === 'en') ? '' : '/' . $lang) . $path;
    }
}
