<?php
// router.php
if (PHP_SAPI == 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($path[0] == '/') {
        $path = substr($path, 1);
    }
    if (!is_file($path) && !is_dir($path)) {
        require 'index.php';
    } else {
        return false;
    }
}
return true;