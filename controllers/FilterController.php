<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/models/Product.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/models/Category.php';

class FilterController {

    public function index() {
        $incomePost = json_decode(file_get_contents('php://input'), true);

        $products = Product::getProductByFilter($incomePost);

        include $_SERVER["DOCUMENT_ROOT"] . '/view/layout/shop_wrapper.php';

        return true;
    }

    public function sort() {
        $incomePost = json_decode(file_get_contents('php://input'), true);

        $products = Product::getProductByFilter($incomePost);
        $key = $incomePost['sortCategory'];

        usort($products, Helpers::sortArr($key));
    
        if($incomePost['sortPrice'] == 'down') {
            $products = array_reverse($products);
        }

        include $_SERVER["DOCUMENT_ROOT"] . '/view/layout/product_wrapper.php';

        return true;
    }

    public function new() {
        $config = include $_SERVER["DOCUMENT_ROOT"] . '/config/admin_settings.php';

        $categories = Category::getCategory();
        $products = Product::getNewProduct();
        $minmaxPrice = Helpers::minmaxPrice($products);
        $productCount = Helpers::plural_form( count($products), array('модель','модели','моделей') );
        $pageCount = Helpers::pageCount( count($products), $config['products_by_page']);
        $pageId = 1;

        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/product.php';

        return true;
    }

    public function sale() {
        $config = include $_SERVER["DOCUMENT_ROOT"] . '/config/admin_settings.php';

        $categories = Category::getCategory();
        $products = Product::getSaleProduct();
        $minmaxPrice = Helpers::minmaxPrice($products);
        $productCount = Helpers::plural_form( count($products), array('модель','модели','моделей') );
        $pageCount = Helpers::pageCount( count($products), $config['products_by_page']);
        $pageId = 1;

        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/product.php';

        return true;
    }

}