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
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified CSS DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
    <!--Favicon -->
    <link rel="icon" type="image/x-icon" href="img/icon.png">
      <link rel="stylesheet" href="style.css">
    <title>Consulta de usuário</title>
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
                if(isset($_GET['id_up']) && !empty($_GET['id_up']))
                {
                    $id_upd = addslashes($_GET['id_up']);
                    $nome = addslashes($_POST['nome']);// addslashes = permite que consiga pegar o valor digitado no input de forma segura e salvar na variavel
                    $telefone = addslashes($_POST['telefone']);
                    $email = addslashes($_POST['email']);
                    $endereco = addslashes($_POST['endereco']);
                    $senha = addslashes($_POST['senha']);
                    $permissao = addslashes($_POST['permissao']);

                        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($endereco) && !empty($senha) && !empty($permissao)) //empty = verifica se não esta vazio a variavel
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
            }else if(isset($_GET['id']))
            {
                $id_pessoa = addslashes($_GET['id']);
                
                if($p->excluirPessoa($id_pessoa) == 1)
                {
                    header("location: consulta-usuario.php");
                    exit();
                }
                else if($p->excluirPessoa($id_pessoa) == 0)
                {
                    ?>
                    <div class="aviso">
                        <h4 class="alert-message">Você não pode apagar usuário que esteja vinculado a emprestimos no banco de dados.</h4>
                    </div> 
                    <?php
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
            <section >
                <h5 class="center light"><strong> LISTA DE USUÁRIO </strong> </h5>
                <table id="table-format" class="display responsive-table" >
                    <thead>    
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>TELEFONE</th>
                            <th>EMAIL</th>
                            <th>ENDEREÇO</th>
                            <th>PERMISSÃO</th>
                            <th>OPÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dados = $p->buscarDados();
                            if(count($dados) > 0)// verifica se tem pessoas cadastradas no banco
                            {
                                for($i=0; $i < count($dados); $i++){
                                    echo"<tr>";
                                    foreach($dados[$i] as $k => $v){
                                        if($k != "senha"){
                                            echo "<td>".$v."</td>";
                                            }
                                    }
                                    ?>
                                        <td>
                                            <a class="blue-text text-darken-4" href="editar-usuario.php?id_up=<?php echo $dados[$i]['id'];?>"><span class="material-icons">edit</span></a>
                                            <a class="blue-text text-darken-4" href="consulta-usuario.php?id=<?php echo $dados[$i]['id'];?>"><span class="material-icons">delete</span></a>
                                        </td>
                                    <?php
                                    echo "</tr>";
                                }
                            }
                            else // se o banco estiver vazio
                            {
                            ?> 
                            
                            <div class="aviso">
                                <h4>Ainda não há pessoas cadastradas!</h4>
                            </div> 
                             <?php
                             }
                            ?>
                    </tbody>                    
                </table>
            </div> 
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



