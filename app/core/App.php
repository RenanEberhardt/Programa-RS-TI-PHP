<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        // Parse url into readable string
        $url = $this->parseUrl();
        // /public/index.php?url=Cidade/getCidades/23
        // Cidade => Controller
        // getCidades => Method
        // 23 => Param1

        // Get controller
        if (isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        // If controller (url[0]) doesn't exist it will use 'home' automatically
        require_once '../app/controllers/' . $this->controller . '.php';

        // Create a new instance of the controller
        $this->controller = new $this->controller;

        // Get method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get parameters
        $this->params = $url ? array_values($url) : [];

        // Calls the specific controller, method and pass the parameters to them
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Parse url  into useable array
    private function parseUrl() {
        if (isset($_SERVER['PATH_INFO']))
            return explode('/', filter_var(trim($_SERVER['PATH_INFO'], '/'), FILTER_SANITIZE_URL));
    }
}

?>