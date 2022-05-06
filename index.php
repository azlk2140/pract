<?php
require "vendor/autoload.php";
$db = new Azlk\DB();
$data = $db->get_all_photos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <title>АЗЛК</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="media.css">
</head>
<body>

    <form method="post" enctype="multipart/form-data"></form>

    <?php include "header.php" ?>
    <h1>Москвичи</h1>
    <div id="grid">
        <?php foreach ($data as $photo): ?>
            <?= (new Azlk\Photo($photo["Id"], $photo["Image"], $photo["Text"]))->get_html() ?>
        <?php endforeach; ?>
    </div>
    <?php include "add_form.php"; ?>
    <div id="popup_photo">
        <img src="" alt="">
    </div> 
    <script src="script.js"></script>
</body>
</html>