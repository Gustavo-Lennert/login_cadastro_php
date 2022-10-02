<?php  
    session_start();
    if(isset($_POST['sair'])){
        session_destroy();
        header('Location: ../login.php');
    }