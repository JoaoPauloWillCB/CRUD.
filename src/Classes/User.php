<?php

namespace App\Classes;

use App\Classes\DB\Sql;
use Exception;

class User
{

    const SESSION = 'User';

    public function login(string $usuario_email, string $usuario_senha)
    {

        if(empty($usuario_email) || empty($usuario_senha)) {

            throw new \Exception('Os campos devem ser preenchidos corretamente.');
        }

        $usuario_banco = $this->getUserByEmail($usuario_email);

        if(empty($usuario_banco)) {

            throw new \Exception(('O e-mail informado ainda não possui cadastro.'));
        
        } else {

            if($usuario_banco[0]['usuarios_email'] != $usuario_email || strcmp($usuario_senha, $usuario_banco[0]['usuarios_senha']) != 0) {

                throw new \Exception('E-mail ou senha incorretor. Por favor tente novamente.');
            }
        }
        
        $_SESSION['User'] = $usuario_banco[0];
    }

    public function verifyLogin()
    {
        if (!isset($_SESSION['User'])) {

            header('Location: /login');   
        }
    }


    public function getUserByEmail(string $usuario_email)
    {

        $sql = new Sql(APP_CRUDPHP);

        $query = 'SELECT * FROM tb_usuarios WHERE usuarios_email = :usuario_email';

        $params = array(':usuario_email' => $usuario_email);

        $result = $sql->select($query, $params);

        return $result;
    }

    public function userRegistration(string $usuario_nome, string $usuario_email, string $usuario_senha)
    {

        $sql = new Sql(APP_CRUDPHP);

        if(empty($usuario_nome) || empty($usuario_email) || empty($usuario_senha)) {

            throw new \Exception('Os campos devem ser preenchidos corretamente.');
        }

        $query = 'INSERT INTO tb_usuarios (usuarios_nome, usuarios_email, usuarios_senha) VALUES (:usuario_nome, :usuario_email, :usuario_senha)';

        $params = array(
            ':usuario_nome' => $usuario_nome,
            ':usuario_email' => $usuario_email,
            ':usuario_senha' => $usuario_senha
        );

        $sql->query($query, $params);
    }

    public function getUsers() :array
    {

        $sql = new Sql(APP_CRUDPHP);

        $query = 'SELECT usuarios_nome, usuarios_email, usuarios_senha FROM tb_usuarios';

        $return = $sql->select($query);

        return $return;
    }
}