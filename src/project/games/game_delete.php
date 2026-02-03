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
    
    // Check if request is GET
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'id' => $_GET['id'] ?? null
    ];

    // Define validation rules
    $rules = [
        'id' => 'required|integer'
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

    // Find existing game
    $game = Game::findById($data['id']);
    if (!$game) {
        throw new Exception('Game not found.');
    }

    // Delete the associated image file if it exists
    if ($game->image_filename) {
        $uploader = new ImageUpload();
        $uploader->deleteImage($game->image_filename);
    }
    // Delete the game
    $game->delete();

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Game deleted successfully.');

    // Redirect to game details page
    redirect('index.php');
}
catch (Exception $e) {
    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    // Redirect back to view page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('game_view.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}
