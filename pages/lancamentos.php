<?php 
    $lancamento = $pdo->query("SELECT * FROM vw_livro WHERE sg_lancamento = 'S'");
?>
<section class="destaques">
    <div class="container">
    <h2>Lançamentos</h2>
        <div class="flex-destaques">
            <?php while($exibe = $lancamento->fetch(PDO::FETCH_ASSOC)){ ?>
                <div class="space-destaques">
                    <div class="box-destaques">
                        <div class="imagem"><img alt="<?php echo $exibe['ds_capa']; ?>" src="images/<?php echo $exibe['ds_capa']; ?>"></div> <!--ADICIONAR IMAGEM AQUI-->
                        <div class="box-destaques-wraper">
                            <h3><?php echo mb_strimwidth($exibe['num_livro'],0,50,'...'); ?></h3>
                            <h4>R$<?php echo number_format($exibe['vl_preco'],2,',','.'); ?></h4>
                            <a href="<?php echo INCLUDE_PATH; ?>produto-single?prod=<?php echo $exibe['cod_livro'];?>">Saiba mais!</a>
                            <?php 
                                if($exibe['qt_estoque'] == 0){
                                    echo '<a disabled class="btn-indisponivel"><i class="far fa-times-circle"></i> indisponivel</a>';
                                }else{
                                    echo '<a href="'.INCLUDE_PATH.'carrinho?addCart='.$exibe['cod_livro'].'">Comprar</a>';
                                }
                            ?>
                        </div><!--box-destaques-wraper-->
                    </div><!--box-destaques-->
                </div><!--space-destaques-->
            <?php } ?>         
        </div><!--flex-destaques-->
    </div><!--container-->
</section><!--destaques-->