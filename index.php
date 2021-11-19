<?php
$conn = new PDO("mysql:host=localhost;dbname=local.com", "root", "");
$imagePath = 'images/';
?>

<?php

?>

<?php
$reader = $conn->query("SELECT * FROM news");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/modal_rounded.css">
    <title>News</title>
</head>
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
                           <button type='submit' id='btnDelete' name='btnDelete' class='btn btn-danger px-3' data-id='{$row['id']}' >Delete</button>
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
<script>
    window.addEventListener("load", function () {
        var list = document.querySelectorAll("#btnDelete");
        for (let i = 0; i < list.length; i++) {
            list[i].addEventListener("click", function (e) {
                e.preventDefault();
                const id = e.currentTarget.dataset.id;
                DayPilot.Modal.confirm("Are you sure?", {theme: "modal_rounded"}).then(result => {
                    if (!result.canceled) {
                        const data = new FormData();
                        data.append("id", id);
                        axios.post("/delete.php", data).then(res => {
                            location.reload();
                        });
                    }
                });
            });
        }
    });
</script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/axios.min.js"></script>
<script src="/js/daypilot-all.min.js"></script>
</body>
</html>