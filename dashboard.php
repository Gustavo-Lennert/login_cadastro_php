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
            <div class="alert alert-success text-center" role="alert">
                Logado com sucesso!
            </div>
            <form action="./control/exit.php" method="POST">
                <button name="sair" type="submit">Sair</button>  
            </form> 
        </div>
    </body>
</html>
<?php }
else{
    $_SESSION['msg'] = 3;
    header('Location: ./login.php');
}