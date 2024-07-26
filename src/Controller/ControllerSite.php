<?php

namespace App\Controller;

use App\Classes\Alert;
use App\Classes\Page;
use App\Classes\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControllerSite
{

    public function login(Request $request, Response $response, array $args)
    {

        $method = $request->getMethod();

        if($method === 'GET') {

            $page = new Page(['header' => false, 'footer' => false]);
            
            $page->setTpl('login', array(
                'error' => Alert::getError(), 
                'sucess' => Alert::getSucess(),
                'warning' => Alert::getWarning()
            ));
    
            exit;

        } else if($method === 'POST') {

            $user = new User();

            $usuario_email = isset($_POST['email']) ? $_POST['email'] : NULL;
            $usuario_senha = isset($_POST['senha']) ? $_POST['senha'] : NULL;

            try {
                
                $user->login($usuario_email, $usuario_senha);

                Alert::setSucess('Login realizado com sucesso.');

            } catch (\Throwable $erro) {
                
                Alert::setError($erro->getMessage());
            }

            header('Location: /login');

            exit;
        }
    }

    public function forgotPassword(Request $request, Response $response, array $args)
    {

        $method = $request->getMethod();

        if($method === 'GET') {

            $page = new Page(['header' => false, 'footer' => false]);
            
            $page->setTpl('forgot', array(
                'error' => Alert::getError(), 
                'sucess' => Alert::getSucess(),
                'warning' => Alert::getWarning()
            ));
    
            exit;

        } else if($method === 'POST') {


        }
    }
}