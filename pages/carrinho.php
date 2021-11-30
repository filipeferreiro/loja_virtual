<?php
    if(isset($_GET['excluir'])){
        $_SESSION['carrinho'] = array();
    }
    if(isset($_GET['addCart'])){
        $idProduto = (int)$_GET['addCart'];
        if(isset($_SESSION['carrinho']) == false){
            $_SESSION['carrinho'] = array();
        }
        if(isset($_SESSION['carrinho'][$idProduto]) == false){
            $_SESSION['carrinho'][$idProduto] = 1;
        }else{
            $_SESSION['carrinho'][$idProduto]++;
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
        <td><?php echo $value; ?></td>
        <td>R$<?php echo Painel::formatarMoedaBd($valor); ?></td>
        <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH; ?>carrinho?excluir"><i class="fa fa-times"></i> Excluir</td>
    </tr>
    <?php
    }
    }
    ?>
            </div><!--tabela-wrapper-->
        </table>
    </div><!--container-->
</section><!--carrinho-->