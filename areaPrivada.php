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
    <title>Gestão de Livros - Bem-vindo</title>
</head>
<body>
    <header> 
        <div class="navbar-fixed">
            <nav class="blue darken-4">
                <div class="nav-wrapper container">
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
                                <li><a href="consulta-livro.php" title="Livros Cadastrados"><span class="material-icons">manage_search</span></a></li>
                                <li><a href="historico-emprestimo.php" title="Histórico"><span class="material-icons"><span class="material-icons">fact_check</span></span></a></li>
                                <li><a href="sair.php" title="Sair"><span class="material-icons">logout </span></a></li>
                                <li><a><span class="material-icons">person</span> &nbsp <?php echo $informacoes['nome']?></a></li>
                                <?php
                            }
                            else 
                            {
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
            
                <?php
                    if(isset($_SESSION['id_master']))
                    { 
                ?>
                
                        <div class="col s12 m12 l4">  
                            <div class="card">
                                <div class="card-image">
                                    <img src="img/livro.png">
                                    <!--<span class="card-title">CADASTRAR USUÁRIO</span>-->
                                </div>

                                <div class="card-content">
                                    <h5 class="title-cards light">CADASTRO DE USUÁRIO </h5>
                                    <p>Aqui você pode cadastrar um novo usuário da livraria.
                                    </p>
                                </div>
                                <div class="card-action">
                                    <a class="blue-text darken-4" href="cadastro-usuario.php">Novo usuário</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="card-image">
                                    <img src="img/cadastrar-usuario.jpg">
                                    <!-- <span class="card-title">CADASTRAR LIVRO</span>-->
                                </div>
                                <div class="card-content">
                                <h5 class="title-cards light">CADASTRO DE LIVRO </h5>
                                    <p>Aqui você pode cadastrar novos exemplares</p>
                                </div>
                                <div class="card-action">
                                    <a class="blue-text darken-4" href="cadastro-livro.php">cadastrar livro</a>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="card-image">
                                    <img src="img/consultar-livros.jpg">
                                    <!--<span class="card-title">CONSULTAR</span>-->
                                </div>
                                <div class="card-content">
                                <h5 class="title-cards light">CONSULTAS </h5>
                                    <p>Realize consultas de: livros, reservas, entregas</p>
                                </div>
                                <div class="card-action">
                                    <a class="blue-text darken-4" href="consulta.php">consultar</a>
                                </div>
                            </div>
                        </div>

           
                    <?php
                        }
                            elseif(isset($_SESSION['id_usuario']))
                        { 
                    ?>
                        <div class="col s12 m6 l6">
                            <div class="card">
                                <div class="card-image ">
                                    <img src="img/books-users.jpg">
                                    <!--<span class="card-title">LIVROS</span>-->
                                    <a href="consulta-padrao.php" class="btn-floating halfway-fab waves-effect waves-light blue darken-4"><i class="material-icons">input</i></a>
                                </div>
                                <div class="card-content">
                                    <h5 class="light"><strong> LIVROS </strong></h5>
                                    <p>Utilize este canal para conhecer as opções de livros.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="card">
                                <div class="card-image">
                                <img src="img/emprestimo-user.jpg">
                               <!-- <span class="card-title">HISTORICO DE EMPRESTIMO</span> -->
                                <a href="historico-emprestimo.php" class="btn-floating halfway-fab waves-effect waves-light blue darken-4"><i class="material-icons">input</i></a>
                                </div>
                                <div class="card-content">
                                <h5 class="light"><strong> EMPRÉSTIMOS </strong></h5>
                                <p>Consultar: Histórico | Reservas | Datas de entregas.</p>
                                </div>
                            </div>
                        </div>                     
        </div>

        <?php
            }
            else 
            {
                header("location: login.php");
            }
        ?>
    </main>
        <!--RODAPÉ-->
    <footer class="rodape">
        <div class="row container center">
            
            <p class="light white-text">&copy Sistema de Gestão e Controle de Livros - 2023 - Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- MATERIALIZE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

        <script>
        // INICIALIZAÇÃO 
        $(document).ready(function () {
            // MENU MOBILE
            $(".button-collapse").sideNav();

        });
        // ADICIONANDO NAVCOLOR
        $(window).on("scroll", function () {
            if ($(window).scrollTop() > 100) {
                $(".navbar").addClass("nav-color");
            } else {
                $(".navbar").removeClass("nav-color");
            }
        });

</body>
</html>