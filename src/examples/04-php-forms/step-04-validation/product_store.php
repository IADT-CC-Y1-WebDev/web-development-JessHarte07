<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/utils.php';

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'description' => $_POST['description'] ?? null
    ];

    // Step 4: Define validation rules for each field
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'price' => 'required|float|minvalue:0',
        'description' => 'required|notempty|min:10|max:1000'
    ];

    // Create validator and check for failures
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get all validation errors and terminate
        echo "<h2>Validation Errors:</h2>";
        dd($validator->errors(), true);
    }

    // If we get here, validation passed
    echo "<h2>Validation Passed!</h2>";
    dd($data);
}
catch (Exception $e) {
    // Display the error message
    echo $e->getMessage();
}
