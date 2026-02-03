<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/utils.php';

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Step 3: Extract form data into an associative array
    // The ?? operator provides a default value if the key doesn't exist
    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'description' => $_POST['description'] ?? null
    ];

    // Now we can work with $data instead of $_POST
    dd($data);
}
catch (Exception $e) {
    // Display the error message
    echo "Error: " . $e->getMessage();
}
