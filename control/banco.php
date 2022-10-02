<?php
    //Conexão com o banco
    try {
        $conexao = new PDO('mysql:host=localhost;dbname=universidade', 'root', '181503');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }