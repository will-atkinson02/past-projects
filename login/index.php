<?php

session_start();

echo '<pre>';

if ($_SESSION['loggedIn']) {
    echo 'Logged in!';
}