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

    if(isset($_POST['login'])){

        //Atribuição de valores passados do formulário para as variáveis 
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //Criptograr a senha para validação
        $novaSenha = sha1($senha);
        

        //Validação se há campos vazios (não preenchidos), no formulário
        if(empty($email) || empty($senha)){
            $_SESSION['msg'] = 1;
            header('Location: ../login.php');
        }else{

            //Valida se o usuário tem cadastro no banco
            $validaDados = $conexao->prepare('SELECT * FROM user WHERE senha = :senha AND email = :email');
            $validaDados->bindValue(':senha', $novaSenha);
            $validaDados->bindValue(':email', $email);
            $validaDados->execute();
            if($validaDados->rowCount() > 0){
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                header('Location: ../dashboard.php');
            }
            else{
                $_SESSION['msg'] = 2;
                header('Location: ../login.php');
            }
        } 
    }   
    
    