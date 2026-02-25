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
        'id' => $_POST['id'] ?? null,
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'description' => $_POST['description'] ?? null,
        'image' => $_FILES['image'] ?? null
    ];

    // Define validation rules
    $rules = [
        'id' => 'required|integer',
        'title' => 'required|notempty|min:1|max:255',
        'author' => 'required|notempty',
        'description' => 'required|notempty|min:10|max:5000',
        'image' => 'file|image|mimes:jpg,jpeg,png|max_file_size:5242880' // optional -- no required rule
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

    // Find existing book
    $book = Book::findById($data['id']);
    if (!$book) {
        throw new Exception('Book not found.');
    }

   

    // Process the uploaded image (validation already completed)
    $imageFilename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('image')) {
        // Delete old image
        $uploader->deleteImage($book->cover_filename);
        // Process new image
        $imageFilename = $uploader->process($_FILES['image']);
        // Check for processing errors
        if (!$imageFilename) {
            throw new Exception('Failed to process and save the image.');
        }
    }
    
    // Update the book instance
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->description = $data['description'];
    if ($imageFilename) {
        $book->cover_filename = $imageFilename;
    }

    // Save to database
    $book->save();



    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Book updated successfully.');

    // Redirect to book details page
    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
    // Error - clean up uploaded image
    if ($imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    // Redirect back to edit page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('book_edit.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}
