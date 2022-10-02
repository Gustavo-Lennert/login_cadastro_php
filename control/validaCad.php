<?php

    //Comando para reportar erros de execução
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();

    //Conexão com o banco
    include("banco.php");

    header('Content-Type: application/json charset=utf-8');

    if(isset($_POST['cadastrar'])){

        //Atribuição de valores passados do formulário para as variáveis 
        $user = $_POST['user'];
        $email = $_POST['email'];
        $cel = $_POST['cel'];
        $senha = $_POST['senha'];

        //Criptograr a senha 
        $novaSenha = sha1($senha);


        //Validação se há campos vazios (não preenchidos), no formulário
        if(empty($user) || empty($email) || empty($cel) || empty($senha)){
            
            $msg = array(
                "msg" => "Preencha todos os campos corretamente!",
                "icon" => "warning",
            );
            echo json_encode($msg);

        }else{

            //Valida se o email digitado é válido
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

                //Valida se o usuário digitado já existe no banco
                $validaDados = $conexao->prepare('SELECT * FROM user WHERE senha = :senha || email = :email');
                $validaDados->bindValue(':senha', $novaSenha);
                $validaDados->bindValue(':email', $email);
                $validaDados->execute();
                if($validaDados->rowCount() > 0){
                    $msg = array(
                        "msg" => "Dados de usuário já existentes!",
                        "icon" => "warning",
                    );
                    echo json_encode($msg);
                }
                else{
                    $insertDados = $conexao->prepare('INSERT INTO user (`nome`, `senha`, `email`, `cel`) VALUES(:nome, :senha, :email, :cel)');
                    
                    $insertDados->bindValue(':nome', $user);
                    $insertDados->bindValue(':senha', $novaSenha);
                    $insertDados->bindValue(':email', $email);
                    $insertDados->bindValue(':cel', $cel);
                    $insertDados->execute();

                    if($insertDados){
                        $msg = array(
                            "msg" => "Cadastro efetuado com sucesso!",
                            "icon" => "success",
                        );
                        echo json_encode($msg);
                    }else{
                        $msg = array(
                            "msg" => "Não foi possível realizar o cadastro, tente novamente!",
                            "icon" => "error",
                        );
                        echo json_encode($msg);
                    }
                    
                }
            }
            else{
                $msg = array(
                    "msg" => "Insira um e-mail válido!",
                    "icon" => "error",
                );
                echo json_encode($msg);
            }  
        }   
    }