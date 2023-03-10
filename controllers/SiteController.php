<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller {

    public function contact()
    {   
        $data = [
            'name' => 'Hello'
        ];
        return $this->render('contact', $data);
    }

    public function home()
    {   
        
        return $this->render('home');
    }

}