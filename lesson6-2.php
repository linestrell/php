<?php
if ($_POST['do']) {
    require "function.php";
    $result = implode(" ", array($_POST['a'], $_POST['do'], $_POST['b']))." = ".mathOperation($_POST['a'], $_POST['b'], $_POST['do']);
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <ul>
        <li><a href="lesson6-1.php">Задание№1</a></li>
        <li><a href="?mod=feedback">Отзывы</a></li>
        <li><a href="?mod=catalog">Каталог</a></li>
    </ul>

        <p>Улучшенный калькулятор</p>
        <form action="" method="POST">
            <input type="text" name="a"><br>
            <select name="do">
                <option value="+">Сложение</option>
                <option value="-">Вычитание</option>
                <option value="*">Умножение</option>
                <option value="/">Деление</option>
            </select><br>
            <input type="text" name="b"><br>
            <input type="submit" value="Посчитать">
        </form>
        <p><?= $result ? $result : ""; ?></p>
    </body>
</html>






