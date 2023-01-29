<?php
require_once 'classe-pessoa.php';
$p = new Pessoa("crudpdo", "localhost", "root", "");
?>

<?php
session_start();
if(!isset($_SESSION['id_master']))
{
    header("location: areaPrivada.php");
}
?>

<?php
    require_once 'classe-usuario.php';
    if(isset($_SESSION['id_master']))
    {
        $us = new Usuario("CRUDPDO","localhost","root","");
        $informacoes = $us->buscarDadosUser($_SESSION['id_master']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <!--Favicon -->
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title>Cadastro de usuário</title>
</head>
<body>
    <header> 
    <div class="navbar-fixed">
        <nav class="blue darken-4">
            <div class="nav-wrapper container ">
            <a href="areaPrivada.php" class="brand-logo hide-on-med-and-down"><img src="img/logo-saberAprender.svg" alt="logo-livraria"> </a>
                <ul id="nav-mobile" class="right">
                <?php
                    if(isset($_SESSION['id_master']))
                    { 
                        ?>
                        <li><a href="cadastro-usuario.php"><span class="material-icons" title="Cadastrar Usuário">person_add</span></a></li>
                        <li><a href="cadastro-livro.php" title="Cadastrar Livro"><span class="material-icons">menu_book</span></a></li>
                        <li><a href="consulta.php" title="Consultar"><span class="material-icons">search</span></a></li>
                        <li><a href="sair.php" title="Sair"><span class="material-icons">logout </span></a></li>
                        <li><a><?php echo $informacoes['nome']?></a></li>
                        <?php
                    }
                    else 
                    {
                        header("location: areaPrivada.php");
                    }
                ?>
                </ul>
            </div>
        </nav> 
    </div>       
     </header> 
    <main>

        <?php
            //--------------------------- CADASTRO DE USUÁRIO -----------------------------

            if(isset($_POST['nome']))// isset verifica se existe o array post chamado nome; e i IF VERIFICA SE A PESSOA CLICOU NO BOTÃO CADASTRAR OU NO BOTÃO EDITAR
            {
                    $nome = addslashes($_POST['nome']);// addslashes = permite que consiga pegar o valor digitado no input de forma segura e salvar na variavel
                    $telefone = addslashes($_POST['telefone']);
                    $email = addslashes($_POST['email']);
                    $endereco = addslashes($_POST['endereco']);
                    $senha = addslashes($_POST['senha']);
                    $permissao = addslashes($_POST['permissao']);

                        if(!empty($nome) && !empty($telefone) && !empty($email)  && !empty($endereco) && !empty($senha) && !empty($permissao)) //empty = verifica se não esta vazio a variavel
                        {
                            if($p->cadastrarPessoa($nome,$telefone, $email, $endereco, $senha, $permissao) == true)
                            {
                                    ?>
                                        <div class="aviso">
                                            <h4 class="alert-message">Cadastrado com sucesso!</h4>
                                        </div> 
                                    <?php
         
                            }
                            else  
                            {
                                ?>
                                    <div class="aviso">
                                        <h4 class="alert-message">Email já cadastrado!</h4>
                                    </div> 
                                <?php
                            }
                        }
                }
        ?>

        <div class="row container">

            <section class="col s12"  id="esquerda">
            <form method="POST">
                        <h5 class="center light"><strong>CADASTRO DE USUARIO</strong></h5>
                        
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['nome'];}?>"
                        >
                        <label for="telefone">Telefone</label>
                        <input type="tel" name="telefone" id="telefone" maxlength="20" required 
                        value="<?php if(isset($res)){echo $res['telefone'];}?>"
                        >
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['email'];}?>"
                        >
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" maxlength="50" required 
                        value="<?php if(isset($res)){echo $res['endereco'];}?>"
                        >
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" maxlength="32" required 
                        value="<?php if(isset($res)){echo $res['senha'];}?>"
                        >
                        
                        <label>Permissão</label>
                            <select type="text" class="browser-default" name="permissao">
                                <option value="" disabled selected>Escolha sua opção</option>
                                <option required value="<?php if(isset($res)){echo "Administrador";}else{echo "Administrador";}?>">Administrador</option>
                                <option required value="<?php if(isset($res)){echo "Padrão";}else{echo "Padrão";}?>">Padrão</option>
                            </select>
                            <br>

                        <input type="submit" class="btn blue darken-4 white-text  waves-light col s12" 
                        value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>">
                    </form>
            </section>
        </div>
    </main> 
        
        <!--RODAPÉ-->
        <footer class="rodape">
        <div class="row container center">
            
            <p class="light white-text">&copy Sistema de Gestão e Controle de Livros - 2023 - Todos os direitos reservados.</p>
        </div>
    </footer>


 <!-- Compiled and minified JavaScript --> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
         
        <script>
                $(document).ready(function(){
                    $('select').formSelect();
                });
        </script>
</body>
</html>



