<?php

function getCategory() {
    $link = getConnection();
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($link, $sql);

    $categoryArr = [];
    while($row = mysqli_fetch_array($result)){
        $categoryArr[] = $row;
    }
    return $categoryArr;
}

function categoryList($categoryArr) {
    foreach($categoryArr as $row) {
        include $_SERVER["DOCUMENT_ROOT"] . '/template/category_item.php';
    }
}