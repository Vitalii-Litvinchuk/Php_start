<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>News</title>
</head>
<?php
$conn = new PDO("mysql:host=localhost;dbname=local.com", "root", "");
$reader = $conn->query("SELECT * FROM news");
$imagePath = 'images/';
?>

<?php
if (isset($_POST['btnDelete'])) {
    $id = (int)$_POST['btnDelete'];
    $image = '';
    foreach ($conn->query("SELECT * FROM news WHERE id='$id'") as $row)
        $image = $row['image'];

    error_reporting(E_ERROR | E_PARSE);
    unlink('images/' . $image);
    error_reporting(E_ALL);

    $conn->query("DELETE FROM news WHERE id='$id'");
    header("Refresh:0");
}
?>

<?php

?>

<body>
<?php
include "navbar.php"
?>
<div class="container">

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reader as $row) {
            echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>
                        <img src='/{$imagePath}{$row['image']}' alt='image' width='100' />
                    </td>
                    <td>
                    <div class='row'>
                        <form method='post' class='col-3'>
                           <button type='submit' id='btnDelete' name='btnDelete' class='btn btn-danger px-3' value='{$row['id']}' >Delete</button>
                        </form>
                        <form method='post' class='col-3' action='edit.php'>
                           <button type='submit' id='btnEdit' name='btnEdit' class='btn btn-warning px-3' value='{$row['id']}' >Edit</button>
                        </form>
                    </div>
                    </td>
                </tr>
                ";
        }
        ?>

        </tbody>
    </table>
</div>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>