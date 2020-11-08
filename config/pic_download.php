<?php

return [
    'directory' => $_SERVER['DOCUMENT_ROOT'] . '/resources/img/products/',
    'max_file_size' => 5 * 1024 * 1024,
    'allowed_types'=> ['image/jpg', 'image/jpeg', 'image/png', 'image/bmp'],
    'max_file_count' => 1
];

// $directory = $_SERVER['DOCUMENT_ROOT'] . '/files/';    // Папка с изображениями
// $maxFileSize = 5 * 1024 * 1024; //5MB
// $allowed_types=['image/jpg', 'image/jpeg', 'image/png', 'image/bmp'];  //разрешеные типы изображений
// $maxFileCount = 5;


