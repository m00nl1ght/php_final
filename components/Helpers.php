<?php

Class Helpers {

    public static function plural_form($number, $after) {
        $cases = array (2, 0, 1, 1, 1, 2);
        return $number.' '.$after[ ($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min( $number % 10, 5)] ];
    }

    static public function pathUrlArr() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        return explode('/', $url);
    }

    public static function minmaxPrice($array) {
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

    public static function isCurrentUrl($url) {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $url;
    }


    public static function sortArr($key) {
        return function ($a, $b) use ($key) {
            return strnatcmp($a[$key], $b[$key]);
        };
    }

    public static function pageCount($items, $itemsPerPage) {
        $pages = intdiv($items, $itemsPerPage);

        if ($items % $itemsPerPage == 0) {
            return $pages;
        } else {
            $pages++;
            return $pages;
        }
    }
    
}
