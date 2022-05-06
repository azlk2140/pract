<?php
session_start();
$user_id = $_SESSION["user_id"] ?? false;
$photo_id = intval($_GET["id"]);
require "vendor/autoload.php";
$db = new \Azlk\DB();
$photo = $db->get_photo_by_id($photo_id);
$comments = $db->get_photo_comments($photo_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>foto</title>
</head>
<body>
    <?php include "header.php";?>
    <div id ="image">
    <img src="<?= $photo["Image"] ?>" alt="">
    <h1><?= $photo["Text"]?></h1>
    <p>АФФТОР: <?= $photo["Name"] ?></p>
    <div>
<div class="comments">
<div class="form">
    <textarea id="text" rows="5"></textarea>
    <button id="add_comment">dobavit</button>
</div>
<h2>comments</h2>
<?php foreach ($comments as $comment): ?>
    <div class="comments">
        <p class="autor"><?= $comment["Name"] ?></php>
        <p class="text"><?= $comment["Text"] ?></p>
        <p class="date"><?= $comment["Post_date"] ?></p>
        </div>
        <?php endforeach; ?>
</div>
<script src="image.js"></script>
</body>
</html>