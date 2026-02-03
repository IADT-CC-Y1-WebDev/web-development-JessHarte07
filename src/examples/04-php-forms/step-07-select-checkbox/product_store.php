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

    // Step 7: Include category_id and feature_ids in data extraction
    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'description' => $_POST['description'] ?? null,
        'category_id' => $_POST['category_id'] ?? null,
        'feature_ids' => $_POST['feature_ids'] ?? []  // Default to empty array
    ];

    // Step 7: Add validation rules for category
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'price' => 'required|float|minvalue:0',
        'description' => 'required|notempty|min:10|max:1000',
        'category_id' => 'required|integer',
        'feature_ids' => 'array'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    // Success - show the data including selections
    echo "<h2>Validation Passed!</h2>";
    dd($data);
}
catch (Exception $e) {
    setFormErrors($errors);
    setFormData($data);
    redirect('product_create.php');
}
