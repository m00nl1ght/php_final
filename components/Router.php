<?php

class Router {

    private $routes;

    public function __construct() {
        $routesPath = $_SERVER["DOCUMENT_ROOT"] . '/config/routes.php';
        $this->routes = include ($routesPath);
    }

    /**
     * Returns request string
     */
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {
        $uri = $this->getURI();
    
        //проверка в routes.php
        foreach ($this->routes as $uriPattern => $path) {    
            if (preg_match( "~$uriPattern~", $uri )) {
                $internalRoute = preg_replace( "~$uriPattern~", $path, $uri );

                //определение контроллера и действия
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = array_shift($segments);
                $parameters = $segments;

                //подключить файл контроллера
                $controllerFile = $_SERVER["DOCUMENT_ROOT"] . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once ($controllerFile);
                }

                //вызвать метод контроллера
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
               
                if ($result != null) {
                    break;
                }
            }
        }
    }
}