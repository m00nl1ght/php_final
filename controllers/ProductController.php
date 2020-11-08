<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/models/Product.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/models/Category.php';

class ProductController {

    public function index() {
        $config = include $_SERVER["DOCUMENT_ROOT"] . '/config/admin_settings.php';

        $categories = Category::getCategory();
        $products = Product::getProduct();
        $minmaxPrice = Helpers::minmaxPrice($products);
        $productCount = Helpers::plural_form( count($products), array('модель','модели','моделей') );
        $pageCount = Helpers::pageCount( count($products), $config['products_by_page']);
        $pageId = 1;

        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/product.php';

        return true;
    }

    public function category($categoryId) {

        $categories = Category::getCategory();
        $products = Product::getProductByCategory($categoryId);
        $minmaxPrice = Helpers::minmaxPrice($products);

        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/product.php';

        return true;
    }

    public function adminIndex() {
        $adminProductPage = true;
        $products = Product::getProduct();

        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/admin_product.php';

        return true;
    }

    public function create() {
        $adminProductCreatePage = true;
        $category = Category::getCategory();
        
        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/admin_product.php';

        return true;
    }

    public function store() {

        if (isset($_POST)) {
            $validatePic = Db::validatePicture();
            $validateName = Db::validateName($_POST['product-name']);
            $validatePrice = Db::validatePrice($_POST['product-price']);
            $validateCategory = Db::validateCategory($_POST);

            if(isset($validatePic['success']) && isset($validateName['success']) && isset($validatePrice['success']) && isset($validateCategory['success'])) {
                $productPhotoUrl = Product::uploadProductPhoto();

                $product = [
                    'name' => $_POST['product-name'],
                    'price' => $_POST['product-price'],
                    'img' => substr($productPhotoUrl, strlen($_SERVER["DOCUMENT_ROOT"])),
                    'new' => ( isset($_POST['new']) ) ? 1 : 0,
                    'sale' => ( isset($_POST['sale']) ) ? 1 : 0
                ];

                $productId = Product::store($product);

                if ( $productId !== false ) {
                    foreach($_POST['category'] as $categoryId) {
                        Category::insertCategoryProduct((int)$categoryId, (int)$productId);
                    }

                    echo 'success';
                } else {
                    echo ('Что-то пошло не так, попробуйте еще раз!');
                }

            } else {
                if(isset($validatePic['error'])) {
                    echo $validatePic['error'];
                }

                if(isset($validateName['error'])) {
                    echo $validateName['error'];
                }

                if(isset($validatePrice['error'])) {
                    echo $validatePrice['error'];
                }

                if(isset($validateCategory['error'])) {
                    echo $validateCategory['error'];
                }
            }

        } else {
            echo ('Что-то пошло не так, попробуйте еще раз!');
        }

        return true;
    }

    public function edit($id) {
        $adminProductEditPage = true;

        $product = Product::getProductById($id);
        $allCategory = Category::getCategory();
        $categoryChecked = Category::getCategoryByProductId($id);

        $category = [];

        foreach ($allCategory as $data) {
            foreach ($categoryChecked as $checked) {
                if ($data['id'] == $checked['id']) {
                    $data['checked'] = true;   
                }
            }
            $category[] = $data;
        }

        include_once $_SERVER["DOCUMENT_ROOT"] . '/view/admin_product.php';

        return true;
    }

    public function update() {
        $product = [
            'name' => $_POST['product-name'],
            'price' => $_POST['product-price'],
            // 'img' => substr($productPhotoUrl, strlen($_SERVER["DOCUMENT_ROOT"])),
            'new' => ( isset($_POST['new']) ) ? 1 : 0,
            'sale' => ( isset($_POST['sale']) ) ? 1 : 0
        ];

        $result = Product::update($_POST['product-id'], $product);

        $allCategory = Category::getCategory();
        $productHasCategory = Category::getCategoryByProductId($_POST['product-id']);
        $userSelectCategory = $_POST['category'];

        foreach ($allCategory as $all) {
            $hasServer = false;
            $selectClient = false;

            foreach ($productHasCategory as $server) {
                if ($all['id'] == $server['id']) {
                    $hasServer = true;
                }
            }

            foreach ($userSelectCategory as $select) {
                if ($all['id'] == $select) {
                    $selectClient = true;
                }
            }

            if (!$hasServer && $selectClient) {
                Category::insertCategoryProduct($all['id'], $_POST['product-id']);
            }

            if ($hasServer && !$selectClient) {
                Category::destroyCategoryProduct($all['id'], $_POST['product-id']);
            }
        }
        
        echo 'success';

        return true;
    }

    public function destroy() {
        $incomePost = json_decode(file_get_contents('php://input'), true);

        $result = Product::destroy($incomePost['id']);

        echo var_dump($result);
        
        return true;
    }

}