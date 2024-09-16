<?php

/**
 * Função para substituir o var_dump
 */
function vd(mixed ...$values):mixed
{
    for($i = 0; $i < count($values); $i++){

        var_dump($values[$i]);
    }

    die;
}

/**
 * Funcão para limpar inputs e deixar somente letras
 */
function clearInputsLetras($values):mixed
{
    if(is_array($values)) {

        foreach($values as $key => $value) {

            if (is_array($value)) {

                $values[$key] = clearInputsLetras($value);

            } else{

                $values[$key] = str_replace([".", "/", "-", "(", ")", "+", " "], "", $value);
            }
        }
    } else {

        $values = str_replace([".", "/", "-", "(", ")", "+", " "], "", $values);
    }

    return $values;
}

/**
 * Função para validar uma string com espaço vazio e caracteres em sequência
 */
function validarString($values) 
{   
    
    if(preg_match('/^(\d)\1+$/', str_replace(" ", 0, $values)) == 1 || $values == ' ' || $values == '') {
        
        return false;
    }

    return $values;
}

/**
 * Função para validar CPF
 */
function validarCPF(string $cpf) 
{

    if(is_null($cpf)) {

        return false;
    }

    if (strlen($cpf) === 11) {

        for ($i = 9; $i < 11; $i++) {

            $soma = 0;

            for ($j = 0; $j < $i; $j++) {

                $soma += $cpf[$j] * (($i + 1) - $j);
            }
            
            $resto = $soma % 11;

            $digito = ($resto < 2) ? 0 : 11 - $resto;

            if ($digito != $cpf[$i]) {

                return false;
            }
        }

        return true;
    }
}

function getImgUser(int $usuarios_id):string 
{

    $imgUser = '';

    if(is_dir('./images')) {

        if ($dir = opendir('./images')) {
    
            while (false !== ($img = readdir($dir))) {
                
                if($img == $usuarios_id) {

                    $imgUser = "/images/$usuarios_id";
                }
            }
            
            closedir($dir);
        }
    }

    return $imgUser;
}

function getImage(array $dataFile, string $dir, int $usuario_id)
{

    $image_name = $dataFile['tmp_name'];

    $image_type = exif_imagetype($image_name);
    
    if (!isset($dataFile)) {

        throw new \Exception('Arquivo não carregavel.');
    }

    if(file_exists("./images/$usuario_id")) {

        unlink("./images/$usuario_id");
    }

    if(!$image_type) {

        throw new \Exception('O arquivo enviado não é uma imagem.');
    }
    
    if (filesize($image_name) <= 0 || filesize($image_name) > 5242880) {

        throw new \Exception('O arquivo enviado não tem conteúdo ou excedeu o tamanho limite permitido.');
    }
    
    if(!is_dir($dir)) {

        mkdir($dir, 0777, true);
    }
    
    move_uploaded_file($image_name,  $dir . "/" . $usuario_id);
}

function unlinkRecursive($dir, $deleteToo) 
{ 
    if(!$dh = @opendir($dir)) { 

        return; 
    } 

    while (false !== ($obj = readdir($dh))) { 

        if($obj == '.' || $obj == '..') { 

            continue; 
        } 

        if (!@unlink($dir . '/' . $obj)) {

            unlinkRecursive($dir.'/'.$obj, true); 
        } 
    } 

    closedir($dh); 

    if ($deleteToo) {

        @rmdir($dir); 
    } 

    return; 
} 