<?php

namespace App\Controller;

use App\Classes\Alert;
use App\Classes\Client;
use App\Classes\Page;
use App\Classes\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControllerClient
{

    public function clientRegister(Request $request, Response $response, array $args)
    {

        $user = new User();

        $user->verifyLogin();

        $method = $request->getMethod();

        if($method === 'GET') {

            $page = new Page(['header' => true, 'footer' => true]);
            
            $page->setTpl('client/clientRegister', array(
                'error' => Alert::getError(), 
                'sucess' => Alert::getSucess(),
                'warning' => Alert::getWarning()
            ));
    
            exit;

        } else if($method === 'POST') {

            $client = new Client();

            $nome = !empty($_POST['nome']) ? $_POST['nome'] : NULL;
            $cpf = !empty($_POST['cpf']) ? $_POST['cpf'] : '';
            $celular = !empty($_POST['celular']) ? $_POST['celular'] : '';
            $descricao = $_POST['descricao'];

            try {
                
                $client->clientRegister($nome, $cpf, $celular, $descricao);

                Alert::setSucess('Cliente cadastrado com sucesso.');


            } catch (\Throwable $erro) {
               
                Alert::setError($erro->getMessage());
            }

            header('Location: /client/register');

                exit;
        }
    }

    public function clientList(Request $request, Response $response, array $args)
    {

        $user = new User();

        $client = new Client();

        $user->verifyLogin();

        $clientes = $client->getClientes();
        
        $page = new Page(['header' => true, 'footer' => true]);
            
        $page->setTpl('client/clientList', array(
            'error' => Alert::getError(), 
            'sucess' => Alert::getSucess(),
            'warning' => Alert::getWarning(),
            'clientes' => $clientes
        ));

        exit;
    }
}