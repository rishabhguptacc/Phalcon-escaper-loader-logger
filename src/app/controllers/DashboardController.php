<?php

use Phalcon\Mvc\Controller;

class DashboardController extends Controller
{

    public function indexAction()
    {
        echo 'inside Dashboard controller! \n'; // won't show this line as view/dashboard/index.phtml will get the priority over here.
        //return '<h1>Inside indexAction()...!!!</h1>';
    }

}
