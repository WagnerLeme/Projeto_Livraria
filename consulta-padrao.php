<?php
require_once 'classe-livro.php';
require_once 'classe-usuario.php';
$l = new Livro("crudpdo", "localhost", "root", "");
?>

<?php
session_start();
if(isset($_SESSION['id_usuario']))
    {
        $us = new Usuario("CRUDPDO","localhost","root","");
        $informacoes = $us->buscarDadosUser($_SESSION['id_usuario']);
    }
?>

<?php
if(isset($_SESSION['id_master']))
{
    header("location: areaPrivada.php");
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
     <!--Compiled and minified CSS DATATABLE -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
        <!--Favicon -->
        <link rel="icon" type="image/x-icon" href="img/icon.png">
      <link rel="stylesheet" href="style.css">
    <title>Biblioteca</title>
</head>
<body>
    <header> 
    <div class="navbar-fixed">
        <nav class="blue darken-4">
            <div class="nav-wrapper container ">
            <a href="areaPrivada.php" class="brand-logo hide-on-med-and-down"><img src="img/logo-saberAprender.svg" alt="logo-livraria"> </a>
                <ul id="nav-mobile" class="right">
                <?php
                    if(isset($_SESSION['id_usuario']))
                    {
                        ?>
                        <li><a href="consulta-livro.php" title="Livros Cadastrados"><span class="material-icons">manage_search</span></a></li>
                        <li><a href="historico-emprestimo.php" title="Histórico"><span class="material-icons"><span class="material-icons">fact_check</span></span></a></li>
                        <li><a href="sair.php" title="Sair"><span class="material-icons">logout </span></a></li>
                        <li><a><span class="material-icons">person</span> &nbsp <?php echo $informacoes['nome']?></a></li>
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
 </div>
    <main>
 
        <?php
        
            if(isset($_GET['isbn_up']))
            {
                 if(isset($_SESSION['id_usuario']))
                    {
                        $us = new Usuario("CRUDPDO","localhost","root","");
                        $informacoes = $us->buscarDadosUser($_SESSION['id_usuario']);
                        
                        $isbn = addslashes($_GET['isbn_up']);

                        $quantidade = addslashes($_GET['quantidade']);
                        
                        if($quantidade >= 1)
                        {
                            $res = $us->emprestar($isbn, $informacoes['id']);
                            
                            if($res == 0){
                            
                                ?>
                                <div class="aviso container">
                                    <h4 class="alert-message">Você já esta com esse livro emprestado, devolva antes de solicitar ele novamente</h4>
                                </div> 
                                <?php     
                            }
                            else
                            {
                                ?>
                                <div class="aviso container">
                                    <h4 class="alert-message">Emprestado com sucesso</h4>
                                </div> 
                                <?php
                            }
                        }
                        else if($quantidade < 1){
                            $reservar = $us->reservar();
                            if($reservar == true)
                            {
                                ?>
                                <div class="aviso container">
                                    <h4 class="alert-message">Reservado com sucesso!</h4>
                                </div> 
                                <?php
                            }
                        }

                    }
            }
            else if(isset($_GET['id']))
            { 
                $id = addslashes($_GET['id']);
                $res = $us->devolver($id, $informacoes['id']);
                if($res == 0)
                {
                    ?>
                        <div class="aviso container">
                            <h4 class="alert-message">Você não esta com esse livro para devolver!</h4>
                        </div> 
                    <?php
                      
                }
                else if($res == 1)
                {
                    
                    ?>
                        <div class="aviso container">
                            <h4 class="alert-message">Livro devolvido com sucesso!</h4>
                        </div> 
                    <?php
                }
                
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
                            <th>DATA PUBLICAÇÃO</th>                           
                            <th>CATEGORIA</th>
                            <th>QTD</th>
                            <th>EMPRESTAR / DEVOLVER</th>
                        </tr>
                    </thead>
                    <tbody>  
                    <?php
                        $dados = $l->ListarDadosLivro();
                        if(count($dados) > 0)
                        {
                            for($i=0; $i < count($dados); $i++){
                                echo"<tr>";
                                foreach($dados[$i] as $k => $v){
                                    if($k != "isbn" && $k != "reservar" && $k != "fk_id_pessoa" && $k != "idioma" && $k != "numeroPagina"){
                                        echo "<td>".$v."</td>";
                                    } 
                            }
                        ?>
                                <td>
                                    <a class="blue-text text-darken-4" title="Emprestar/Reservar" href="consulta-padrao.php?isbn_up=<?php echo $dados[$i]['isbn'];?>&quantidade=<?php echo $dados[$i]['quantidade'];?>"><span class="material-icons">person_add_alt</span> <?php if($dados[$i]['quantidade']>=1) echo "";else echo "";?></a>
                                    <a class="blue-text text-darken-4" title="Devolver" href="consulta-padrao.php?id=<?php echo $dados[$i]['isbn'];?> "><span class="material-icons">person_remove</span></a>  
                                </td>
                            <?php
                            echo "</tr>";
                        }
                    }else
                    {
                    ?>  
                              <div class="aviso">
                                <h4>Ainda não há livros cadastradas!</h4>
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




