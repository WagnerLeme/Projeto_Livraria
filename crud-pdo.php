<?php
//--------------- CONEXÃO ----------------------

try
{
    $pdo = new PDO("mysql:dbname=CRUDPDO;host=localhost","root",""); // conexão com o banco 
    //dbname // host //usuario e senha

}
catch(PDOException $e)
{
    echo "Erro com banco de dados: " .$e ->getMessage();
}
catch(Exception $e)
{
    echo "Erro generico: " .$e ->getMessage();
}

//--------------- INSERT ----------------------

//1 forma: quando prrecisamos passar um parametro e depois substituir
//$res = $pdo -> prepare("INSERT INTO pessoa(nome, telefone, email, endereco, senha) VALUE (:n, :e, :t,:endereco, :s)");

//$res->bindValue(":n","Teste Wagner");
//$res->bindValue(":t","00 0 0000 0000");
//$res->bindValue(":e","wagner.leme@gmail.com");
//$res->bindValue(":endereco","R. Benetido Rita");
//$res->bindValue(":s","123456");
//$res->execute();


//2 - forma: ele não precisa substituir, vai e executa direto
//$res = $pdo->query("INSERT INTO pessoa(nome, telefone, email, endereco, senha) VALUE ('Paulo','00 0 0000 0000', 'wagner.leme@gmail.com', 'R. Benetido Rita', '123456')"); 

//--------------- DELETE E UPDATE ----------------------
//$cmd = $pdo->prepare("DELETE FROM pessoa WHERE id = :id");
//$id = 2;
//$cmd->bindValue(":id", $id);
//$cmd->execute();
// OU
//$res = $pdo->query("DELETE FROM pessoa WHERE id = '3' ");

//$cmd = $pdo->prepare("UPDATE pessoa SET email = :e WHERE id = :id");
//$cmd->bindValue(":e", "Paulo@gmail.com");
//$cmd->bindValue(":id", 5);
//$cmd->execute();

//$res = $pdo->query("UPDATE pessoa SET email = 'paulo2@hotmail.com' WHERE id = '6' ");
//--------------- SELECT ----------------------

//$cmd = $pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
//$cmd->bindValue(":id", 9);
//$cmd->execute();
//$resultado = $cmd->fetch(PDO::FETCH_ASSOC);

//foreach($resultado as $key => $value)
//{
 //   echo $key.": ".$value. "<br>";
//}

?>