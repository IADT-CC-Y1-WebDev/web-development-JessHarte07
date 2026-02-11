<?php
require_once "lib/session.php";
require_once "lib/utils.php";


startSession();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './inc/head_content.php'; ?>
    <title>Success - Exercise</title>
</head>
<body>
    <?php require './inc/flash_message.php'; ?>
    <div class="back-link">
        <a href="index.php">&larr; Back to Form Handling </a>
    </div>
    
    <h1>Success</h1>

    <!-- Display form data and errors for debugging purposes                 -->
    <?php dd(getFormData()); ?>
    <?php dd(getFormErrors()); ?>

    

    <!-- =================================================================== -->
    <!-- STEP 10: Clean Up                                                   -->
    <!-- See: /examples/04-php-forms/step-10-complete/                       -->
    <!-- =================================================================== -->
    <!-- TODO: Clear form data and errors after displaying the page          -->
    <?php
    //   Clear form data and errors
    ?>
    </body>
</html>