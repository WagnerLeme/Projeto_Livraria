<?php

Class Usuario{


    public function __construct($dbname, $host, $user, $senha)
    {
        try 
        {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        } 
        catch (PDOException $e) 
        {
            echo "Erro com BD: ".$e->getMessage();
        }
        catch(Exception $e)
        {
            echo "Erro: ".$e->getMessage();
        }
    }

    public function logar($email, $senha)
    {
        $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE email = :e AND senha = :s");
        $cmd->bindValue(":e",$email);
        $cmd->bindValue(":s",md5($senha));
        $cmd->execute();
        if($cmd->rowCount() > 0)
        {
            $dados = $cmd->fetch();
            session_start();
            if($dados['permissao'] == 'Administrador')
            {
                $_SESSION['id_master'] = $dados['id'];
            }
            else
            {
                $_SESSION['id_usuario'] = $dados['id'];
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    public function buscarDadosUser($id)
    {
        $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $dados = $cmd->fetch();
        return $dados;  
    }

    public function emprestar($isbn, $id)
    {   
        $qtd_dias = 7;
        $data_emprestimo = date("Y-m-d");
        $data_devolucao = date("Y-m-d", strtotime("+ {$qtd_dias} days"));


        $cmd = $this->pdo->prepare("SELECT * from pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $dados = $cmd->fetch();
        $nome = $dados['nome']; 
        $email = $dados['email'];
        
        $cmd = $this->pdo->prepare("SELECT * from livros WHERE isbn = :isbn");
        $cmd->bindValue(":isbn", $isbn);
        $cmd->execute();
        $dados = $cmd->fetch();
        $nome_livro = $dados['nome']; 
        $quantidade = $dados['quantidade'];
       
        $dados = array();
        $cmd = $this->pdo->prepare("SELECT * from pessoa_livro WHERE fk_isbn = :i");
        $cmd->bindValue(":i", $isbn);
        $cmd->execute();
        $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        
        if($id == $dados && $dados == 0)
        {
            return 0;
        }
        else if($dados == "" || $dados == 1)
        {
            $devolvido = false;
            $cmd = $this->pdo->prepare("INSERT INTO pessoa_livro (fk_isbn, data_emprestimo, data_devolucao, fk_id, email_pessoa, nome_pessoa, nome_livro, devolvido) VALUE (:id, :data_emprestimo, :data_devolucao, :fk_id, :email, :nome, :nome_livro, :devolvido)");
            $cmd->bindValue(":id", $isbn);
            $cmd->bindValue(":data_emprestimo", $data_emprestimo);
            $cmd->bindValue(":data_devolucao", $data_devolucao);
            $cmd->bindValue(":fk_id", $id);
            $cmd->bindValue(":nome", $nome);
            $cmd->bindValue(":email", $email);
            $cmd->bindValue(":nome_livro", $nome_livro);
            $cmd->bindValue(":devolvido", $devolvido);
            $cmd->execute();

            $devolvido = false;
            $cmd = $this->pdo->prepare("INSERT INTO emprestimo (fk_isbn, data_emprestimo, data_devolucao, fk_id, email_pessoa, nome_pessoa, nome_livro, devolvido) VALUE (:id, :data_emprestimo, :data_devolucao, :fk_id, :email, :nome, :nome_livro, :devolvido)");
            $cmd->bindValue(":id", $isbn);
            $cmd->bindValue(":data_emprestimo", $data_emprestimo);
            $cmd->bindValue(":data_devolucao", $data_devolucao);
            $cmd->bindValue(":fk_id", $id);
            $cmd->bindValue(":nome", $nome);
            $cmd->bindValue(":email", $email);
            $cmd->bindValue(":nome_livro", $nome_livro);
            $cmd->bindValue(":devolvido", $devolvido);
            $cmd->execute();

            $quantidade = $quantidade - '1';
            $cmd = $this->pdo->prepare("UPDATE livros SET quantidade = :quantidade, fk_id_pessoa = :id WHERE isbn = :isbn");
            $cmd->bindValue(":isbn", $isbn);
            $cmd->bindValue(":quantidade", $quantidade);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            return 1;
        }    

    }

    public function devolver($isbn, $id)
    {    
        $cmd = $this->pdo->prepare("SELECT * from livros WHERE isbn = :isbn");
        $cmd->bindValue(":isbn", $isbn);
        $cmd->execute();
        $dados = $cmd->fetch();
        $fk_id_pessoa = $dados['fk_id_pessoa']; 
        $quantidade = $dados['quantidade'];

        $dados = array();
        $cmd = $this->pdo->prepare("SELECT * from pessoa_livro WHERE fk_isbn = :isbn and fk_id = :fk_id AND devolvido = '0'");
        $cmd->bindValue(":isbn", $isbn);
        $cmd->bindValue(":fk_id", $fk_id_pessoa);
        $result = $cmd->execute();
        $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        if($dados == false){
            return 0;
        }
        $id_emprestimo = $dados['id_emprestimo'];
        

        if($id != $dados['fk_id'])
        {
            return 0;
        }
        else
        {
            $devolvido = 1;
            $quantidade = $quantidade + '1';
            $cmd = $this->pdo->prepare("UPDATE livros SET quantidade = :quantidade WHERE fk_id_pessoa = :fk_id_pessoa AND isbn = :isbn");
            $cmd->bindValue(":fk_id_pessoa", $fk_id_pessoa);
            $cmd->bindValue(":quantidade", $quantidade);
            $cmd->bindValue(":isbn", $isbn);
            $cmd->execute();
            
            $cmd = $this->pdo->prepare("UPDATE pessoa_livro SET devolvido = :devolvido WHERE fk_id = :fk_id AND fk_isbn = :fk_isbn");
            $cmd->bindValue(":fk_id", $fk_id_pessoa);
            $cmd->bindValue(":devolvido", $devolvido);
            $cmd->bindValue(":fk_isbn", $isbn);
            $cmd->execute();

            $cmd = $this->pdo->prepare("UPDATE emprestimo SET devolvido = :d WHERE fk_id = :fk_id AND fk_isbn = :fk_isbn");
            $cmd->bindValue(":fk_id", $fk_id_pessoa);
            $cmd->bindValue(":d", $devolvido);
            $cmd->bindValue(":fk_isbn", $isbn);
            $cmd->execute();
 
            $cmd = $this->pdo->prepare("DELETE FROM pessoa_livro WHERE id_emprestimo = :id_emprestimo");
            $cmd->bindValue(":id_emprestimo", $id_emprestimo);
            $cmd->execute();
            return 1;
        }
        
    }

    public function reservar()
    {
        return true;
    }

    public function buscarDadosEmprestimo($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM emprestimo WHERE fk_id = :fk_id");
        $cmd -> bindValue(":fk_id", $id);
        $cmd -> execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function ListarDadosEmprestimos()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM emprestimo ORDER BY email_pessoa");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}        
?>