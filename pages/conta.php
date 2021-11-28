<section class="conta">
    <div class="container">
    <?php
        $caminho = INCLUDE_PATH;
        if(@$_SESSION['ID'] == ''){
            // se não estiver logado
            echo '<h2 class="validacao"> <i class="fas fa-user-slash"></i> <br> Você não está logado! <br> Faça o <a href="'.$caminho.'login">login</a> para acessar sua conta. <h2>';
        } else{
            $usuario_login = $pdo->prepare("SELECT nome_usuario FROM `tb_usuarios` WHERE cod_usuario = ?");
            $usuario_login->execute(array($_SESSION['ID']));
            $exibe_usuario = $usuario_login->fetch(PDO::FETCH_ASSOC);
            if($_SESSION['status'] == 1){
                // se a conta for de um administrador
                if(isset($_GET['add'])){
                    header('Location: '.INCLUDE_PATH.'conta/adicionar');
                } else if(isset($_GET['alter'])){
                    header('Location: '.INCLUDE_PATH.'conta/gerenciar');
                } else if(isset($_GET['vendas'])){
                    header('Location: '.INCLUDE_PATH.'conta/vendas');
                }
    ?>
        <div class="conta-content">
            <h2>Bem-vindo, <?php echo $exibe_usuario['nome_usuario']; ?>!</h2>
            <h3>Faça o gerenciamento da loja nos menus abaixo: </h3>
            <form method="get">
                <div class="links-adm">
                    <input type="submit" name="add" value="Adicionar Produto">
                    <input type="submit" name="alter" value="Gerenciar Produtos">
                    <input type="submit" name="vendas" value="Vendas">
                </div><!--links-adm-->
            </form>
        </div><!--conta-content-->
    <?php
            } else{
                // se a conta não for de um administrador
                echo '<h2 class="validacao"> <i class="fas fa-user-slash"></i> <br> Você não é um administrador! <br> Volte para a  <a href="'.$caminho.'">página inicial</a>. <br>A página para usuários ainda não foi feita! <h2>';
            }
        }
    ?>
    </div><!--container-->
</section><!--conta-->