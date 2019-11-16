<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="popup/magnific-popup.css">

    <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Magnific Popup core JS file -->
    <script src="popup/jquery.magnific-popup.js"></script>
    <title>Document</title>
</head>
<body>
<h1>Галерея фотографий</h1>
<p>
    Создать галерею фотографий.Она должна состоять из одной страницы, на которой пользователь видит все картинки в уменьшенном виде.<br>
    При клике на фотографию она должна открыться в браузере в новой вкладке. Размер картинок можно ограничивать с помощью свойства width.
</p>

<?php
$dir = 'big_images/'; // Папка с изображениями
$cols = 5; // Количество столбцов в будущей таблице с картинками
$files = scandir($dir); // Берём всё содержимое директории
echo "<table>"; // Начинаем таблицу
$k = 0; // Вспомогательный счётчик для перехода на новые строки
for ($i = 0; $i < count($files); $i++) { // Перебираем все файлы
    if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем
        if ($k % $cols == 0) {
            echo "<tr>";
        } // Добавляем новую строку
        echo "<td>"; // Начинаем столбец
        $path = $dir.$files[$i]; // Получаем путь к картинке
        echo "<a href='$path' class='image-link'>"; // Делаем ссылку на картинку
        echo "<img src='$path' alt='' width='100' />"; // Вывод превью картинки
        echo "</a>"; // Закрываем ссылку
        echo "</td>"; // Закрываем столбец
        /* Закрываем строку, если необходимое количество было выведено, либо данная итерация последняя */
        if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) {
            echo "</tr>";
        }
        $k++; // Увеличиваем вспомогательный счётчик
    }
}
echo "</table>"; // Закрываем таблицу
?>

<h2>Загрузить фотографию</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <p><input type="file" name="file"></p>
    <p><input type="submit" name="load" value="Загрузить файл"></p>
    <br>
</form>
<script>
$(document).ready(function() {
    $('.image-link').magnificPopup({type:'image'});
});
</script>
</body>
</html>