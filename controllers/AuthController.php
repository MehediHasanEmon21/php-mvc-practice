<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller {

    public function login(Request $request)
    {   
        $loginForm = new LoginForm();

        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login',[
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {      
        $user = new User();

        if($request->isPost()){
            
            $user->loadData($request->getBody());

            if($user->validate() && $user->save()){
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
            }
            


        }
        
        $this->setLayout('auth');
        return $this->render('register',[
            'model' => $user
        ]);
    }

    public function logout(Request $request)
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }

}