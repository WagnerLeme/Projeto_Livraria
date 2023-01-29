<?php
require_once 'classe-livro.php';
$l = new Livro("crudpdo", "localhost", "root", "");
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
    <title>Cadastro de livro</title>
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
<main class="corpo-cadastro-livro">  
        <?php
            if(isset($_POST['nome']))// isset verifica se existe o array post chamado nome; e i IF VERIFICA SE A PESSOA CLICOU NO BOTÃO CADASTRAR OU NO BOTÃO EDITAR
            {
                    $isbn = addslashes($_POST['isbn']);
                    $nome = addslashes($_POST['nome']);// addslashes = permite que consiga pegar o valor digitado no input de forma segura e salvar na variavel
                    $edicao = addslashes($_POST['edicao']);
                    $editora = addslashes($_POST['editora']);
                    $autor = addslashes($_POST['autor']);
                    $dataPublicacao = addslashes($_POST['dataPublicacao']);
                    $idioma = addslashes($_POST['idioma']);
                    $numeroPagina = addslashes($_POST['numeroPagina']);
                    $categoria = addslashes($_POST['categoria']);
                    $quantidade = addslashes($_POST['quantidade']);

                        if(!empty($isbn) && !empty($nome) && !empty($edicao) && !empty($editora) && !empty($autor) && !empty($dataPublicacao) && !empty($idioma)&& !empty($numeroPagina) && !empty($categoria) && !empty($quantidade)) //empty = verifica se não esta vazio a variavel
                        {
                            if($l->cadastrarLivro($isbn, $nome, $edicao, $editora, $autor, $dataPublicacao, $idioma, $numeroPagina, $categoria, $quantidade) == true)
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
                                    <h4 class="alert-message">O Livro já foi cadastrado!</h4>
                                </div> 
                                <?php
                            }
                        }
            }
        ?>
        <div class="row container">
                <section class="col s12"  id="esquerda">
                    <form method="POST">
                        <h5 class="center light"><strong>CADASTRO DE LIVRO<strong></h5>
                        <label for="isbn">ISBN</label>
                        <input type="number" name="isbn" id="isbn" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['isbn'];}?>"
                        >
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['nome'];}?>"
                        >
                        <label for="edicao">Edição</label>
                        <input type="text" name="edicao" id="edicao" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['edicao'];}?>"
                        >
                        <label for="editora">Editora</label>
                        <input type="text" name="editora" id="editora" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['editora'];}?>"
                        >
                        <label for="autor">Autor</label>
                        <input type="text" name="autor" id="autor" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['autor'];}?>"
                        >
                        <label for="dataPublicacao">Data de Publicação</label>
                        <input type="date" name="dataPublicacao" id="dataPublicacao" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['dataPublicacao'];}?>"
                        >
                        <label for="idioma">Idioma</label>
                        <input type="text" name="idioma" id="idioma" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['idioma'];}?>"
                        >
                        <label for="numeroPagina">Numero de página</label>
                        <input type="number" name="numeroPagina" id="numeroPagina" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['numeroPagina'];}?>"
                        >

                        <label>Cetegoria</label>
                            <select type="text" class="browser-default" name="categoria" required >
                                <option value="" disabled selected>Escolha sua opção</option>
                                <option value="Leitura Comportamento">Leitura e comportamento</option>
                                <option value="Tecnico Profissionais">Técnicos e profissionais</option>
                                <option value="Equilibrio Pessoal">Equilíbrio Pessoal</option>
                                <option value="Periodicos">Periódicos</option>
                            </select>
                            <br>
                        
                        <label for="quantidade">Quantidade</label>
                        <input type="number" name="quantidade" id="quantidade" maxlength="40" required 
                        value="<?php if(isset($res)){echo $res['quantidade'];}?>"
                        >

                        <input type="submit"class="btn blue darken-4 white-text  waves-light col s12" 
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
              
</body>
</html>

