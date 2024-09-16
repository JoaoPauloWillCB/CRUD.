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

            $cpf = !empty($_POST['cpf']) ? $_POST['cpf'] : '';

            if(!empty($client->getClientByCPF($cpf))) {

                Alert::setError('Já existe um cliente com este CPF cadastrado.');

                header('Location: /client/register');

                exit;
            }

            $nome = !empty($_POST['nome']) ? $_POST['nome'] : '';
            $celular = !empty($_POST['celular']) ? $_POST['celular'] : '';
            $descricao = $_POST['descricao'];
            $cep = isset($_POST['cep']) ? $_POST['cep'] : '';
            $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
            $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
            $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
            $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
            $numero = isset($_POST['numero']) ? $_POST['numero'] : '';

            try {
                
                $client->clientRegister($nome, $cpf, $celular, $descricao, $cep, $estado, $cidade, $bairro, $endereco, $numero);

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