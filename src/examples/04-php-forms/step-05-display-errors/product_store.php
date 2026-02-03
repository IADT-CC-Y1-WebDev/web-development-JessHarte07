<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/forms.php';
require_once '../lib/utils.php';

startSession();

try {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'description' => $_POST['description'] ?? null
    ];

    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'price' => 'required|float|minvalue:0',
        'description' => 'required|notempty|min:10|max:1000'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Step 5: Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    // Success - for now just show the data
    echo "<h2>Validation Passed!</h2>";
    dd($data);
}
catch (Exception $e) {
    // Step 5: Store errors in session and redirect back to form
    setFormErrors($errors);
    redirect('product_create.php');
}
