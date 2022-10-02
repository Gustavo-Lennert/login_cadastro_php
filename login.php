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
        <script src="./js/sweetAlert.js"></script>

        <title>Login</title>
    </head>
    <body>
        <div class="main">
            <div class="row">
                <div class="col-md-7">
                    <form action="#" method="POST" id="log" name="login">
                        <img src="./imagens/login.png" alt="imgCad" id="imgCad">
                        <h1 id="titleLog">Login</h1>  
                        <input class="form-control" type="text" id="email" name="email" placeholder="E-mail" >
                        <br>
                        <input class="form-control" type="password" id="senha" name="senha" placeholder="Senha" >
                        <br>
                        <input class="btn" name="btnLogin" type="button" value="Login" onclick="logUser()">
                        <input type="hidden" name="btnLogin" value="login">
                        <br>
                        <p>Não possui cadastro?<br><a href="cadastro.php">Clique aqui</a></p>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function logUser(){
                let dados = $('#log').serialize();

                $.ajax({
                    type: 'POST',
                    url: './control/validaLog.php',
                    data: dados,
                    success:function(json){
                        if(json.msg == 'success'){
                            let timerInterval
                            Swal.fire({
                            title: 'Login efetuado com success',
                            icon:'success',
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                                window.location.href = 'dashboard.php';
                            }
                            }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                            }
                            })
                            
                        }else{
                            swal.fire({
                                title: json.msg,
                                icon: json.icon,
                                showConfirmButton: true,
                                allowOutsideClick: true,
                            });
                        }
                    },
                    error: function(json){},
                });
            }
        </script>
    </body>
</html>