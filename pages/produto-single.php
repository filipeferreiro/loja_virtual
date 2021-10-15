<?php
if(isset($_GET['prod'])){
    $cod_livro = $_GET['prod'];
    $livro = $pdo->query("SELECT * FROM `vw_livro` WHERE cod_livro = '$cod_livro'");
    $exibeLivro = $livro->fetch(PDO::FETCH_ASSOC);
}else{
    header("location:".INCLUDE_PATH);
}
?>
<section class="produto-single">
    <div class="container">
        <div class="imagem-produto">
            <img src="<?php echo INCLUDE_PATH.'images/'.$exibeLivro['ds_capa'].'.jpg'; ?>">
        </div><!--imagem-produto-->
        <div class="descricao-produto">
            <h2><?php echo $exibeLivro['num_livro']; ?></h2>
            <?php echo $exibeLivro['ds_resumo_obra']; ?>
            <p><b>Autor:</b> <?php echo $exibeLivro['name_autor']; ?></p>
            <p><b>Número de páginas:</b> <?php echo $exibeLivro['num_pag']; ?></p>
            <p><b>ISBN:</b> <?php echo $exibeLivro['num_isbn']; ?></p>
            <p><b>Preço:</b> R$<?php echo number_format($exibeLivro['vl_preco'],2,',','.'); ?></p>
            <?php
                if($exibeLivro['qt_estoque'] == 0){
            ?>
                <a disabled class="btn-indisponivel"><i class="far fa-times-circle"></i> indisponivel</a>
            <?php }else{ ?>
                <a class="compra" href="#">Comprar</a>
            <?php } ?>
        </div><!--descricao-produto-->
    </div><!--container-->
</section>