<?php

// Bootstrap file for Stripe PHP Library
// This file manually loads the Stripe library when Composer doesn't recognize it

$stripePath = __DIR__ . '/../vendor/stripe/stripe-php';

if (is_dir($stripePath)) {
    // Include the main Stripe init file if it exists
    $stripeInitFile = $stripePath . '/init.php';
    if (file_exists($stripeInitFile)) {
        require_once $stripeInitFile;
    } else {
        // Manually register the autoloader for Stripe
        spl_autoload_register(function ($class) use ($stripePath) {
            if (strpos($class, 'Stripe\\') === 0) {
                $relativeClass = substr($class, strlen('Stripe\\'));
                $file = $stripePath . '/lib/' . str_replace('\\', '/', $relativeClass) . '.php';
                if (file_exists($file)) {
                    require_once $file;
                    return true;
                }
            }
            return false;
        });
    }

    return true;
} else {
    throw new Exception('Stripe library not found at: ' . $stripePath);
}
