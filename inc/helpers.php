<?php

function isCurrentUrl($url) {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $url;
}

function makeSqlString($arr, $where = false) {
    $string = '';

    for($i = 1; $i <= count($arr); $i++) {
        if($i == 1 && $where) {
            $string = $string . 'WHERE ' . $arr[$i-1];
        } else {
            $string = $string . ' AND ' . $arr[$i-1];
        }
    } 

    return $string;
};

function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}

function sortArr($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp($a[$key], $b[$key]);
    };
}

function minmax($array) {
    $min = PHP_INT_MAX;
    $max = 0;

    foreach ($array as $arr) {
        $min = min($min, $arr['price']);
        $max = max($max, $arr['price']);
    };

    $arr = [
        'min' => $min,
        'max' => $max
    ];

    return $arr;
}

function filterSqlSrting($incomePost) {
    $stringArr = [];

    $stringArr[] = 'price >= ' . $incomePost['filterMin'];
    $stringArr[] = 'price <= ' . $incomePost['filterMax'];
    
    if($incomePost['filterNew']) {
        $stringArr[] = 'new = true';
    }
    if($incomePost['filterSale']) {
        $stringArr[] = 'sale = true';
    }
    
    if($incomePost['filterCategoryUrl'] !== '/') {
        $stringArr[] = 'categories.url = "' . $incomePost['filterCategoryUrl'] . '"';
    
        $sql = "SELECT products.* FROM products JOIN category_product ON category_product.product_id = products.id
        JOIN categories ON categories.id = category_product.category_id " . makeSqlString($stringArr, true);
    } else {
        $sql = "SELECT products.* FROM products " . makeSqlString($stringArr, true);
    }

    return $sql;
}

function mainSqlString($url, $getArr) {
    $categoryUrl = parse_url($url, PHP_URL_PATH);
    $stringArr = [];
  
    if(isset($getArr['filter'])) {
      $stringArr[] = $getArr['filter'] . '= true';
    }
  
    if($categoryUrl !== '/') {
      $stringArr[] = 'categories.url = "' . $categoryUrl . '"';
  
      $sql = "SELECT products.* FROM products JOIN category_product ON category_product.product_id = products.id
      JOIN categories ON categories.id = category_product.category_id " . makeSqlString($stringArr, true);
    } else {
        $sql = "SELECT products.* FROM products " . makeSqlString($stringArr, true);
    }
  
    return $sql;
  }