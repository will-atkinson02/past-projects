<?php

$db = new PDO('mysql:host=db;dbname=exercise', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


?>

<form method="post">
    <label for="addCategory">Add New Category:</label>
    <input type="text" id="addCategory" name="category"/>
    <input type="submit" value="Submit" />
</form>
