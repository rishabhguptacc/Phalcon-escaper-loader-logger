<?php

use Phalcon\Mvc\Controller;
use App\Component\Myescaper;

class SignupController extends Controller{

    public function IndexAction(){

    }

    public function registerAction(){
        $user = new Users();
        
        $myescaper = new Myescaper();

        // $myescaper->sanitize();
        $name = $this->request->getPost("name");
        $email = $this->request->getPost('email');

        // print_r($myescaper->sanitize($name));

        // die;

        $data = array("name" =>  $myescaper->sanitize($name), "email" => $myescaper->sanitize($email));

        $user->assign(
            $data,
            [
                'name',
                'email'
            ]
        );

        $success = $user->save();

        $this->view->success = $success;

        // $this->logger->error($success);

        if ($success) {
            $this->view->message = "Register succesfully";
        } else {
            $this->view->message = "Not Register succesfully due to following reason: <br>".implode("<br>", $user->getMessages());
        }
    }
}
