<?php

function getProduct($sql) {
    $link = getConnection();

    $result = mysqli_query($link, $sql);

    $productArr = [];

    if($result) {
        while($row = mysqli_fetch_array($result)){
            $productArr[] = $row;
        }
    }

    return $productArr;
}

function productList($productArr) {
    foreach($productArr as $row) {
        include $_SERVER["DOCUMENT_ROOT"] . '/template/product_item.php';
    }
}
