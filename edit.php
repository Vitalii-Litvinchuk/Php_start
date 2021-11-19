<?php
$conn = new PDO("mysql:host=localhost;dbname=local.com", "root", "");
if (isset($_POST['btnEdit'])) {
    $id = (int)$_POST['btnEdit'];
    $element = $conn->query("SELECT * FROM news WHERE id='$id'");
    $name = '';
    $image = '';
    $description = '';
    foreach ($element as $row) {
        $name = $row['name'];
        $image = $row['image'];
        $description = $row['description'];
    }

}
?>

<?php
if (isset($_POST['edit'])) {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE `news` SET name=?, description=? where id=?;";
//  $sql = "UPDATE `news` SET name=" . $name . ", description=" . $description . ", image=" . $image . " where id=" . $id . ";";
    $conn->prepare($sql)->execute([$name, $description, $id]);
    header("location: /");

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>News</title>
</head>
<body>
<?php include "navbar.php"; ?>

<div class="container">
    <?php
    echo "
        <form method='post' enctype='multipart/form-data'>
        <div class='col my-2'>
            <input hidden name='id' value='{$id}'/>
            <h2>Edit # {$id}</h2>
        </div>
        <div class='form-group'>
            <input name='name' id='name' type='text' value='{$name}' class='form-control' placeholder='Name'/>
        </div>

        <div class='form-group'>
            <img width='300' height='260' src='/images/{$image}' alt='image'>
            <input type='file' name='image' id='image'/>
        </div>

        <div class='form-group'>
            <textarea type='text' name='description' id='description' rows='10' cols='45' class='form-control'
             placeholder='Description'>{$description}</textarea>
        </div>
        <button type='submit' name='edit' class='btn btn-primary mb-3'>Edit</button>
    </form>";
    ?>
</div>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>
</body>
</html>