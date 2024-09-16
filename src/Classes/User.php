<?php

namespace App\Classes;

use App\Classes\DB\Sql;
use Exception;

class User
{

    const SESSION = 'User';

    /**
     * Método para persistir os dados de um usuário no banco de dados
     * 
     * @param string $usuario_nome Nome do usuário
     * 
     * @param string $usuario_email E-mail do usuário
     * 
     * @param string $usuario_senha Senha do usuário
     * 
     * @return void
     * 
     * @access public
     */
    public function userRegistration(string $usuario_nome, string $usuario_email, string $usuario_senha) :void
    {

        $sql = new Sql(APP_CRUDPHP);

        if(empty($usuario_nome) || empty($usuario_email) || empty($usuario_senha)) throw new \Exception('Os campos devem ser preenchidos corretamente.');

        $query = 'INSERT INTO tb_usuarios (usuarios_nome, usuarios_email, usuarios_senha) VALUES (:usuario_nome, :usuario_email, :usuario_senha)';

        $params = array(
            ':usuario_nome' => $usuario_nome,
            ':usuario_email' => $usuario_email,
            ':usuario_senha' => $usuario_senha
        );

        $sql->query($query, $params);
    }
    
    /**
     * Método para login de usuário
     * 
     * @param string $usuario_email E-mail do usuário
     * 
     * @param string $usuario_senha Senha do usuário
     * 
     * @return void
     * 
     * @access public
     */
    public function login(string $usuario_email, string $usuario_senha) :void
    {

        if(empty($usuario_email) || empty($usuario_senha)) throw new \Exception('Os campos devem ser preenchidos corretamente.');

        $usuario_banco = $this->getUserByEmail($usuario_email);

        if(empty($usuario_banco)) throw new \Exception(('O e-mail informado ainda não possui cadastro. Cadastre-se antes de efetuar o login.')); else {

            if($usuario_banco[0]['usuarios_email'] != $usuario_email || strcmp($usuario_senha, $usuario_banco[0]['usuarios_senha']) != 0) {

                throw new \Exception('E-mail ou senha incorretos. Por favor tente novamente.');
            }
        }
        
        $_SESSION['User'] = $usuario_banco[0];
    }

    /**
     * Método para verificar se existe uma sessão ativa
     * 
     * @return void
     * 
     * @access public
     */
    public function verifyLogin() :void
    {
        if (!isset($_SESSION['User'])) header('Location: /login');   
    }

    /**
     * Método para buscar um usuário pelo e-mail
     * 
     * @param string $usuario_email E-mail do usuário
     * 
     * @return array Dados do usuário encontrado
     * 
     * @access public
     */
    public function getUserByEmail(string $usuario_email) :array
    {

        $sql = new Sql(APP_CRUDPHP);

        $query = 'SELECT * FROM tb_usuarios WHERE usuarios_email = :usuario_email';

        $params = array(':usuario_email' => $usuario_email);

        $result = $sql->select($query, $params);

        return $result;
    }

    /**
     * Método para listar todos os usuários
     * 
     * @return array Lista de usuários
     * 
     * @access public
     */
    public function getUsers() :array
    {

        $sql = new Sql(APP_CRUDPHP);

        $query = 'SELECT usuarios_nome, usuarios_email, usuarios_senha FROM tb_usuarios';

        $return = $sql->select($query);

        return $return;
    }

    public function updateUserName(int $usuario_id, string $usuario_nome) :void
    {
        $sql = new Sql(APP_CRUDPHP);

        $query = 'UPDATE tb_usuarios SET usuarios_nome = :usuario_nome WHERE usuarios_id = :usuario_id';

        $params = array(
            ':usuario_id' => $usuario_id,
            ':usuario_nome' => $usuario_nome
        );

        $sql->query($query, $params);
    }

    public function getUserByID($usuarioID) :array
    {
        $sql = new Sql(APP_CRUDPHP);

        $query = 'SELECT usuarios_nome, usuarios_email, usuarios_senha FROM tb_usuarios WHERE usuarios_id = :usuario_id';

        $params = array(':usuario_id' => $usuarioID);

        $result = $sql->select($query, $params);

        return $result[0];
    }

    public function updateUserPassword(string $senhaAntiga, string $novaSenha, string $confNovaSenha, int $usuarioID)
    {
        $sql = new Sql(APP_CRUDPHP);

        $usuario = $this->getUserByID($usuarioID);
        
        if(strcmp($senhaAntiga, $usuario['usuarios_senha']) != 0) throw new \InvalidArgumentException('A senha antiga está incorreta.');

        if(strcmp($novaSenha, $usuario['usuarios_senha']) == 0) throw new \InvalidArgumentException('A nova senha deve ser diferente da senha atual.');

        if(strcmp($novaSenha, $confNovaSenha) != 0) throw new \InvalidArgumentException('As senha não conferem.');

        $query = ('UPDATE tb_usuarios SET usuarios_senha = :nova_senha WHERE usuarios_id = :usuario_id');

        $params = array(
            ':nova_senha' => $novaSenha,
            ':usuario_id' => $usuarioID
        );
        
        $sql->query($query, $params);
    }
}