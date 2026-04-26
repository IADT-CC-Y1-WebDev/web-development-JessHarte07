<?php

// load database config + connection
require_once 'php/lib/config.php';

// session system (flash messages, redirects, etc.)
require_once 'php/lib/session.php';

// form helper functions (old(), error(), chosen(), etc.)
require_once 'php/lib/forms.php';

// utility functions (redirect, helpers, etc.)
require_once 'php/lib/utils.php';

// start session so flash messages work
startSession();

try {

    // storage for incoming request data
    $data = [];

    // storage for validation errors
    $errors = [];

    // only allow GET requests for delete action
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }

    // get book id from URL
    $data = [
        'id' => $_GET['id'] ?? null
    ];

    // validation rules for id
    $rules = [
        'id' => 'required|integer'
    ];

    // run validation
    $validator = new Validator($data, $rules);

    // if validation fails, collect errors
    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    // find book in database
    $book = Book::findById($data['id']);

    // if book does not exist, stop
    if (!$book) {
        throw new Exception('Book not found.');
    }

    // delete image file from server if it exists
    if ($book->cover_filename) {
        $uploader = new ImageUpload();
        $uploader->deleteImage($book->cover_filename);
    }

    // delete book record from database
    $book->delete();

    // clear any stored form data
    clearFormData();

    // clear any stored validation errors
    clearFormErrors();

    // success message for user
    setFlashMessage('success', 'Book deleted successfully.');

    // redirect back to main book list
    redirect('index.php');

}
catch (Exception $e) {

    // error message for user
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // store form data for debugging / retry
    setFormData($data);

    // store validation errors
    setFormErrors($errors);

    // if we still have an id, go back to view page
    if (isset($data['id']) && $data['id']) {
        redirect('book_view.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}