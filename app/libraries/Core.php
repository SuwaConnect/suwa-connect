<?php

class Core {

    protected $currentController = 'doctor';
    protected $currentMethod = 'home';
    protected $params = [];

    public function __construct(){
        
        $url = $this->getUrl();
        #print_r($url);
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
        {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);

            //call the controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            //instantiate controller
            $this->currentController = new $this->currentController;

            //check if method exists
            if(isset($url[1]))
            {
                if(method_exists($this->currentController, $url[1]))
                {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //get params
            $this->params = $url ? array_values($url) : [];

            //call method and pass in params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }
    }

    public function getURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
    }

    
}
}