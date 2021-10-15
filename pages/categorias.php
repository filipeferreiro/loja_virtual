<?php
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = explode('?',$url)[1];
    
    $consulta_cat = $pdo->query("SELECT * FROM vw_livro WHERE ds_categoria = '$url'");
?>

<section class="destaques">
    <div class="container">
    <h2><?php echo $url?></h2>
        <div class="flex-destaques">
            <?php while($exibe = $consulta_cat->fetch(PDO::FETCH_ASSOC)){ ?>
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