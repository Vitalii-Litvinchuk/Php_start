<?php
function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $rand_string = '';
    for ($i = 0; $i < 90; $i++)
        $rand_string = $rand_string . $characters[rand(0, strlen($characters) - 1)];
    return $rand_string;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $imageFileType = strtolower(pathinfo("uploads/" . basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));

    $imageName = RandomString() . "." . $imageFileType;

    $upload = "C:/xampp/htdocs/local.com/images/" . $imageName;

    move_uploaded_file($_FILES["image"]["tmp_name"], $upload);

    $conn = new PDO("mysql:host=localhost;dbname=local.com", "root", "");
    $sql = "INSERT INTO `news` (`name`, `description`,`image`) VALUES (?, ?, ?);";
    $conn->prepare($sql)->execute([$name, $description, $imageName]);
    header("Location: /");
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
    <div class="col my-2">
        <h2>Add news</h2>
    </div>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input name="name" id="name" type="text" class="form-control" placeholder="Name"/>
        </div>

        <div class="form-group">
            <input type="file" name="image" id="image" placeholder="Image"/>
        </div>

        <div class="form-group">
            <textarea type="text" name="description" id="description" rows="10" cols="45" class="form-control"
                      placeholder="Description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Add new</button>
    </form>
</div>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>
</body>
</html>