<?php

namespace App;

class Easy_Slider {
    
    public function __construct()
    {
        new Activation;
    }
    
    public function view(string $view, array $params = []) {
        if (strpos($view, '.') === false) {
            $view .= '.php';
        }
    
        $viewPath = __DIR__ . '/../views/' . $view;
    
        if (file_exists($viewPath)) {
            extract($params);
            include $viewPath;
        } 
    }
}