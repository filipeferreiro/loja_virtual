<?php
    if(isset($_GET['pesquisar'])){
    $pesquisa = $_GET['pesquisar'];
    $consulta_pesq = $pdo->query("SELECT * FROM `vw_livro` WHERE `num_livro` LIKE '%$pesquisa%' OR `name_autor` LIKE '%$pesquisa%'");
?>

<section class="destaques">
    <div class="container">
    <h2>Você pesquisou por: <b><?php echo $pesquisa; ?></b></h2>
        <div class="flex-destaques">
            <?php while($exibe = $consulta_pesq->fetch(PDO::FETCH_ASSOC)){ ?>
                <div class="space-destaques">
                    <div class="box-destaques">
                        <div class="imagem"><img alt="<?php echo $exibe['ds_capa']; ?>" src="images/<?php echo $exibe['ds_capa']; ?>.jpg"></div> <!--ADICIONAR IMAGEM AQUI-->
                        <div class="box-destaques-wraper">
                            <h3><?php echo mb_strimwidth($exibe['num_livro'],0,50,'...'); ?></h3>
                            <h4>R$<?php echo number_format($exibe['vl_preco'],2,',','.'); ?></h4>
                            <a href="<?php echo INCLUDE_PATH; ?>produto-single?prod=<?php echo $exibe['cod_livro'];?>">Saiba mais!</a>
                            <?php 
                                if($exibe['qt_estoque'] == 0){
                                    echo '<a disabled class="btn-indisponivel"><i class="far fa-times-circle"></i> indisponivel</a>';
                                }else{
                                    echo '<a href="#">Comprar</a>';
                                }
                            ?>
                        </div><!--box-destaques-wraper-->
                    </div><!--box-destaques-->
                </div><!--space-destaques-->
            <?php } ?>         
        </div><!--flex-destaques-->
    </div><!--container-->
</section><!--destaques-->
<?php }else{ ?>
    <section class="destaques">
        <div class="container">
            <h2>Você precisa passar um parâmetro para a pesquisa</h2>  
        </div><!--container-->
    </section><!--destaques-->
<?php } ?>