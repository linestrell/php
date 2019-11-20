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
        <title>homework#6</title>
    </head>
    <body>
        <p>Калькулятор</p>
        <form action="" method="POST">
            <input type="text" name="a"><br>
            <input type="submit" value="+" name="do">
            <input type="submit" value="-" name="do">
            <input type="submit" value="*" name="do">
            <input type="submit" value="/" name="do">
            <br>
            <input type="text" name="b"><br>
        </form>
        <p><?= $result ? $result : ""; ?></p>
        <p>Улучшенный калькулятор</p>
        <form action="" method="POST">
            <input type="text" name="a"><br>
            <select name="do">
                <option value="+">сложение</option>
                <option value="-">вычитание</option>
                <option value="*">умножение</option>
                <option value="/">деление</option>
            </select><br>
            <input type="text" name="b"><br>
            <input type="submit" value="Посчитать">
        </form>
        <p><?= $result ? $result : ""; ?></p>
    </body>
</html>