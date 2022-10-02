<?php
    require_once './control/validaCad.php';
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
        <title>Cadastro</title>
    </head>
    <body>
        <div class="main ">
            <div class="row">
                <div class="col-md-7">
                    <form action="./control/validaCad.php" method="POST">
                        <img src="./imagens/img_cad.png" alt="imgCad" id="imgCad">
                        <h1>Cadastro</h1>
                        <label>Usuário</label>
                        <br>
                        <input class="form-control" type="text" id="user" name="user" placeholder="Usuário" >
                        <br>
                        <label>E-mail</label>
                        <br>
                        <input class="form-control" type="text" id="email" name="email" placeholder="E-mail" >
                        <br>
                        <label>Celular</label>
                        <br>
                        <input class="form-control" type="number" id="cel" name="cel" placeholder="Celular" >
                        <br>
                        <label>Senha</label>
                        <br>
                        <input class="form-control" type="password" id="senha" name="senha" placeholder="Senha" >
                        <br>
                        <button  name="cadastrar" type="submit">Cadastrar</button>
                        <br>
                        <p>Já tem um cadastro?<br><a href="login.php"> Clique aqui para logar</p></a>
                        <!-- Mensagens de validação -->
                        <?php
                        //Validação se a sessão está ativa
                            if(isset( $_SESSION['msg'])){
                            //Armazenando o valor passado para sessão 'msg' a variável $msg
                            $msg = $_SESSION['msg'];
        
                            if($msg == 1){ ?>
                                <div class="alert alert-success" role="alert">
                                    Cadastro efetuado com sucesso!
                                </div>
                            <?php unset($_SESSION['msg']);
                            }
                            elseif($msg == 2){
                            ?>
                                <div class="alert alert-danger" role="alert" >
                                    Não foi possível realizar o cadastro
                                </div>
                            <?php unset($_SESSION['msg']);
                            }
                            elseif($msg == 3){
                            ?>
                                <div class="alert alert-warning" role="alert">
                                    Preencha todos os campos!
                                </div>
                            <?php unset($_SESSION['msg']);
                            }
                            elseif($msg == 4){
                            ?>
                                <div class = "alert alert-warning" role="alert">
                                    Dados de usuário já existentes!
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