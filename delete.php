<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $id = $_POST["id"];
    $conn = new PDO("mysql:host=localhost;dbname=local.com", "root", "");

    $image = '';
    foreach ($conn->query("SELECT * FROM news WHERE id='$id'") as $row)
        $image = $row['image'];

    unlink('images/' . $image);

    $conn->query("DELETE FROM news WHERE id='$id'");
}
?>
