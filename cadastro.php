<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/bootstrap.css">
        <link rel="shortcut icon" href="./imagens/icon_pc.png" type="image/x-icon">
        <link rel="stylesheet" href="./style/style.css">

        <!-- JQuery -->
        <script src="./js/jquery.js" type="text/javascript"></script>

        <!-- Sweet Alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <title>Cadastro</title>
    </head>
    <body>
        <div class="main ">
            <div class="row">
                <div class="col-md-7">
                    <form action="#" method="POST" id="cadast" name="cadastrar">
                        <h1>Cadastro</h1>
                        <input class="form-control" type="text" id="user" name="user" placeholder="Usuário" >
                        <br>
                        <input class="form-control" type="text" id="email" name="email" placeholder="E-mail" >
                        <br>
                        <input class="form-control" type="number" id="cel" name="cel" placeholder="Celular" >
                        <br>
                        <input class="form-control" type="password" id="senha" name="senha" placeholder="Senha" >
                        <br>
                        <input class="btn" type="button" name="cadastrar" value="Cadastrar" onclick="cadUser()">
                        <input type="hidden" name="cadastrar" value="cadastrar">
                        <br>
                        <p>Já tem um cadastro?<br><a href="login.php"> Clique aqui para logar</p></a>
                        <!-- Mensagens de validação -->
                       
                    </form>
                </div>
            </div>
        </div>
        <script>
            function cadUser(){
                let dados = $('#cadast').serialize();

                $.ajax({
                    type: 'POST',
                    url: './control/validaCad.php',
                    data: dados,
                    success:function(json){

                        if(json.icon == 'success'){
                            swal.fire({
                                title: json.msg,
                                icon: json.icon,
                                html: '<a href="login.php"><button class="btn">Ok</button></a>',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                            });
                        }else{
                            swal.fire({
                                title: json.msg,
                                icon: json.icon,
                                showConfirmButton: true,
                                allowOutsideClick: true,
                            });
                        }
                    },
                    error: function(error){
                        console.log(error);
                    },
                });
            }
        </script>
    </body>
</html> 