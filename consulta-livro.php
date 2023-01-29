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
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
     <!-- Compiled and minified CSS DATATABLE -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
        <!--Favicon -->
        <link rel="icon" type="image/x-icon" href="img/icon.png">
      <link rel="stylesheet" href="style.css">
     
    <title>Consulta de livros</title>
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
                //---------------------- EDITAR ----------------------
                if(isset($_GET['isbn_up']) && !empty($_GET['isbn_up']))
                {
                    $isbn_up = addslashes($_GET['isbn_up']);
                    $nome = addslashes($_POST['nome']);// addslashes = permite que consiga pegar o valor digitado no input de forma segura e salvar na variavel
                    $edicao = addslashes($_POST['edicao']);
                    $editora = addslashes($_POST['editora']);
                    $autor = addslashes($_POST['autor']);
                    $dataPublicacao = addslashes($_POST['dataPublicacao']);
                    $idioma = addslashes($_POST['idioma']);
                    $numeroPagina = addslashes($_POST['numeroPagina']);
                    $categoria = addslashes($_POST['categoria']);
                    $quantidade = addslashes($_POST['quantidade']);


                        
                        if(!empty($nome) && !empty($edicao) && !empty($editora) && !empty($autor) && !empty($dataPublicacao) && !empty($idioma)&& !empty($numeroPagina) && !empty($categoria) && !empty($quantidade)) //empty = verifica se não esta vazio a variavel
                        {
                        $p->atualizarDadosLivro($isbn_up, $nome, $edicao, $editora, $autor, $dataPublicacao, $idioma, $numeroPagina, $categoria, $quantidade);
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
            }else if(isset($_GET['id']))
            {
                $id_livro = addslashes($_GET['id']);
                if($l->excluirLivro($id_livro) == 1)
                {
                    header("location: consulta-livro.php");
                    exit();
                }
                else if($l->excluirLivro($id_livro) == 0)
                {
                    ?>
                    <div class="aviso">
                        <h4 class="alert-message">Você não pode apagar um livro vinculado ao usuário.</h4>
                    </div> 
                    <?php
                }

            }
        ?>
        <?php
        
            if(isset($_GET['isbn_up']))
            {
                $id_update = addslashes($_GET['isbn_up']);
                $res = $p->buscarDadosLivro($id_update);
            }
        ?>

        <div class="row container">  
            <div class="exibicao-lista row">
            <section class="col s12"  id="direita">
                <h5 class="center light"><strong> LISTA DE LIVROS </strong> </h5>
                <table id="table-format" class="display responsive-table">
                    <thead>
                        <tr>
                            <th>NOME</th>
                            <th>EDIÇÃO</th>
                            <th>EDITORA</th>
                            <th>AUTOR</th>
                            <th>D PUBLICAÇÃO</th>
                            <th>CATEGORIA</th>
                            <th>QTD</th>
                            <th>EDITAR/EXCLUIR</th>
                        </tr>
                    </thead>  
                    <tbody>  
                        <?php
                            $dados = $l->ListarDadosLivro();
                            if(count($dados) > 0)// verifica se tem LIVROS cadastradas no banco
                                {
                                    for($i=0; $i < count($dados); $i++){
                                    echo"<tr>";
                                    foreach($dados[$i] as $k => $v){
                                        if($k != "reservar" && $k != "fk_id_pessoa" && $k != "isbn" && $k != "numeroPagina" && $k != "idioma"){
                                            echo "<td>".$v."</td>";
                                        }    
                                    }
                                ?>
                                    <td>
                                        <a class="blue-text text-darken-4" href="editar-livro.php?isbn_up=<?php echo $dados[$i]['isbn'];?>"><span class="material-icons">edit</span></a>
                                        <a class="blue-text text-darken-4" href="consulta-livro.php?id=<?php echo $dados[$i]['isbn'];?>"><span class="material-icons">delete</span></a>
                                    </td>
                                <?php
                                echo "</tr>";
                            }
                       }else // se o banco estiver vazio
                       {
                       ?>  

                        <div class="aviso">
                            <h4 class="alert-message">Ainda não há livros cadastrados!</h4>
                        </div> 
                    <?php
                    }
                ?>
                </tbody>
            </table>
                      
            </section>
        </div>  
    </main>
            <!--RODAPÉ-->
    <footer class="rodape">
        <div class="row container center">
            
            <p class="light white-text">&copy Sistema de Gestão e Controle de Livros - 2023 - Todos os direitos reservados.</p>
        </div>
    </footer>


<!--Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!--Table JS -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>    
 <!-- Compiled and minified JavaScript --> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
 
 <script>

 $(document).ready(function () {
    $('#table-format').DataTable({
        "ordering": true,
        "paging": true,
        "searching": true,
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado na tabela",
            "sInfo": "Mostrar _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrar 0 até 0 de 0 Registros",
            "sInfoFiltered": "(Filtrar de _MAX_ total registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Mostrar _MENU_ registros por pagina",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Proximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Ultimo"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
});
</script>
 
 <script>
    $(document).ready( function () {
        $('#table-format').DataTable();
    } );
</script>

</body>
</html>



