<?php
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';

startSession();
$flash = getFlashMessage();
if ($flash) { ?>
    <h1 class="flash-message <?= h($flash['type']) ?>">
        <?= h($flash['message']) ?>
    </h1>
<?php } else { ?>
    <!-- No flash message to display -->
    <h1></h1> 
<?php } ?>