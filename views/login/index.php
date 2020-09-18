<?php 
    require_once '../../classes/usuarios.php';
    $u = new Usuario;
?>

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="../../css/index.css">
    </head>

    <body>
        <div id="body-form">
            <h1>Login</h1>
             <form method="POST">
                <input type="email" name="email" placeholder="Email" maxlength="40">
                <input type="password" name="senha" placeholder="Senha" maxlength="8">
                <input type="submit" value="ACESSAR">   
                <a href="../cadastrar/cadastrar.php">Ainda não é cadastrado? <strong>Criar uma conta!</strong></a> 
             </form>
        </div>
<?php
    if(isset($_POST['email']))
    {
        $email = addslashes($_POST['email']); //"addslashes" previne codigos nos inputs;
        $senha = addslashes($_POST['senha']); //"addslashes" previne codigos nos inputs;
 
        //verifica se está preenchido
        if(!empty($email) && !empty($senha))
        {
            $u->conectar("login", "localhost", "root", "root"); //dados para conexao com o banco de dados
            if($u->$msgErro == ""){ //tudo ok
                if($u->logar($email, $senha)){
                    header("location: ../home/home.php"); //endereço para ser redirecionado a outra pagina
                }
                else{
                    ?>

                    <div class="msg-erro">
                      Email e/ou Senha informados estão incorretos!
                    </div>

                    <?php
                    }
            }
            else{
                ?>

                <div class="msg-erro">
                    <?php echo "Error: ".$u->msgErro; ?>
                </div>
                
                <?php
            }
        }
        else{
                    ?>

                    <div class="msg-erro">
                      Preencha todos os campos!
                    </div>

                    <?php
        }
    }
?>
    </body>
</html>