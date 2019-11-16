<?php
/*
 * Функция загрузки файла (аплоадер)
 $max_file_size    максимальный размер файла в мегабайтах
 $valid_extensions массив допустимых расширений
 string $upload_dir  директория загрузки
 * @return []      сообщение о ходе выполнения
 */
/* В php скрипте реализованы две проверки:
так как хостер ограничивает размер загружаемого файла (на момент написания данного материала у меня на хостинге стоит ограничение в 8 Mb), то проверка максимального размера необходима;
проверка расширения файла позволяет отсеять ненужные файлы до загрузки.
URL фотографии - $destination.  return $destination  А далее вставляете URL фото куда вам надо */
function upload($max_file_size, $valid_extensions, $upload_dir)
{
    setlocale(LC_ALL, 'ru_RU . UTF8');
    $error = null;
    $info  = null;
    $max_file_size *= 1048576;  // перевод размера файла в b
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK)
    {
        // проверяем расширение файла
        $file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (in_array(strtolower($file_extension), $valid_extensions))
        {
            // проверяем размер файла
            if ($_FILES['file']['size'] < $max_file_size)
            {
                $file = $_FILES["file"]["tmp_name"];
                $myFile_name = $_FILES["file"]["name"];
                $file_type = substr($myFile_name, strrpos($myFile_name, '.')+1);
                $file_name = assignName('big', $file, $file_type);  //
                $destination = $upload_dir .'/' . $file_name;

                if (move_uploaded_file($_FILES['file']['tmp_name'], $destination))
                {
                    $info = 'Файл успешно загружен';
                }
                else
                    $error = 'Не удалось загрузить файл';
            }
            else
                $error = 'Размер файла больше допустимого';
        }
        else
            $error = 'У файла недопустимое расширение';
    }
    else
    {
        // массив ошибок
        $error_values = [

            UPLOAD_ERR_INI_SIZE   => 'Размер файла больше разрешенного директивой upload_max_filesize в php.ini',
            UPLOAD_ERR_FORM_SIZE  => 'Размер файла превышает указанное значение в MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL    => 'Файл был загружен только частично',
            UPLOAD_ERR_NO_FILE    => 'Не был выбран файл для загрузки',
            UPLOAD_ERR_NO_TMP_DIR => 'Не найдена папка для временных файлов',
            UPLOAD_ERR_CANT_WRITE => 'Ошибка записи файла на диск'

        ];

        $error_code = $_FILES['file']['error'];

        if (!empty($error_values[$error_code]))
            $error = $error_values[$error_code];
        else
            $error = 'Случилось что-то непонятное';
    }

    return ['info' => $info, 'error' => $error, 'destination'=>$destination];
}

// Подключение к БД
function connect()
{
    $link = mysqli_connect('127.0.0.1', 'root', '', 'lesson5'); // Открывает новое соединение с сервером MySQL и базой данных .
    if (!$link)
    {
        die('Ошибка подключения (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
    }
    return $link;
}

//Добавить запись в базу данных и назначить имя файлу
function add($table_name, $file_type, $file, $myFile_name)
{
    /* соединение с базой данных */
    $link = connect();
    $file_type = mysqli_real_escape_string($link, $file_type);
    //Добавление записи в базу данных тип файла и временное имя файла на нашем сервере (во время запроса)
    $sql = "INSERT INTO $table_name (type, thumDes, myFile_name) VALUES ('$file_type', '$file', '$myFile_name')";
    mysqli_query($link, $sql);//запрос к базе данных на добавление записи
    //Выборка в таблице id, соответсвующего предыдущей добавленной записи
    $id_find = "SELECT id FROM $table_name WHERE thumDes = '$file'";
    $result = mysqli_query($link, $id_find);//запрос к базе данных
    $row = mysqli_fetch_row($result);
    //Определение значения из массива
    $row = $row[0];
    /* Назначение имени файлу вида "идентификатор.тип" */
    $designation = ($row . '.' . $file_type);
    /* Изменение значения поля designation в таблице на значение вида "идентификатор.тип" */
    $sql = "UPDATE $table_name SET designation='$designation' WHERE id=$row";
    mysqli_query($link, $sql);
    /* закрываем соединение */
    mysqli_close($link);
}
//Добавить запись в базу данных в таблицу small
function addSmall($file_type, $file_name)
{
    /* соединение с базой данных */
    $link = connect();
    $address = ('small_images/' . $file_name);
    $file_type = mysqli_real_escape_string($link, $file_type);
    $file_name = mysqli_real_escape_string($link, $file_name);
    //Добавление записи в базу данных тип файла и временное имя файла на нашем сервере (во время запроса)
    $sql = "INSERT INTO small (type, designation, address) VALUES ('$file_type', '$file_name', '$address')";
    mysqli_query($link, $sql);//запрос к базе данных на добавление записи
    /* закрываем соединение */
    mysqli_close($link);
}
/* Назначение имени файлу вида "идентификатор.тип" */
function assignName($table_name, $file, $file_type)
{
    /* соединение с базой данных */
    $link = connect();
    //Выборка в таблице id, соответсвующего предыдущей добавленной записи
    $id_find = "SELECT id FROM $table_name WHERE thumDes = '$file'";
    $result = mysqli_query($link, $id_find);//запрос к базе данных
    $row = mysqli_fetch_row($result);
    //Определение значения из массива
    $row = $row[0];
    /* Назначение имени файлу вида "идентификатор.тип" */
    $designation = ($row . '.' . $file_type);
    /* очищаем результирующий набор */
    mysqli_free_result($result);
    /* закрываем соединение */
    mysqli_close($link);
    return $designation;
}
//количество кликов по определенному url.
function click($table_name, $id)
{
    /* соединение с базой данных */
    $link = connect();
    /*Увеличиваем количество кликов по определенному url. При этом id указывает на нужную запись.*/
    $update = "UPDATE $table_name SET click = click + 1, designation = designation, thumDes = thumDes, typ = typ WHERE designation='$id'";
    /*Все значения кроме id в этом запросе переназначаются. Таким образом, не нужно вставлять новый id, для нового url.*/
    mysqli_query($link, $update);
    //Теперь достаем url и делаем туда редирект
    $query = "SELECT * FROM $table_name WHERE designation='$id'";
    $result = mysqli_query($link, $query);
    $tab = mysqli_fetch_array($result);
    $url = $tab["url"];
    /* очищаем результирующий набор */
    mysqli_free_result($result);
    /* закрываем соединение */
    mysqli_close($link);
    header("location: $url");
}
/*Получить количество просмотров фотографии*/
function getClicks($id)
{
    /* соединение с базой данных */
    $link = connect();
    //Выборка в таблице address
    $id_find = "SELECT click FROM big WHERE designation='$id'";
    $result = mysqli_query($link, $id_find);//запрос к базе данных
    $row = mysqli_fetch_array($result);
    $row = $row[0];
    /* очищаем результирующий набор */
    mysqli_free_result($result);
    /* закрываем соединение */
    mysqli_close($link);
    return $row;
}
/*Получить список фото*/
function getList ()
{
    /* соединение с базой данных */
    $link = connect();
    //Выборка в таблице big
    $id_find = "SELECT designation, myFile_name FROM big ORDER BY click DESC ";
    $result = mysqli_query($link, $id_find);//запрос к базе данных
    /* выборка данных и помещение их в массив */
    while ($row = mysqli_fetch_row($result))
    {
        printf ("%s (%s)<br>", $row[0], $row[1]);
    }
}


