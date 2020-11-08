<?php

class Category {

    public static function getCategory() {
        $pdo = DB::getConnection();

        $stmt = $pdo->query("SELECT * FROM categories"); 
        $categoryArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $categoryArr;
    }

    public static function getCategoryByProductId($id) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare(
            "SELECT categories.id, categories.name 
            FROM categories 
            JOIN category_product ON category_product.category_id = categories.id
            WHERE category_product.product_id = ?");

        $stmt->execute([$id]);
        
        $categoryArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $categoryArr;
    }

    public static function insertCategoryProduct($category_id, $product_id) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare(
            "INSERT category_product (category_id, product_id)
            VALUES (:category, :product);"
        );

        $stmt->execute([
            ':category' => $category_id,
            ':product' => $product_id
        ]);

        return $stmt;
    }

    public static function destroyCategoryProduct($category_id, $product_id) {
        $pdo = DB::getConnection();

        $stmt = $pdo->prepare("DELETE FROM category_product WHERE category_id = ? AND product_id = ?");

        $stmt->execute([$category_id, $product_id]);

        return $stmt;
    }

}