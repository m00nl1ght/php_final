<?php

class Product {

    public static function getProduct() {
        $pdo = DB::getConnection();

        $stmt = $pdo->query("SELECT * FROM products");  
        $productArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $productArr;
    }


    public static function getProductByCategory($categoryId) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare("SELECT products.* FROM products JOIN category_product ON category_product.product_id = products.id
        JOIN categories ON categories.id = category_product.category_id WHERE categories.id = ?");

        $stmt->execute([$categoryId]);          
        $productArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $productArr;
    }


    public static function getProductById($id) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM products WHERE products.id = ?");
        $stmt->execute([$id]);
            
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public static function store($params) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare(
            "INSERT products (name, price, img, new, sale)
            VALUES (:name, :price, :img, :new, :sale);"
        );

        $stmt->execute([
            ':name' => $params['name'],
            ':price' => $params['price'],
            ':new' => $params['new'],
            ':sale' => $params['sale'],
            ':img' => $params['img']
        ]);

        if($stmt) {
            $id = $pdo->lastInsertId();
            return $id;
        }
       
        return false;
    }

    public static function update($id, $params) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare(
        "UPDATE products SET 
            name = :name,
            price = :price,
            new = :new,
            sale = :sale
        WHERE id = :id
        ");

        $stmt->execute([
            ':name' => $params['name'],
            ':price' => $params['price'],
            ':new' => $params['new'],
            ':sale' => $params['sale'],
            ':id' => $id
        ]);

        return $stmt;
    }


    public static function destroy($id) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare("DELETE FROM products WHERE products.id = ?");

        $stmt->execute([$id]);

        return $stmt;
    }

    public static function uploadProductPhoto() {
        $config = include $_SERVER['DOCUMENT_ROOT'] . '/config/pic_download.php';

        $original_filename = $_FILES['product-photo']["name"];
        $target = $config['directory'] . time() . basename($original_filename);
        $tmp  = $_FILES['product-photo']['tmp_name'];

        move_uploaded_file($tmp, $target);

        return $target;
    }

    public static function getProductByFilter($arr) {
        $sqlArr = [];
        $sqlStringPrepare = '';
        $sql = '';

        $sqlArr[] = $arr['filterMin'];
        $sqlStringPrepare = $sqlStringPrepare . 'price >= ? ';

        $sqlArr[] = $arr['filterMax'];
        $sqlStringPrepare = $sqlStringPrepare . 'AND price <= ? ';

        if ($arr['filterNew']) {
            $sqlArr[] = '1';
            $sqlStringPrepare = $sqlStringPrepare . 'AND new = ? ';
        }

        if ($arr['filterSale']) {
            $sqlArr[] = '1';
            $sqlStringPrepare = $sqlStringPrepare . 'AND sale = ? ';
        }
        
        if ($arr['filterCategoryUrl'] == '/') {
            $sql = "SELECT products.* FROM products WHERE " . $sqlStringPrepare;
        } else {
            $sqlStringPrepare = $sqlStringPrepare . 'AND categories.id = ? ';

            $sqlArr[] = explode('/', $arr['filterCategoryUrl'])[2];

            $sql = "SELECT products.* FROM products JOIN category_product ON category_product.product_id = products.id
            JOIN categories ON categories.id = category_product.category_id WHERE " . $sqlStringPrepare;
        }

        $pdo = DB::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($sqlArr);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    
    public static function getNewProduct() {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM products WHERE new = 1;");
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }

    public static function getSaleProduct() {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM products WHERE sale = 1;");
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }
}