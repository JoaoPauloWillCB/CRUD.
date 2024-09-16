<?php

namespace App\Classes;

use App\Classes\DB\Sql;

class Client 
{

    /**
     * Método para persistir os dados do cliente no banco de dados
     * 
     * @param string $nome Nome do client
     * 
     * @param string $cpf CPF do cliente
     * 
     * @param string $celular Celular do cliente
     * 
     * @param string $descricao Descrição do cliente se houver
     * 
     * @return void
     * 
     * @access public
     */
    public function clientRegister(string $nome, string $cpf, string $celular, string $descricao = NULL, string $cep, string $estado, string $cidade, string $bairro, string $endereco, int $numero) :void
    {
        $sql = new Sql(APP_CRUDPHP);

        $this->clientDataValidation($nome, $cpf, $celular, $cep, $estado, $cidade, $bairro, $endereco, $numero);

        $query = 'INSERT INTO tb_clientes (clientes_nome, clientes_cpf, clientes_celular, clientes_descricao, clientes_cep, clientes_estado, clientes_cidade, clientes_bairro, clientes_endereco, clientes_numero)
        VALUES (:nome, :cpf, :celular, :descricao, :cep, :estado, :cidade, :bairro, :endereco, :numero)';

        $params = array(
            ':nome' => $nome,
            ':cpf' => clearInputsLetras($cpf),
            ':celular' => clearInputsLetras($celular),
            ':descricao' => $descricao,
            ':cep' => $cep,
            ':estado' => $estado,
            ':cidade' => $cidade,
            ':bairro' => $bairro,
            ':endereco' => $endereco,
            ':numero' => $numero
        );

        $sql->query($query, $params);
    }

    /**
     * Método para validar os dados do cliente
     * 
     * @param string $nome Nome do cliente
     * 
     * @param string $cpf CPF do cliente 
     * 
     * @param string $celular Celular do cliente
     * 
     * @return void
     * 
     * @access public
     */
    public function clientDataValidation(string $nome, string $cpf, string $celular, string $cep, string $estado, string $cidade, string $bairro, string $endereco, int $numero) :void
    {
        if(empty($nome)) throw new \Exception('O nome do cliente deve ser definido.');
        if(empty($cpf)) throw new \Exception('O cpf do cliente deve ser definido.');
        if(empty($celular)) throw new \Exception('O celular do cliente deve ser definido.');
        if($this->getClientByCPF($cpf)) throw new \Exception('Já existe um cliente cadastrado com esse CPF.');
        if(!validarCPF(clearInputsLetras($cpf)) || !validarString(clearInputsLetras($cpf))) throw new \Exception('O CPF informado é inválido.');
    }

    /**
     * Método para buscar um cliente pelo seu CPF
     * 
     * @param string $cpf CPF do cliente que será buscado
     * 
     * @return bool Se existe um cliente com o CPF informado ou não
     * 
     * @access public
     */
    public function getClientByCPF(string $cpf) :array
    {
        $sql = new Sql(APP_CRUDPHP);
        
        $query = 'SELECT clientes_nome, clientes_cpf FROM tb_clientes WHERE clientes_cpf = :cpf';

        $params = array(':cpf' => clearInputsLetras($cpf));

        $result = $sql->select($query, $params);
        
        return $result;
    }

    /**
     * Método para listar todos os clientes
     * 
     * @return array Lista de clientes
     * 
     * @access public
     */
    public function getClientes() :array
    {
        $sql = new Sql(APP_CRUDPHP);

        $query = 'SELECT * FROM tb_clientes';

        $return = $sql->select($query);

        return $return;
    }
}