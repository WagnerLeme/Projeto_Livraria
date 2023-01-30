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
                if(isset($_GET['isbn_up']) && !empty($_GET['isbn_up']))
                {
                    $isbn = addslashes($_POST['isbn']);
                    $nome = addslashes($_POST['nome']);
                    $edicao = addslashes($_POST['edicao']);
                    $editora = addslashes($_POST['editora']);
                    $autor = addslashes($_POST['autor']);
                    $dataPublicacao = addslashes($_POST['dataPublicacao']);
                    $idioma = addslashes($_POST['idioma']);
                    $numeroPagina = addslashes($_POST['numeroPagina']);
                    $categoria = addslashes($_POST['categoria']);
                    $quantidade = addslashes($_POST['quantidade']);

                        if(!empty($isbn) && !empty($nome) && !empty($edicao) && !empty($editora) && !empty($autor) && !empty($dataPublicacao) && !empty($idioma) && !empty($numeroPagina) && !empty($categoria) && !empty($quantidade)) 
                        {
                        $l->atualizarDadosLivro($isbn, $nome, $edicao, $editora, $autor, $dataPublicacao, $idioma, $numeroPagina, $categoria, $quantidade);
                        header("location: consulta-livro.php");
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
        
            if(isset($_GET['isbn_up']))
            {
                $id_update = addslashes($_GET['isbn_up']);
                $res = $l->buscarDadosLivro($id_update);
            }
        ?>

        <div class="row container">

                <section class="col s12"  id="esquerda">
                    <form method="POST">
                        <h3 class="center light">ATUALIZAR LIVRO</h3>
                        <label for="isbn">ISBN</label>
                        <input type="number" name="isbn" id="isbn" maxlength="40"
                        value="<?php if(isset($res)){echo $res['isbn'];}else{echo $res['isbn'];}?>"
                        >
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" maxlength="40"
                        value="<?php if(isset($res)){echo $res['nome'];}?>"
                        >
                        <label for="edicao">Edição</label>
                        <input type="text" name="edicao" id="edicao" maxlength="40"
                        value="<?php if(isset($res)){echo $res['edicao'];}?>"
                        >
                        <label for="editora">Editora</label>
                        <input type="text" name="editora" id="editora" maxlength="40"
                        value="<?php if(isset($res)){echo $res['editora'];}?>"
                        >
                        <label for="autor">Autor</label>
                        <input type="text" name="autor" id="autor" maxlength="40"
                        value="<?php if(isset($res)){echo $res['autor'];}?>"
                        >
                        <label for="dataPublicacao">Data de Publicação</label>
                        <input type="date" name="dataPublicacao" id="dataPublicacao" maxlength="40"
                        value="<?php if(isset($res)){echo $res['dataPublicacao'];}?>"
                        >
                        <label for="idioma">Idioma</label>
                        <input type="text" name="idioma" id="idioma" maxlength="40"
                        value="<?php if(isset($res)){echo $res['idioma'];}?>"
                        >
                        <label for="numeroPagina">Numero de página</label>
                        <input type="number" name="numeroPagina" id="numeroPagina" maxlength="40"
                        value="<?php if(isset($res)){echo $res['numeroPagina'];}?>"
                        >

                        <label>Cetegoria</label>
                            <select type="text" class="browser-default" name="categoria">
                                <option value="<?php if(isset($res)){echo $res['categoria'];}?>"></option>
                                <option value="<?php if(isset($res)){echo "leitura-comportamento";}else{echo "leitura-comportamento";}?>">Leitura e comportamento</option>
                                <option value="<?php if(isset($res)){echo "tecnicos-profissionais";}else{echo "tecnicos-profissionais";}?>">Técnicos e profissionais</option>
                                <option value="<?php if(isset($res)){echo "equilibrio-pessoal";}else{echo "equilibrio-pessoal";}?>">Equilíbrio Pessoal</option>
                                <option value="<?php if(isset($res)){echo "periodicos";}else{echo "periodicos";}?>">Periódicos</option>
                            </select>
                            <br>
                        
                        <label for="quantidade">Quantidade</label>
                        <input type="number" name="quantidade" id="quantidade" maxlength="40"
                        value="<?php if(isset($res)){echo $res['quantidade'];}?>"
                        >

                        <input type="submit" class="btn blue darken-4 white-text  waves-light col s12"
                        value="<?php if(isset($res)){echo "Atualizar";}?>">
                    </form>
            </section>
        </div> 
</main> 
</body>
</html>