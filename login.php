<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Favicon -->
      <link rel="icon" type="image/x-icon" href="img/icon.png">
    
    <title>Login</title>
</head>
<body class="fundo-login">


    <div class="row container formulario">
        <div class="image-login">
             <img src="img/animacao.svg" class="col s12 m6 l6 img-login-inicio" alt="login">
        </div>
       
            <h5 class="center light title-form"><strong>Bem-vindo. Faça seu login!</strong></h5>
                <form class="col s12 m6 l6 " method="POST">
                    <input id="input-login" type="email" name="email" placeholder="E-mail" maxlength="40">
                    <input id="input-login" type="password" name="senha" placeholder="Senha" maxlength="32">
                    <input class="waves-effect waves-light btn col s12  blue darken-4" type="submit" value="ACESSAR" id="botao-login">
                </form>

    </div>


    <script>
        $(document).ready(function(){

            setTimeout(function(){
                $(".alert").alert('close');
            }, 5000);

            $(".navbar-toggle").click(function(){
                $(".sidebar").toggleClass("sidebar-open");
            });
        });
    </script>

</body>
</html>

<!--------------------------------PHP--------------------------------->
<?php

if(isset($_POST['email']))
{
    $email = htmlentities(addslashes($_POST['email']));
    $senha = htmlentities(addslashes($_POST['senha'])); 
    
    if(!empty($email) && !empty($senha))
    {
        require_once 'classe-usuario.php';
        $us = new Usuario("crudpdo","localhost","root","");
        if($us->logar($email, $senha))
        {
            header("location: areaPrivada.php");
        }
        else
        {
            ?>
                <div class="aviso container alert">
                    <h4 class="alert-message"><?php echo"Email e/ou senha estão incorretos"?></h4>
                </div> 
            <?php
            
        }
    }
    else
    {
        
        ?>            
               <div class="aviso container alert">
                    <h4 class="alert-message"><?php echo"Preencha todos os campos!"?></h4>
                </div> 
            <?php
    }
}
?>

