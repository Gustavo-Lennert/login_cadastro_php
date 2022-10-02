<?php

    // require "banco.php"; 


    //Comando para reportar erros de execução
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();

     //Conexão com o banco
     try {
        $conexao = new PDO('mysql:host=localhost;dbname=universidade', 'root', '181503');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


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
            $_SESSION['msg'] = 3;
            header('Location: ../cadastro.php');
        }else{

            //Valida se o email digitado é válido
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

                //Valida se o usuário digitado já existe no banco
                $validaDados = $conexao->prepare('SELECT * FROM user WHERE senha = :senha || email = :email');
                $validaDados->bindValue(':senha', $novaSenha);
                $validaDados->bindValue(':email', $email);
                $validaDados->execute();
                if($validaDados->rowCount() > 0){
                    $_SESSION['msg'] = 4;
                    header('Location: ../cadastro.php');
                }
                else{
                    $insertDados = $conexao->prepare('INSERT INTO user (`nome`, `senha`, `email`, `cel`) VALUES(:nome, :senha, :email, :cel)');
                    
                    $insertDados->bindValue(':nome', $user);
                    $insertDados->bindValue(':senha', $novaSenha);
                    $insertDados->bindValue(':email', $email);
                    $insertDados->bindValue(':cel', $cel);
                    $insertDados->execute();

                    if($insertDados){
                        $_SESSION['msg'] = 1;
                        header('Location: ../cadastro.php');
                    }else{
                        $_SESSION['msg'] = 2 ;
                        header('Location: ../cadastro.php');
                    }
                    
                }
            }
            else{
                $_SESSION['msg'] = 2;
                
                header('Location: ../cadastro.php');
            }  
        }   
    }