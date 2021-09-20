<?php 
    ob_start();
    session_start();
    include('config.php'); 
    $consulta = $pdo->query('SELECT num_livro,vl_preco,ds_capa,qt_estoque FROM vw_livro');
    $categorias = $pdo->query('SELECT ds_categoria FROM tb_categoria');
    $valorCat = $categorias->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="author" content="Filipe Ferreiro">
        <meta name="description" content="Loja virtual para a venda de livros online">
        <meta name="keywords" content="HTML, CSS, PHP, Less, JQuery, Javascript, Loja virtual, comércio, vendas, livros, online, livros online, comprar livros, venda de livros, livraria, ecommerce">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
        <link href="<?php echo INCLUDE_PATH; ?>css/all.min.css" rel="stylesheet">
        <link href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <title>Filipinho livros | Livraria online</title>
    </head>
    <body>
        <header>
            <div class="container">
                <nav class="menu-desktop">
                    <div class="menu-left">
                        <span class="logomarca">Logomarca</span>
                        <ul>
                            <li><a title="Home" href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                            <li><a title="Lançamentos" href="<?php echo INCLUDE_PATH; ?>lancamentos">Lançamentos</a></li>
                            <li id="toggle">
                            <a title="Categorias">Categorias <i class="fas fa-chevron-down"></i></a>
                                <ul>
                                    <?php 
                                    foreach ($valorCat as $key => $value) {
                                    ?>
                                    <li><a href="<?php echo INCLUDE_PATH_CAT; ?>?<?php echo $value['ds_categoria']?>"><?php echo $value['ds_categoria']?></a></li>
                                    <?php } ?>
                                </ul>
                            </li><!--toggle-->
                        </ul>
                    </div><!--menu-left-->

                    <div class="menu-right">
                        <ul>
                            <li><a title="Contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                            <?php if(isset($_SESSION['ID']) == ''){?>
                            <li><a href="<?php echo INCLUDE_PATH; ?>login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                            <?php }else{
                                $usuario_login = $pdo->prepare("SELECT nome_usuario FROM `tb_usuarios` WHERE cod_usuario = ?");
                                $usuario_login->execute(array($_SESSION['ID']));
                                $exibe_usuario = $usuario_login->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <li><a href="<?php echo INCLUDE_PATH; ?>conta"><i class="fas fa-user"></i> <?php echo $exibe_usuario['nome_usuario']; ?></a></li>
                            <li><a href="<?php echo INCLUDE_PATH; ?>logout"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                            <?php } ?>
                        </ul>
                    </div><!--menu-right-->

                    <div class="menu-pesquisa">
                        <i class="fa fa-search"></i>
                        <form><input type="text"></form>
                    </div><!--menu-pesquisa-->
                </nav><!--menu-desktop-->

                <nav class="menu-mobile">
                    <span class="logomarca">Logomarca</span>
                        <i class="fa fa-bars barras"></i>
                        <div class="menu-mobile-toggle">
                            <ul>
                                <li><a title="Home" href="<?php echo INCLUDE_PATH; ?>"><i class="fas fa-home"></i> Home</a></li>
                                <li><a title="Lançamentos" href="<?php echo INCLUDE_PATH; ?>lancamentos"><i class="far fa-calendar-plus"></i> Lançamentos</a></li>
                                <li id="toggle-mobile">
                                    <a title="Categorias">Categorias <i class="fas fa-chevron-down"></i></a>
                                    <ul>
                                        <?php 
                                        foreach ($valorCat as $key => $value) {
                                        ?>
                                        <li><a href="<?php echo INCLUDE_PATH_CAT; ?>?<?php echo $value['ds_categoria']?>"><?php echo $value['ds_categoria']?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li><!--toggle-mobile-->
                                <div class="menu-pesquisa-mobile">
                                    <i class="fa fa-search"></i>
                                    <form><input type="text"></form>
                                </div><!--menu-pesquisa-mobile-->
                                <li><a title="Contato" href="<?php echo INCLUDE_PATH; ?>contato"><i class="fas fa-phone-alt"></i> Contato</a></li>
                                <?php if(isset($_SESSION['ID']) == ''){?>
                                <li><a href="<?php echo INCLUDE_PATH; ?>login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                                <?php }else{
                                    $usuario_login = $pdo->prepare("SELECT nome_usuario FROM `tb_usuarios` WHERE cod_usuario = ?");
                                    $usuario_login->execute(array($_SESSION['ID']));
                                    $exibe_usuario = $usuario_login->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <li><a href="<?php echo INCLUDE_PATH; ?>conta"><i class="fas fa-user"></i> <?php echo $exibe_usuario['nome_usuario']; ?></a></li>
                                <li><a href="<?php echo INCLUDE_PATH; ?>logout"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                                <?php } ?>
                            </ul>
                        </div><!--menu-mobile-top-->
                    <div class="clear"></div>
                </nav><!--menu-mobile-->
            </div><!--container-->
        </header>

        <div class="container-principal">
            <?php
                $url = isset($_GET['url']) ? $_GET['url'] : 'home';
                if(file_exists('pages/'.$url.'.php')){
                    include('pages/'.$url.'.php');
                }else{
                    if($url != 'home'){
                        $pagina404 = true;
                        include('pages/404.php');
                    }else{
                        include('pages/home.php');
                    }
                }

            ?>
        </div><!--container-principal-->

        <footer <?php if(isset($pagina404) && $pagina404 == true || $url == 'login') echo 'class="fixed"'; ?>>
            <div class="container">
                <p>R. Guaipá, 678 - Vila Leopoldina, São Paulo - SP, 05089-000</p>
                <h3>Todos os direitos reservados &copy; <b>Filipinho Inc.</b></h3>
                <div class="clear"></div>
            </div><!--container-->
        </footer>

        <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/functions.js"></script>
    </body>
</html>
<?php ob_end_flush(); ?>