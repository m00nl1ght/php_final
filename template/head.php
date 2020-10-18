<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include $_SERVER['DOCUMENT_ROOT'] . '/inc/helpers.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/sql_connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/inc/product.php';

$sql = mainSqlString($_SERVER['REQUEST_URI'], $_GET);
$products = getProduct($sql);
$minmaxPrice = minmax($products);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Fashion</title>

  <meta name="description" content="Fashion - интернет-магазин">
  <meta name="keywords" content="Fashion, интернет-магазин, одежда, аксессуары">

  <meta name="theme-color" content="#393939">

  <link rel="preload" href="/resources/img/intro/coats-2018.jpg" as="image">
  <link rel="preload" href="/resources/fonts/opensans-400-normal.woff2" as="font">
  <link rel="preload" href="/resources/fonts/roboto-400-normal.woff2" as="font">
  <link rel="preload" href="/resources/fonts/roboto-700-normal.woff2" as="font">

  <link rel="icon" href="/resources/img/favicon.png">
  <link rel="stylesheet" href="/resources/css/style.min.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="/resources/js/scripts.js" defer=""></script>
  <script src="/resources/js/app.js" defer></script>
</head>
<body>