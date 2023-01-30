<?php
    require_once 'classe-usuario.php';
    session_start();
    if(isset($_SESSION['id_usuario']))
    {
        $us = new Usuario("CRUDPDO","localhost","root","");
        $informacoes = $us->buscarDadosUser($_SESSION['id_usuario']);
    }
    elseif(isset($_SESSION['id_master']))
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
    <!--Favicon -->
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Gestão de Livros - Consultas</title>
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
                            elseif(isset($_SESSION['id_usuario']))
                            {
                                ?>
                                <li><a href="perfil-usuario.php">Perfil</a></li>
                                <li><a href="consultar-livro.php">Consultar Livro</a></li>
                                <li><a href="sair.php">Sair</a></li>
                                <?php
                            }
                            else {
                                header("location: login.php");
                            }
                        ?>
                    </ul>
            </div>
        </nav>
    </div>
    </header> 
    <main class="corpo-cadastro-livro">
        <div class="row container ">
                <?php
                    if(isset($_SESSION['id_master']) || isset($_SESSION['id_usuario']))
                    {
                        ?>
                        <h5 class="light center">
                        <?php 
                            echo "Olá <strong>"; 
                            echo $informacoes['nome'];
                            echo " </strong> , seja bem vindo(a)!";
                            ?>
                        </h5>
                        <?php
                    }
                ?>
            <div class="col s12 m12 l4">  
        <?php
            if(isset($_SESSION['id_master']))
            { 
                ?>
                   <div class="card">
                        <div class="card-image">
                            <img src="img/consulta-usuario.jpg">
                        </div>

                        <div class="card-content">
                        <h5 class="title-cards light">CONSULTA DE USUÁRIO </h5>
                            <p>Utilize esse serviço para consultar usuário cadastrados.
                            </p>
                        </div>

                        <div class="card-action">
                            <a class="blue-text darken-4" href="consulta-usuario.php">CONSULTAR</a>
                        </div>
                    </div>
            </div>

            <div class="col s12 m12 l4">
                <div class="card">
                        <div class="card-image">
                            <img src="img/buscar-livro.jpg">
                        </div>

                        <div class="card-content">
                        <h5 class="title-cards light">CONSULTA DE LIVROS </h5>
                            <p>Utilize esse serviço para consultar livros cadastrado no sistema.</p>
                        </div>
                        
                        <div class="card-action">
                            <a class="blue-text darken-4" href="consulta-livro.php">CONSULTAR</a>
                        </div>
                </div>
            </div>

            <div class="col s12 m12 l4">
                <div class="card">
                        <div class="card-image">
                            <img src="img/emprestimo.jpg">
                        </div>

                        <div class="card-content">
                        <h5 class="title-cards light">EMPRÉSTIMOS</h5>
                            <p>Utilize esse serviço para consultar todos os emprestimos.</p>
                        </div>
                        
                        <div class="card-action">
                            <a class="blue-text darken-4" href="consulta-emprestimos.php">CONSULTAR</a>
                        </div>
                </div>
            </div>
        </div>
            <?php
            }
            elseif(isset($_SESSION['id_usuario']))
            { 
                header("location: areaPrivada.php");
            }
                ?>
    </main>

            <!--RODAPÉ-->
            <footer class="rodape">
        <div class="row container center">
            
            <p class="light white-text">&copy Sistema de Gestão e Controle de Livros - 2023 - Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>