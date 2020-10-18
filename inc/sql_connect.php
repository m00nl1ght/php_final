<?php

function getConnection() {
    include $_SERVER["DOCUMENT_ROOT"] . '/keys/sql.php';

    $link = mysqli_connect($SQL_SERVER, $SQL_USER, $SQL_PASSWORD, $SQL_DB);

    if($link) {
       return $link;
    } else {
        echo "Ошибка подключения к базе данных";
    }
}