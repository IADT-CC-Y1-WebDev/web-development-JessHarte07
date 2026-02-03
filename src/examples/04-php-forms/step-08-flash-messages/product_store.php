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
        'description' => $_POST['description'] ?? null,
        'category_id' => $_POST['category_id'] ?? null,
        'feature_ids' => $_POST['feature_ids'] ?? []
    ];

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

    // Clear form data on success
    clearFormData();
    clearFormErrors();

    // Step 8: Set success flash message
    setFlashMessage('success', 'Product created successfully! (In a real app, we would save to database here)');
    redirect('product_create.php');
}
catch (Exception $e) {
    // Step 8: Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    setFormErrors($errors);
    setFormData($data);
    redirect('product_create.php');
}
