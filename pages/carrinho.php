<?php
    if(isset($_GET['excluir'])){
        $excluir = $_GET['excluir'];
        unset($_SESSION['carrinho'][$excluir]);
        header('Location: '.INCLUDE_PATH.'carrinho');
    }
    if(isset($_GET['addCart'])){
        $idProduto = (int)$_GET['addCart'];
        if(isset($_SESSION['carrinho']) == false){
            $_SESSION['carrinho'] = array();
        }
        if(isset($_SESSION['carrinho'][$idProduto]) == false){
            $_SESSION['carrinho'][$idProduto] = 1;
            header('Location: '.INCLUDE_PATH.'carrinho');
        }else{
            $_SESSION['carrinho'][$idProduto]++;
            header('Location: '.INCLUDE_PATH.'carrinho');
        }
    }

    if(isset($_SESSION['carrinho'])){
        $itemsCarrinho = $_SESSION['carrinho'];
        $total = 0;
        
?>
<section class="carrinho">
    <div class="container">
        <h2><i class="fa fa-shopping-cart"></i> Carrinho de compras</h2>
        <table>
            <div class="tabela-wrapper">
                <tr>
                    <td> <br> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
<?php
        foreach ($itemsCarrinho as $key => $value) {
            $idProduto = $key;
            $produto = Painel::conectar()->prepare("SELECT * FROM `tb_livro` WHERE cod_livro = $idProduto");
            $produto->execute();
            $produto = $produto->fetch();
            $valor = $value * $produto['vl_preco'];
            $total+=$valor;
            ?>
    <tr>
        <td><?php echo $produto['num_livro']; ?></td>
            <td>
                <select>
                    <?php for($i = $value;$i <= $produto['qt_estoque']; $i++){ ?>
                        <option><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </td>
            <td>R$<?php echo Painel::convertMoney($valor); ?></td>
            <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH; ?>carrinho?excluir=<?php echo $idProduto; ?>"><i class="fa fa-times"></i> Excluir</td>
    </tr>
        <?php
        }
        }
        ?>
            </div><!--tabela-wrapper-->
        </table>
        <div class="comprar">
            <?php
                $caminho = INCLUDE_PATH;
                if(@$_SESSION['ID'] == ''){
                    // se não estiver logado
                    echo '<h2 class="validacao"> <i class="fas fa-user-slash"></i> <br> Você não está logado! <br> Faça o <a href="'.$caminho.'login">login</a> para concluir sua compra. <h2>';
                } else{
                    echo '<input type="submit" value="Concluir compra" name="comprar"';
                }
            ?>
        </div>
    </div><!--container-->
</section><!--carrinho-->
