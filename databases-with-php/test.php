<?php

$db = new PDO('mysql:host=db;dbname=exercise', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

var_dump($_POST);

// Check to make sure the form was submitted before we add the colour to the DB
if(isset($_POST['colour'])) {
    $inputtedColour = $_POST['colour'];

    $query = $db->prepare("INSERT INTO `colors` (`color`) VALUES (:colour)");

    // execute() returns a bool to tell us whether or not the query worked
    if ($query->execute(['colour' => $inputtedColour])) {
        echo 'New colour added to DB';
    } else {
        echo 'Oh no';;
    }
}

?>

<form method="post">
    <label for="colour">Colour</label>
    <input type="text" id="colour" name="colour" />
    <input type="submit" value="Add a new colour" />
</form>