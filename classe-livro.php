<?php


Class Livro{

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
    public function ListarDadosLivro()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM livros ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }  
    // função que cadastra usuário
    public function cadastrarLivro($isbn, $nome, $edicao, $editora, $autor, $dataPublicacao, $idioma, $numeroPagina, $categoria, $quantidade)
    {   // verificando se o livro já foi cadastrado
        $cmd = $this->pdo->prepare("SELECT isbn From livros WHERE nome = :n");
        $cmd -> bindValue(":n", $nome);
        $cmd -> execute();
        if($cmd -> rowCount()>0)// verifica se o e-mail já existe no banco de dados
        {
            return false;
        }else 
        {
            $cmd = $this->pdo->prepare("INSERT INTO livros(isbn, nome, edicao, editora, autor, dataPublicacao, idioma, numeroPagina, categoria, quantidade) VALUE (:i, :n, :e, :ed, :a, :d, :idioma, :np, :c, :q)");
            $cmd->bindValue(":i", $isbn);
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $edicao);
            $cmd->bindValue(":ed", $editora);
            $cmd->bindValue(":a", $autor);
            $cmd->bindValue(":d", $dataPublicacao);
            $cmd->bindValue(":idioma", $idioma);
            $cmd->bindValue(":np", $numeroPagina);
            $cmd->bindValue(":c", $categoria);
            $cmd->bindValue(":q", $quantidade);
            $cmd->execute();
            return true;
        }
        
    }

    // metodo de excluir pessoa
    public function excluirLivro($isbn)
    {
        try
        {
        $cmd = $this->pdo->prepare("DELETE FROM livros WHERE isbn = :i");
        $cmd ->bindValue(":i", $isbn);
        $cmd ->execute();
        return 1;
        }catch(Exception $e){
            return 0;
        }
    }

    // buscar os dados de um livro
    public function buscarDadosLivro($isbn)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM livros WHERE isbn = :i");
        $cmd -> bindValue(":i", $isbn);
        $cmd -> execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //Atualizar dados no banco 
    public function atualizarDadosLivro($isbn, $nome, $edicao, $editora, $autor, $dataPublicacao, $idioma, $numeroPagina, $categoria, $quantidade)
    {
       
            $cmd = $this->pdo->prepare("UPDATE livros SET nome = :n, edicao = :e, editora = :ed, autor = :a, dataPublicacao = :d, idioma = :idioma, numeroPagina = :np, categoria = :c, quantidade = :q WHERE isbn = :i");
            $cmd->bindValue(":i", $isbn);   
            $cmd->bindValue(":n", $nome);    
            $cmd->bindValue(":e", $edicao);    
            $cmd->bindValue(":ed", $editora);    
            $cmd->bindValue(":a", $autor);    
            $cmd->bindValue(":d", $dataPublicacao);  
            $cmd->bindValue(":idioma", $idioma);  
            $cmd->bindValue(":np", $numeroPagina);  
            $cmd->bindValue(":c", $categoria);  
            $cmd->bindValue(":q", $quantidade);  
            $cmd->execute(); 
    }

}
?>