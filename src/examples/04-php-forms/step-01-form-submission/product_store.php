<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/utils.php';

startSession();

// Step 1: Display the submitted form data using dd()
// The $_POST superglobal contains all form data sent via POST method
dd($_POST);
