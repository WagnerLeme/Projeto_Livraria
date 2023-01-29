<?php

Class Pessoa{

    private $pdo;

    public function __construct($dbname, $host, $user, $senha)
    {
        try
        {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }
        catch(PDOException $e){
            echo "Erro com banco de dados: ".$e->getMessage();
            exit();
        }
        catch(Exception $e){
            echo "Erro generico: ".$e->getMessage();
            exit();
        }
    }
    // Função que lista todos cadastrados no BD
    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }  
    // função que cadastra usuário
    public function cadastrarPessoa($nome, $telefone, $email, $endereco, $senha, $permissao)
    {   // verificando se o e-mail já foi cadastrado
        $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
        $cmd -> bindValue(":e", $email);
        $cmd -> execute();
        if($cmd -> rowCount()>0)// verifica se o e-mail já existe no banco de dados
        {
            return false;
        }else 
        {
            $cmd = $this->pdo->prepare("INSERT INTO pessoa(nome, telefone, email, endereco, senha, permissao) VALUE (:n, :t, :e, :endereco, :s, :p)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":endereco", $endereco);
            $cmd->bindValue(":s", md5($senha));
            $cmd->bindValue(":p", $permissao);
            $cmd->execute();

            
            return true;
        }
        
    }

    // metodo de excluir pessoa
    public function excluirPessoa($id)
    {
        try
        {
        $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    // buscar os dados de uma pessoa
    public function buscarDadosPessoa($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //Atualizar dados no banco 
    public function atualizarDados($id, $nome, $telefone, $email, $endereco, $senha, $permissao)
    {
       
            $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone = :t, email = :e, endereco = :endereco, senha = :s, permissao = :p WHERE id = :id");
            $cmd->bindValue(":id", $id);   
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":endereco", $endereco);
            $cmd->bindValue(":s", md5($senha));
            $cmd->bindValue(":p", $permissao);
            $cmd->execute(); 
    }

}
?>