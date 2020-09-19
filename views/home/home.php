<!DOCTYPE html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        <?php
            session_start(); 
            if(!isset($_SESSION['id_usuario'])){ //verifica se o usuario está logado
                header("location: ../login/index.php");
                exit;
            }
        ?>
        Olá, seja bem vindo! <?php echo ($_SESSION['id_usuario'])?>
        <a href="../logout/logout.php"> Sair </a>

        <div id="menu">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Localização</a></li>
            </ul>
        </div>
    </body>
</html>