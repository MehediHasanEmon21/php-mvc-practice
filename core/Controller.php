<?php

namespace app\core;

class Controller {

    public $layout = 'main';

    public function render($viewName, $params = [])
    {

        return Application::$app->router->renderView($viewName, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    
}