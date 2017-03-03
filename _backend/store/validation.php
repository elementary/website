<?php

require_once __DIR__.'/address.php';

/**
 * ValidationException
 * A special exception safe to print
 */
class ValidationException extends Exception {}

/**
 * validate_number
 * Validates the value of a number
 *
 * @param Number  $i a number to validate
 * @param String  $m a message to give when validation fails
 * @param Boolean $a true if you want only positive number
 * @param Boolean $f true if you allow float numbers
 *
 * @throws ValidationException on validation error
 */
function validate_number ($i, $m = 'Number is not valid', $a = true, $f = true) {
    if (!isset($i) || !is_numeric($i)) {
        throw new ValidationException($m);
    }

    if ($a && $i <= 0) {
        throw new ValidationException($m);
    }

    if (!$f && !filter_var($i, FILTER_VALIDATE_INT)) {
        throw new validationException($m);
    }
}

/**
 * validate_string
 * Validates string
 *
 * @param String $i a string to validate
 * @param String $m a message to give on validation error
 *
 * @throws ValidationException on validation error
 */
function validate_string ($i, $m = 'String is not valid') {
    if (!isset($i) || !is_string($i)) {
        throw new ValidationException($m);
    }
}
