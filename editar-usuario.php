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
    <!--<link rel="stylesheet" href="style.css">-->
    <title>Cadastro de usuário</title>
</head>
<body>
    <header> 
        <nav class="blue darken-4">
            <div class="nav-wrapper container ">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php
                    if(isset($_SESSION['id_master']))
                    { 
                        ?>
                            <li><a href="cadastro-usuario.php">Cadastro Usuário</a></li>
                            <li><a href="cadastro-livro.php">Cadastro Livro</a></li>
                            <li><a href="#">Consultar</a></li>
                            <li><a href="sair.php">Sair</a></li>
                            <li><a href="#"><?php echo $informacoes['nome']?></a></li>
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
     </header> 
    <main>

        <?php
            if(isset($_POST['nome']))
            {
                //---------------------- EDITAR ----------------------
                if(isset($_GET['id_up']) && !empty($_GET['id_up']))
                {
                    $id_upd = addslashes($_GET['id_up']);
                    $nome = addslashes($_POST['nome']);
                    $telefone = addslashes($_POST['telefone']);
                    $email = addslashes($_POST['email']);
                    $endereco = addslashes($_POST['endereco']);
                    $senha = addslashes($_POST['senha']);
                    $permissao = addslashes($_POST['permissao']);

                        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($endereco) && !empty($senha) && !empty($permissao)) 
                        {
                        $p->atualizarDados($id_upd, $nome, $telefone, $email, $endereco, $senha, $permissao);
                        header("location: consulta-usuario.php");
                        }
                        else
                        {
                            ?>
                                <div class="aviso">
                                    <h4>Preencha todos os campos!</h4>
                                </div> 
                            <?php
                        }
                }
            }
        ?>
        <?php
        
            if(isset($_GET['id_up']))
            {
                $id_update = addslashes($_GET['id_up']);
                $res = $p->buscarDadosPessoa($id_update);
            }
        ?>


        <div class="row container">  
            <div class="exibicao-lista">
                <section class="col s12"  id="esquerda">
                    <form method="POST">
                        <h3 class="center light">ATUALIZAR CADASTRO</h3>
                        
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" maxlength="40"
                        value="<?php if(isset($res)){echo $res['nome'];}?>"
                        >
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" maxlength="15"
                        value="<?php if(isset($res)){echo $res['telefone'];}?>"
                        >
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" maxlength="40"
                        value="<?php if(isset($res)){echo $res['email'];}?>"
                        >
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" maxlength="50"
                        value="<?php if(isset($res)){echo $res['endereco'];}?>"
                        >
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" maxlength="32"
                        value="<?php if(isset($res)){echo $res['senha'];}?>"
                        >
                        
                        <label>Permissão</label>
                            <select type="text" class="browser-default" name="permissao">
                                <option value="<?php if(isset($res)){echo $res['permissao'];}?>"><?php if(isset($res)){echo $res['permissao'];}?></option>
                                <option value="<?php if(isset($res)){echo "Administrador";}else{echo "Administrador";}?>">Administrador</option>
                                <option value="<?php if(isset($res)){echo "Padrão";}else{echo "Padrão";}?>" <?php if(isset($res)){echo "Administrador";}else{echo "Administrador";}?>">Padrão</option>
                            </select>
                            <br>

                        <input class=" btn blue darken-4 text-white col s12" type="submit"
                        value="<?php if(isset($res)){echo "Atualizar";}?>">
                    </form>
                </section>
            </div>
        </div>  
    </main> 

    <?php
    if(isset($_GET['id']))
    {
        $id_pessoa = addslashes($_GET['id']);
        $p->excluirPessoa($id_pessoa);
        header("location: consulta-usuario.php");
        exit();
    }
?>
             
 <!-- Compiled and minified JavaScript --> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
         
</body>
</html>



