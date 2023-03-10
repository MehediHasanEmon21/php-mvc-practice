<?php

namespace app\core;

class Router {


    private array $routes = [];
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $uri, callable|string|array $action)
    {
        $this->routes['get'][$uri] = $action;
    }

    public function post(string $uri, callable|string|array $action)
    {
        $this->routes['post'][$uri] = $action;
    }

    public function resolve()
    {   
        $uri = $this->request->getPath();
        $method = $this->request->method();

        $callback = $this->routes[$method][$uri] ?? false;

        if($callback == false){
            $this->response->setStatusCode(404);
            echo 'Not Found';
            exit;
        }

        if(is_string($callback)){
            return $this->renderView($callback);
            
        }

        if(is_array($callback)){
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->request);

    }

    public function renderView($view, $params = [])
    {   
        
        $layoutContent = $this->renderLayoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }



    public function renderLayoutContent()
    {   
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function renderOnlyView(string $view, array $params)
    {   
        foreach($params as $key=>$value){
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR. "/views/$view.php";
        return ob_get_clean();
    }

}