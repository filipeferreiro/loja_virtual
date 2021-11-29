
<?php
    if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
        $livros = Painel::conectar()->prepare("SELECT * FROM `tb_livro` WHERE cod_livro = ?");
        $livros->execute(array($idExcluir));
        $livros = $livros->fetchAll();
        $imageDel = $livros[0]['ds_capa'];
        Painel::deleteFile($imageDel);
        Painel::deletar('tb_livro',$idExcluir);

        $livros = Painel::conectar()->prepare("DELETE FROM `tb_livro` WHERE cod_livro = ?");
        $livros->execute(array($idExcluir));
        Painel::redirect(INCLUDE_PATH_CONTA.'/gerenciar');
    }

    $registro_livro = Painel::conectar()->prepare("SELECT * FROM `tb_livro`");
    $registro_livro->execute();
    $registro_livro = $registro_livro->fetchAll();
?>
<section class="gerenciar">
    <div class="container">
        <h2><i class="fa fa-book"></i> Livros cadastrados</h2>
        <div class="wraper-table">
            <table>
                <tr>
                    <td><br></td>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                </tr>

                <?php
                    foreach ($registro_livro as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $value['num_livro']; ?></td>
                    <td><a class="btn edit" href="<?php echo INCLUDE_PATH_CONTA ?>/editar-livro?id=<?php echo $value['cod_livro']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
                    <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_CONTA ?>/gerenciar?excluir=<?php echo $value['cod_livro']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                </tr>

                <?php } ?>

            </table>
	    </div><!--wraper-table-->
    </div><!--container-->
</section><!--gerenciar-->