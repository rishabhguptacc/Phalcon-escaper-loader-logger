<?php

use Phalcon\Mvc\Controller;


class ConfigDbController extends Controller
{
    // public function indexAction()
    // {
        
        
    //     // return '<h1>Hello World!</h1>';
    // }

    public function dbconfigAction()
    {
        $config = $this->di->get("config");
        $this->view->appName = $config->get("db")->get("name");
        $this->view->appVersion = $config->get("db")->get("version");
        $this->view->host = $config->db->host;
        $this->view->username = $config->db->username;

        $this->view->dbname = $config->path('db.dbname');

    }
}
