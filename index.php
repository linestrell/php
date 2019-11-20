<?php
require "config.php";
$mod = $_GET['mod'] ? (string)htmlspecialchars(strip_tags($_GET['mod'])) : DEFAULT_MOD;
if (file_exists("modules/" . $mod . "_proc.php")) {
    $process = "modules/" . $mod . "_proc.php";
}
if (file_exists("modules/" . $mod . ".php")) {
    $content = "modules/" . $mod . ".php";
}

$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
mysqli_set_charset($conn, "utf8");

if ($process) include $process;
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title ? " - ".$title : "" ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <ul>
        <li><a href="?mod=feedback">Отзывы</a></li>
        <li><a href="?mod=catalog">Каталог</a></li>
    </ul>
    <h1><?=$title;?></h1>
    <?php
    require $content;
    ?>
    </body>
    </html>
<?php
//mysqli_close($conn);
?>