<?php
/**
 * Created by PhpStorm.
 * User: adriannaszadkowska
 * Date: 09/07/2019
 * Time: 20:32
 */

class Application
{
    protected $controller = 'homeController';
    protected $action = 'index';
    protected $prams = [];

    public function __construct()
    {
        $this->prepareURL();
        //echo $this->controller . ' ' .$this->action;

        if (file_exists(CONTROLLER. $this->controller . '.php')){
            $this->controller = new $this->controller;
            if (method_exists($this->controller, $this->action)) {
                call_user_func_array([$this->controller, $this->action], $this->prams);
            }
            //$this->controller->index();
        }
    }

    protected function prepareURL()
    {
        $request = trim($_SERVER['REQUEST_URI'], '/');
        if(!empty($request)){
            $url = explode('/', $request);
            $this->controller = isset($url[0]) ? $url[0].'Controller' : 'homeController';
            $this->action = isset($url[1]) ? $url[1]: 'index';
            unset($url[0], $url[1]);
            $this->prams = !empty($url) ? array_values($url) : [];
            var_dump($url);
        }
    }
}