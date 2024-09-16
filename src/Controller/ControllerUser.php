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

    public function userProfile(Request $request, Response $response, array $args)
    {
        $user = new user;

        $usuarios_id = $_SESSION[User::SESSION]['usuarios_id'];

        $imgUser = getImgUser($usuarios_id);

        $method = $request->getMethod();

        if($method === 'GET') {
            
            $page = new Page(['header' => true, 'footer' => true]);

            $page->setTpl('user/userProfile', array(
                'error' => Alert::getError(),
                'sucess' => Alert::getSucess(),
                'warning' => Alert::getWarning(),
                'imgUser' => $imgUser
            ));

            exit;

        } else if($method === 'POST') {
            
            if(!empty($_FILES)) {
                
                if(($_FILES['image']['name']) != '' && isset($_POST['input'])) {
                    
                    try {
                        
                        getImage($_FILES['image'], './images', $usuarios_id);
                        
                        Alert::setSucess('Imagem atualizada.');
                        
                    } catch (\Throwable $erro) {
                        
                        Alert::setError($erro->getMessage());
                    }
                    
                    header('Location: /user/userProfile');
                    
                    exit;
                    
                } else if(!empty($_FILES) && isset($_POST['remove'])) {
    
                    if(file_exists("./images/$usuarios_id")) {
    
                        unlink("./images/$usuarios_id");
                        
                    } else {
    
                        Alert::setError('A imagem de perfil padrão não pode ser removida.');
    
                        header('Location: /user/userProfile');
    
                        exit;
                    }
    
                    Alert::setSucess('Imagem removida.');
    
                    header('Location: /user/userProfile');
    
                    exit;
    
                } else {
    
                    Alert::setError('Nenhuma imagem selecionada.');
    
                    header('Location: /user/userProfile');
    
                    exit;
                }
            }
            
            if(!empty($_POST) && isset($_POST['att-dados'])) {
                
                $nome = isset($_POST['nome']) ? $_POST['nome'] : NULL;

                if ($nome == $_SESSION[User::SESSION]['usuarios_nome']) {
    
                    Alert::setWarning("O nome deve ser atualizado para um diferente do atual.");
    
                    header('Location: /user/userProfile');
    
                    exit;

                }

                try {

                    $user->updateUserName($usuarios_id, $nome);
    
                    Alert::setSucess("Nome do usuário atualizado com sucesso.");
    
                    $_SESSION[User::SESSION]['usuarios_nome'] = $nome;
    
                } catch (\Throwable $erro) {
    
                    Alert::setError($erro->getMessage());
                }
    
                header('Location: /user/userProfile');
    
                exit; 
            }

            if(!empty($_POST) && isset($_POST['att-senha'])) {
                
                $senhaAntiga = isset($_POST['senhaAntiga']) ? $_POST['senhaAntiga'] : NULL;
                $novaSenha = isset($_POST['novaSenha']) ? $_POST['novaSenha'] : NULL;
                $confNovaSenha = isset($_POST['confNovaSenha']) ? $_POST['confNovaSenha'] : NULL;

                if(empty($senhaAntiga) || empty($novaSenha) || empty($confNovaSenha)) {

                    Alert::setError('Os campos deve ser preenchidos corretamente.');

                    header('Location: /user/userProfile');

                    exit;
                }

                try {
                    
                    $user->updateUserPassword($senhaAntiga, $novaSenha, $confNovaSenha, $_SESSION[User::SESSION]['usuarios_id']);

                    Alert::setSucess('Senha redefinida com sucesso.');

                } catch (\Throwable $erro) {
                    
                    Alert::setError($erro->getMessage());
                }

                header('Location: /user/userProfile');
            }

            header('Location: /user/userProfile');
    
            exit;
        }
    }
}