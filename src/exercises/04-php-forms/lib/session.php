<?php
function startSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function setFlashMessage($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function getFlashMessage() {
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

function setFormData($data) {
    $_SESSION["form-data"] = $data;
}

function getFormData() {
    return $_SESSION["form-data"] ?? [];
}

function setFormErrors($errors) {
    $_SESSION["form-errors"] = $errors;
}

function getFormErrors() {
    return $_SESSION["form-errors"] ?? [];
}

function clearFormData() {
    if (isset($_SESSION["form-data"])) {
        unset($_SESSION["form-data"]);
    }
}

function clearFormErrors() {
    if (isset($_SESSION["form-errors"])) {
        unset($_SESSION["form-errors"]);
    }
}
?>