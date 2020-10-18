<?php
include $_SERVER['DOCUMENT_ROOT'] . '/inc/sql_connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/product.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.php';

$incomePost = json_decode(file_get_contents('php://input'), true);

$sql = filterSqlSrting($incomePost);
$products = getProduct($sql);

if(isset($incomePost['sortCategory']) && isset($incomePost['sortPrice'])) {
    $key = $incomePost['sortCategory'];

    usort($products, sortArr($key));

    if($incomePost['sortPrice'] == 'down') {
        $products = array_reverse($products);
    }

    return productList($products);
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/template/shop_wrapper.php';
}

