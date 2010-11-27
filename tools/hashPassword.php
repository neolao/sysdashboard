<?php
// Get parameters
$arguments = $_SERVER['argv'];
array_shift($arguments);

// Password
if (empty($arguments)) {
    die("Password is undefined\n");
}
$password = array_shift($arguments);

echo sha1($password), "\n";
