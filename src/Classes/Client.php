<?php

namespace App\Classes;

use App\Classes\DB\Sql;

class Client 
{

    public function clientRegister(string $nome, string $cpf, string $celular, string $descricao = NULL)
    {
        
        $sql = new Sql(APP_CRUDPHP);

        if(empty($nome)) throw new \Exception('O nome do cliente deve ser definido.');
        if(empty($cpf)) throw new \Exception('O cpf do cliente deve ser definido.');
        if(empty($celular)) throw new \Exception('O celular do cliente deve ser definido.');

        $query = 'INSERT INTO tb_clientes (clientes_nome, clientes_cpf, clientes_celular, clientes_descricao) VALUES (:nome, :cpf, :celular, :descricao)';

        $params = array(
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':celular' => $celular,
            'descricao' => $descricao
        );

        $sql->query($query, $params);
    }

    public function getClientes():array
    {
        
        $sql = new Sql(APP_CRUDPHP);

        $query = 'SELECT clientes_nome, clientes_cpf, clientes_celular, clientes_descricao FROM tb_clientes';

        $return = $sql->select($query);

        return $return;
    }
}