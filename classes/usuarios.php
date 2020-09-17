<?php

Class Usuario
{
    private $pdo;
    public $msgErro="";

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;

        try {
            $pdo = new PDO("mysql:dbname=".$nome."; host=".$host, $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();                
        }
        
    }

    public function cadastrar($nome, $email, $senha)
    {
        global $pdo;
        global $msgErro;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return false; //usuario já cadastrado
        }
        else{
            //cadastrar usuario
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES(:n, :e, :s)");
            //:n :e :s são abreviações de nome, email e senha
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha)); //md5 criptografa a senha
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $senha)
    {
        global $pdo;
        global $msgErro;
        //verificar se o usuario tem cadastro, para realizar login
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha)); //md5 criptografa a senha
        $sql->execute();

        if($sql->rowCount() > 0){
            //Realizar Login
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //logou com sucesso
        }
        else{
            return false; //não conseguiu logar
        }
    } 
}
?>