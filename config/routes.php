<?php

return [
    'admin/orders/status' => 'order/status',
    'admin/orders' => 'order/adminIndex',

    'admin/products/create' => 'product/create',
    'admin/products/store' => 'product/store',
    'admin/products/update' => 'product/update',
    'admin/products/destroy' => 'product/destroy',
    'admin/products/edit/([0-9]+)' => 'product/edit/$1',
    'admin/products' => 'product/adminIndex',
    'admin' => 'admin/index',

    'orders/store' => 'order/store',
    'orders' => 'orders/list',

    'filter/sort' => 'filter/sort',
    'filter/new' => 'filter/new',
    'filter/sale' => 'filter/sale',
    'filter' => 'filter/index',

    'category/([0-9]+)' => 'product/category/$1',
    '' => 'product/index'
];

// 'admin/products/([0-9]+)' => 'product/view/$1',
// 'admin/products/create' => 'product/create',
// 'admin/products/store' => 'product/store',
// 'admin/products/edit/([0-9]+)' => 'product/edit/$1',
// 'admin/products/destroy/([0-9]+)' => 'product/destroy/$1',
// 'admin/products' => 'product/list',


// (GET) /products - отображение товаров
// (GET) /products?id=5 - отображение 5-ой страницы товаров
// (GET) /products/create - отображение формы добавления товара
// (POST) /products/store - сохранение товара из формы добавления
// (GET) /products/edit/15 - отображение формы редактирования товара с id=15
// (POST) /products/update - сохранение товара из формы редактирования
// (POST) /products/destroy - удаление товара по его идентификатору в базе