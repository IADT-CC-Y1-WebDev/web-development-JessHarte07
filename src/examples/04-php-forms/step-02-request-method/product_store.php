<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/utils.php';

startSession();

try {
    // Step 2: Check request method - only accept POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // If we get here, we have a valid POST request
    dd($_POST);
}
catch (Exception $e) {
    // Display the error message
    echo "Error: " . $e->getMessage();
}
