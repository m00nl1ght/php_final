<?php

class Db {

    public static function getConnection() {
        $config = include $_SERVER["DOCUMENT_ROOT"] . '/config/db_params.php';
        
        $connect = new PDO(
            'mysql:dbname=' . $config['db'] . ';host=' . $config['server'], 
            $config['user'], 
            $config['password']
        );

        return $connect;
    }


    public static function validatePicture() {
        $config = include $_SERVER['DOCUMENT_ROOT'] . '/config/pic_download.php';
        $messages = [];

        if( isset($_FILES)) {
            $total_files = count($_FILES);

            if(empty($_FILES['product-photo']['name'])) {
                $messages['error'] = "Вы не выбрали ни одного файла!";
            } elseif($total_files > $config['max_file_count']) {
                $messages['error'] = "Вы можете загрузить не более " . $config['max_file_count'] . " файла за раз!";   
            } else {
                // Check if file is selected
                if(isset($_FILES['product-photo']['name']) && $_FILES['product-photo']['size'] > 0) {
                    $fileType = mime_content_type($_FILES['product-photo']['tmp_name']);

                    if($_FILES['product-photo']['size'] > $config['max_file_size']){ // check size
                        $messages['error'] = "Размер " . $_FILES['product-photo']["name"] . "не должен превышать 5 мегабайт";

                    }elseif( !in_array( $fileType, $config['allowed_types'])) { // check extension and upload
                        $messages['error'] = "Файл " . $_FILES['product-photo']["name"] .  " не картинка. Разрешенные форматы " . implode(', ', $config['allowed_types']);
                            
                    } else {
                        $messages['success'] = true;

                    }       
                }
         
            } 
        }

        return $messages;
    }

    public static function validateName($name) {
        $messages = [];

        if ($name == '') {
            $messages['error'] = "Поле название не может быть пустым!";
        } else {
            $messages['success'] = true;
        }

        return $messages;
    }

    public static function validatePrice($price) {
        $messages = [];

        if ($price == '') {
            $messages['error'] = "Поле цены не может быть пустым!";
        } else {
            $messages['success'] = true;
        }

        return $messages;
    }

    public static function validateCategory($data) {
        $messages = [];

        if (!isset($data['category'])) {
            $messages['error'] = "Не выбрана ни одна из категорий";
        } else {
            $messages['success'] = true;
        }

        return $messages;
    }

}