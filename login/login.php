<?php

session_start();

var_dump($_SESSION);

$_SESSION['loggedIn'] = true;
$_SESSION['uid'] = 1;


$storedPassword = '$2y$10$aN2fluKTfeucDHzg3pAdrupec.CVEtnlVXsNQHuvkHjqPT8418zxe';

$inputtedPassword = 'password132';

$correct = password_verify($inputtedPassword, $storedPassword);


