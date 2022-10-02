<?php
    require_once './control/validaLog.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/bootstrap.css">
        <link rel="shortcut icon" href="./imagens/icon_pc.png" type="image/x-icon">
        <link rel="stylesheet" href="./style/style.css">
        
        <title>Login</title>
    </head>
    <body>
        <div class="main">
            <div class="row">
                <div class="col-md-7">
                    <form action="./control/validaLog.php" method="POST">
                        <img src="./imagens/login.png" alt="imgCad" id="imgCad">
                        <h1 id="titleLog">Login</h1>  
                        <label>E-mail</label>
                        <br>
                        <input class="form-control" type="text" id="email" name="email" placeholder="E-mail" >
                        <br>
                        <label>Senha</label>
                        <br>
                        <input class="form-control" type="password" id="senha" name="senha" placeholder="Senha" >
                        <br>
                        <button  name="login" type="submit">Login</button>
                        <br>
                        <p>Não possui cadastro?<br><a href="cadastro.php">Clique aqui</a></p>

                        <!-- Mensagens de validação -->
                        <?php

                            //Validação se a sessão está ativa
                            if(isset( $_SESSION['msg'])){

                                //Armazenando o valor passado para sessão 'msg' a variável $msg
                                $msg = $_SESSION['msg'];
                            
                                if($msg == 1){ ?>
                                    <div class="alert alert-warning" role="alert">
                                        Preencha todos os campos!
                                    </div>
                                <?php unset($_SESSION['msg']);
                                } 

                                elseif($msg == 2){
                                ?>
                                    <div class="alert alert-danger" role="alert" >
                                        E-mail ou senha inválidos!
                                    </div>
                                <?php unset($_SESSION['msg']);
                                }
                                elseif($msg == 3){
                                    ?>
                                        <div class="alert alert-danger" role="alert" >
                                            Você não tem permissão para acessar esta página!
                                        </div>
                                    <?php unset($_SESSION['msg']);
                                }
                            }
                        ?>  
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>