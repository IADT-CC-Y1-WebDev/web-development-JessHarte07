<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    // Initialize form data array
    $data = [];
    // Initialize errors array
    $errors = [];

    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'genre_id' => $_POST['genre_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'platform_ids' => $_POST['platform_ids'] ?? [],
        'image' => $_FILES['image'] ?? null
    ];

    // Define validation rules
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'author' => 'required|notempty',
        'genre_id' => 'required|integer',
        'description' => 'required|notempty|min:10|max:5000',
        'platform_ids' => 'required|array|min:1|max:10',
        'image' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    // Validate all data (including file)
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    // All validation passed - now process and save
    // Verify genre exists
    $genre = Genre::findById($data['genre_id']);
    if (!$genre) {
        throw new Exception('Selected genre does not exist.');
    }

    // Process the uploaded image (validation already completed)
    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['image']);

    if (!$imageFilename) {
        throw new Exception('Failed to process and save the image.');
    }

    // Create new book instance
    $book = new Book();
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->genre_id = $data['genre_id'];
    $book->description = $data['description'];
    $book->cover_filename = $imageFilename;

    // Save to database
    $book->save();
    // Create platform associations
    if (!empty($data['platform_ids']) && is_array($data['platform_ids'])) {
        foreach ($data['platform_ids'] as $platformId) {
            // Verify platform exists before creating relationship
            if (Platform::findById($platformId)) {
                BookPlatform::create($book->id, $platformId);
            }
        }
    }

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Book stored successfully.');

    // Redirect to book details page
    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
    // Error - clean up uploaded image
    if (isset($imageFilename) && $imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    redirect('book_create.php');
}
