<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/forms.php';
require_once '../lib/utils.php';

startSession();

try {
    // Initialize arrays
    $data = [];
    $errors = [];
    $imageFilename = null;

    // Step 2: Check request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Step 3: Extract form data
    // Step 9: Include image from $_FILES
    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'description' => $_POST['description'] ?? null,
        'category_id' => $_POST['category_id'] ?? null,
        'feature_ids' => $_POST['feature_ids'] ?? [],
        'image' => $_FILES['image'] ?? null
    ];

    // Step 4: Define validation rules
    // Step 9: Include file validation rules
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'price' => 'required|float|minvalue:0',
        'description' => 'required|notempty|min:10|max:1000',
        'category_id' => 'required|integer',
        'feature_ids' => 'array',
        'image' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    // Step 4: Validate
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Step 5: Get first error for each field
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

    // In a real application, you would save to database here:
    // $product = new Product();
    // $product->title = $data['title'];
    // ...
    // $product->save();

    // Step 10: Clear form data on success
    clearFormData();
    clearFormErrors();

    // Step 8: Set success flash message and redirect
    setFlashMessage('success', 'Product created successfully! Image saved as: ' . $imageFilename);
    redirect('product_create.php');
}
catch (Exception $e) {
    // Clean up uploaded image if there was an error after upload
    if ($imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    // Step 8: Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Step 5: Store errors in session
    setFormErrors($errors);

    // Step 6: Store form data for repopulation
    setFormData($data);

    // Redirect back to form
    redirect('product_create.php');
}
