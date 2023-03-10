<?php

namespace app\core;

class Application {

    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Controller $controller;
    public Database $db;
    public ?DbModel $user;

    public static Application $app;
    public static $ROOT_DIR;
    public string $userClass;

    public function __construct($rootPath, $config)
    {  
       $this->user = null;
       $this->userClass = $config['userClass'];
       self::$app = $this;
       self::$ROOT_DIR = $rootPath; 
       $this->request = new Request(); 
       $this->response = new Response();
       $this->session = new Session();
       $this->db = new Database($config['db']);
       $this->router = new Router($this->request, $this->response);
       
       $userId = Application::$app->session->get('user');
        if ($userId) {
            $key = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$key => $userId]);
        }
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $value = $user->{$primaryKey};
        Application::$app->session->set('user', $value);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        self::$app->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
    
}