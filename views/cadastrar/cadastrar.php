<?php
    require_once '../../classes/usuarios.php';
    $u = new Usuario;
?>

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Cadastrar</title>
        <link rel="stylesheet" href="../../css/index.css">
    </head>

    <body>
        <div id="body-form-cadastro">
            <h1>Cadastrar</h1>
             <form method="POST">
                <input type="text" name="nome" placeholder="Nome" maxlength="30">
                <input type="email" name="email" placeholder="Usuário" maxlength="40">
                <input type="password" name="senha" placeholder="Senha" maxlength="8">
                <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="8">
                <input type="submit" value="Criar conta">
                <a href="../login/index.php">Já possui conta? <strong>Clique aqui!</strong></a>    
             </form>
        </div>

<?php
//verifica se clicou no botão
if(isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']); //addslashes previne codigos nos inputs
    $email = addslashes($_POST['email']); //addslashes previne codigos nos inputs;
    $senha = addslashes($_POST['senha']); //addslashes previne codigos nos inputs;
    $confSenha = addslashes($_POST['confSenha']); //addslashes previne codigos nos inputs;

    //verificar se está preenchido
    if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confSenha))
    {
        $u->conectar("login", "localhost", "root", "root");
        if($u->$msgErro == ""){ //tudo ok
            if($senha == $confSenha){
                if($u->cadastrar($nome, $email, $senha)){
                    echo "Cadastrado com sucesso! Faça login para entrar!";
                }
                else{
                    echo "Email ja cadastrado!";
                }
            }
            else{
                echo "A senha digitada nos campos não correspondem!";
            }
        }
        else{
            echo "Error: ".$u->msgErro;
        }
    }
    else{
        echo "Preencha todos os campos!";
    }
}

?>
    </body>
</html>