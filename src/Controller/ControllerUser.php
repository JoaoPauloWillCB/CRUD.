<?php

namespace App\Controller;

use App\Classes\Alert;
use App\Classes\Page;
use App\Classes\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControllerUser 
{

    public function registration(Request $request, Response $response, array $args)
    {

        $user = new User();

        $method = $request->getMethod();

        if($method === 'GET') {

            $page = new Page(['header' => false, 'footer' => false]);
            
            $page->setTpl('register', array(
                'error' => Alert::getError(), 
                'sucess' => Alert::getSucess(),
                'warning' => Alert::getWarning()
            ));
    
            exit;

        } else if($method === 'POST') {
            
            $usuario_nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;
            $usuario_email = isset($_POST['email']) ? $_POST['email'] : NULL;
            $usuario_senha = isset($_POST['senha']) ? $_POST['senha'] : NULL;

            try {

                $user->userRegistration($usuario_nome, $usuario_email, $usuario_senha);

                Alert::setSucess('Cadastro realizado com sucesso.');

                header('Location: /login');

                exit;
                
            } catch (\Throwable $erro) {
                
                Alert::setError($erro->getMessage());
            }

            header('Location: /registration');
    
            exit;
        }
    }

    public function userList(Request $request, Response $response, array $args)
    {

        $user = new User();

        $user->verifyLogin();

        $usuarios = $user->getUsers();

        $page = new Page(['header' => true, 'footer' => true]);

        $page->setTpl('user/userList', array(
            'error' => Alert::getError(), 
            'sucess' => Alert::getSucess(),
            'warning' => Alert::getWarning(),
            'usuarios' => $usuarios
        ));

        exit;
    }
}