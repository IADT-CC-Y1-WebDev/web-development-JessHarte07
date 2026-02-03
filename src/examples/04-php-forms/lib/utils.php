<?php
function redirect($url) {
    header("Location: " . $url);
    exit();
}

function dd($var, $die = false) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    if ($die) {
        die();
    }
}

function h($string) {
    if ($string === null) {
        return '';
    }
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
