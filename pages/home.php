<section class="banner">
            <div class="container">
                <h1>Filipinho Livros</h1>
                <h2>A <b>maior</b> loja de livros online do <b>Brasil!</b></h2>
                <p>Compre agora e receba sua cópia por e-mail</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget venenatis mi. Suspendisse convallis maximus dolor ut convallis. Nullam non tortor turpis. Sed sed justo nibh. Aenean luctus pellentesque nibh at sollicitudin. Vivamus id neque facilisis, accumsan tortor sagittis, elementum orci. Curabitur ultrices dictum blandit. Donec ex ipsum, auctor a elit sed, gravida porta nunc. Praesent elementum odio libero. Quisque ac iaculis augue.</p>
            </div><!--container-->
        </section><!--banner-->

        <section class="destaques">
            <div class="container">
                <h2>Destaques</h2>
                <div class="flex-destaques">

                <?php while($exibe = $consulta->fetch(PDO::FETCH_ASSOC)){ ?>
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
