<?php
include 'Database/db.php';

// Получаем первые 10 статей, которые будут видны изначально
$res = mysqli_query($db, "SELECT * FROM `articles` ORDER BY `article_id`  LIMIT 25");

// Формируем массив из 10 статей
$articles = array();
while($row = mysqli_fetch_assoc($res))
{
    $articles[] = $row;
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset = "utf-8" />
    <title>Все статьи</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"  type="text/javascript"></script>
    <script type="text/javascript" src="Js/script.js"></script>

</head>

<body>

<div style="width: 200px;" id="articles">

    <?php foreach ($articles as $article): ?>
        <p><b><?php echo $article['title']; ?></b><br />
            <?php echo $article['text']; ?></p>
    <?php endforeach; ?>

</div>
<button id="more">Дальше</button>

</body>
</html>
