<?php
    require_once './control/exit.php';
    if(isset($_SESSION['email']) and isset($_SESSION['senha'])){
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
        <title>Dashboard</title>
    </head>
    <body>
        <div class="main">  
            <input value="Sair" name="sair" id="sair" class="btn" type="button" onclick="deslogar()">
            <input type="hidden" name="sair" value="sair">  
        </div>
    </body>
    <script>
        function deslogar(){
            let dados = $('#sair').serialize();

            $.ajax({
                type: 'POST',
                url: './exit.php',
                data: dados,
                success:function(json){
                    swal.fire({
                        title: json.msg,
                        icon: json.icon,
                        showConfirmButton: true,
                        allowOutsideClick: true,
                    });
                },
                error: function(error){
                    console.log(error);
                },
            });
        }

    </script>
</html>
<?php }
else{
    $_SESSION['msg'] = 3;
    header('Location: ./login.php');
}