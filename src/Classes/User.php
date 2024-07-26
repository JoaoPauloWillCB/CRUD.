<?php

namespace App\Classes;

use App\Classes\DB\Sql;
use Exception;

class User
{

    public function login(string $usuario_email, string $usuario_senha)
    {

        $sql = new Sql(APP_CRUDPHP);

        if(empty($usuario_email) || empty($usuario_senha)) {

            throw new \Exception('Os campos devem ser preenchidos corretamente.');
        }

        $query = 'SELECT * FROM tb_usuarios WHERE usuarios_email = :usuario_email';

        $params = array(':usuario_email' => $usuario_email);

        $result = $sql->select($query, $params);
        
        if(empty($result) || strcmp($usuario_senha, $result[0]['usuarios_senha']) != 0) {

            throw new Exception('E-mail ou senha incorretos.');
        }
        
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
}