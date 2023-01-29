<?php
require_once 'classe-usuario.php';
$u = new Usuario;


if(isset($_POST['email']))
{
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']); 
    
    if(!empty($email) && !empty($senha))
    {
        $u->conectar("CRUDPDO", "localhost", "root", "");
        if($u->msgErro == "")
        {
            if($u->logar($email, $senha))
            {
                header("location: areaPrivada.php");
            }
            else
            {   
              //header("location: login.php");
            }       
        }
        else
        {
            echo "Erro: ".$u->msgErro;
        }
    }
    else
    {
        echo "Preencha todos os campos!";
    }
}



?>