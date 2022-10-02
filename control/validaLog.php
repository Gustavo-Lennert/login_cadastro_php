<?php
    
    //Comando para reportar erros de execução
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();
    
    //Conexão com o banco
    include("banco.php");

    header('Content-Type: application/json charset=utf-8');

    if(isset($_POST['btnLogin'])){

        //Atribuição de valores passados do formulário para as variáveis 
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //Criptograr a senha para validação
        $novaSenha = sha1($senha);

        //Validação se há campos vazios (não preenchidos), no formulário
        if(empty($email) || empty($senha)){
            $msg = array(
                "msg" => "Preencha todos os campos corretamente!",
                "icon" => "warning",
            );
            echo json_encode($msg);
        }
        
        else{
            //Valida se o usuário tem cadastro no banco
            $validaDados = $conexao->prepare('SELECT * FROM user WHERE senha = :senha AND email = :email');
            $validaDados->bindValue(':senha', $novaSenha);
            $validaDados->bindValue(':email', $email);
            $validaDados->execute();
            if($validaDados->rowCount() > 0){
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                $msg = array(
                    "msg" => "success",
                );
                echo json_encode($msg);

            }else{
                $msg = array(
                    "msg" => "Usuário inválido!",
                    "icon" => "error",
                );
                echo json_encode($msg);
            }
        } 
    }   
    
    