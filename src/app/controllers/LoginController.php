<?php

use Phalcon\Mvc\Controller;
// use MyApp\Models\Users;



class LoginController extends Controller
{
    public function indexAction()
    {
        //return '<h1>Inside indexAction()...!!!</h1>';
    }

    public function loginUserAction()
    {

                // $value = $this->cookies->get('remember-me')->getValue();

                // // print_r(var_dump($value));
                // if ($value != null) {
                //     /**
                //      * Fetching values from cookies set by the user!
                //      */
                //     $value = $this->cookies->get('remember-me')->getValue();
                //     $cred = json_decode($value);
                //     $ckName = $cred->name;
                //     $ckPassword = $cred->password;

                //     $data=Users::find("name = '$ckName'");
                
                //     $dbId = $data[0]->id;
                //     $dbName = $data[0]->name;
                //     $dbEmail = $data[0]->email;
                //     $dbPassword = $data[0]->password;

                // } else {
                /**
             * Fetching values from Login form filled by the user!
             */
            $name = $this->request->getPost('name');
            // $password = $this->request->getPost('password');
            $rememberMe = $this->request->getPost('rememberme');


            // $data = Users::find(
            //     [
            //         'name' => $name
            //     ]
            // );
            $data=Users::find("name = '$name'");
            // echo "<pre>";
            // print_r($data[0]->name);
            $dbId = $data[0]->id;
            $dbName = $data[0]->name;
            $dbEmail = $data[0]->email;
            $dbPassword = $data[0]->password;
        // }


        
       
        // if ($ckName == $dbName && $ckPassword == $dbPassword) {

        //     $this->session->set('name', $ckName);
        //     $this->session->set('password', $ckPassword);
        //     $this->session->set('rememberme', $rememberMe);


           
            
        //     $this->response->redirect('dashboard/');

        // } else
        
        if ($name == $dbName) {
            echo 'logged in!';

            // $this->session->set('name', $name);
            // $this->session->set('password', $password);
            // $this->session->set('rememberme', $rememberMe);


            // echo '<pre>';
            // print_r($this->session->name);
            // die;
            $this->logger->info("User logged in!");
            
            $this->response->redirect('dashboard/');
        } else {
            // $response->setStatusCode(403, 'Forbidden');
            // $response->setContent("Sorry, Authentication Failed");
            // $response->send();
            $this->logger->error("oops... can't' login.");
            
            $this->response->setStatusCode(403, 'Forbidden');
            $this->response->setContent("Sorry, Authentication Failed");
            $this->response->send();
            die();
        }

        // print_r($data);
        // echo $data[0];
        // die();
    }
}
