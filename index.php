<?php

/*
 *---------------------------------------------------------------
 * APPLICATION ENTRY POINT
 *---------------------------------------------------------------
 * This is the entry point for the application. It redirects
 * all requests to the public/index.php file.
 */

// Path to the public directory
define('PUBLIC_PATH', __DIR__ . '/public/');

// If the request is for a real file, serve it directly
if (is_file(PUBLIC_PATH . $_SERVER['REQUEST_URI'])) {
    return false;
}

// Otherwise, route through public/index.php
require PUBLIC_PATH . 'index.php';