<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/forms.php';
require_once '../lib/utils.php';

startSession();

try {
    $errors = [];
    $imageFilename = null;

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Step 9: Include image from $_FILES
    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'description' => $_POST['description'] ?? null,
        'category_id' => $_POST['category_id'] ?? null,
        'feature_ids' => $_POST['feature_ids'] ?? [],
        'image' => $_FILES['image'] ?? null
    ];

    // Step 9: Add file validation rules
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'price' => 'required|float|minvalue:0',
        'description' => 'required|notempty|min:10|max:1000',
        'category_id' => 'required|integer',
        'feature_ids' => 'array',
        'image' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    // Step 9: Process the uploaded image
    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['image']);

    if (!$imageFilename) {
        throw new Exception('Failed to process and save the image.');
    }

    // Clear form data on success
    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Product created with image: ' . $imageFilename);
    redirect('product_create.php');
}
catch (Exception $e) {
    // Clean up uploaded image if there was an error
    if ($imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());
    setFormErrors($errors);
    setFormData($data);
    redirect('product_create.php');
}
