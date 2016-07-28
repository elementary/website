<?php

// Validation: Some general functions for input validation and default values
// Used mostly on store related pages

// validation_assert: if no other errors exist, it assert input fits into type
function validation_assert (&$error, $input, $type, $message) {
        if ($error) return;

        if (!isset($input) || !$input) {
            $error = $message;
        }

        if ($type === 'name' && !preg_match("/^[a-z ]{3,}$/i", $input)) {
            $error = $message;
        } else if ($type === 'number' && !filter_var($input, FILTER_VALIDATE_INT)) {
            $error = $message;
        } else if ($type === 'address-line' && !preg_match("/^\d+ [0-9a-z ]+$/i", $input)) {
            $error = $message;
        } else if ($type === 'address-postal' && !preg_match("/^\d{5,}$/", $input)) {
            $error = $message;
        } else if ($type === 'email' && !filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $error = $message;
        }
}
