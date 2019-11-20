<?php
$title = "Каталог";
if($_GET['prod']) {
    $id = intval($_GET['prod']);
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $prod = mysqli_fetch_assoc($result);
    $title .= " - ".$prod['name'];
}