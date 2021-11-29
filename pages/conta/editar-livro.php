<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$categoria = Painel::select('tb_livro','cod_livro = ?',array($id));
	}else{
		Painel::alertJS('Você precisa passar o parametro ID.');
		Painel::redirect(INCLUDE_PATH);
	}
 ?>
 <section class="editar">
    <div class="container">
        <div class="box-content">
            <h2><i class="fa fa-pencil-alt"></i> Editar livro</h2>

            <form method="post" enctype="multipart/form-data">

            <?php
                if(isset($_POST['acao'])){
                    $isbn = $_POST['isbn'];
                    $categoria = $_POST['categoria'];
                    $nome = $_POST['nome'];
                    $autor = $_POST['autor'];
                    $paginas = $_POST['paginas'];
                    $preco = $_POST['preco'];
                    $quantidade = $_POST['quantidade'];
                    $resumo = $_POST['resumo'];
                    $foto = $_FILES['imagem'];
                    $lancamento = $_POST['lancamento'];
                    $remover1='.';  // criando variável e atribuindo o valor de ponto para ela
                    $preco = str_replace($remover1, '', $preco); // removendo ponto de casa decimal,substituindo por vazio
                    $remover2=','; // criando variável e atribuindo o valor de virgula para ela
                    $preco = str_replace($remover2, '.', $preco); // removendo virgula de casa decimal,substituindo por ponto

                    $verificar = Painel::conectar()->prepare("SELECT * FROM `tb_livro` WHERE num_livro = ? AND cod_livro != ?");
                    $verificar->execute(array($_POST['nome'],$id));
                    $info = $verificar->fetch();

                    if($isbn == '' || $nome == '' || $paginas == '' || $preco == '' || $quantidade == '' || $resumo == ''){
                        echo '<div class="box-alert erro"><i class="fa fa-times"></i> Todos os campos devem ser preenchidos!</div>';
                    } else if(Painel::imagemValida($foto) == false){
                        echo '<div class="box-alert erro"><i class="fa fa-times"></i> A imagem não é válida!</div>';   
                        } else if($verificar->rowCount() == 1 && $_POST['nome'] == $info['nome']){
                            Painel::alert("erro",'Já existe um livro com este nome');
                        }else{
                            $idImagem = Painel::uploadFile($foto);
                            $sql = $pdo->prepare("UPDATE `tb_livro` SET num_isbn = ?, cod_categoria = ?, num_livro = ?, cod_autor = ?, num_pag = ?, vl_preco = ?, qt_estoque = ?, ds_resumo_obra = ?, ds_capa = ?, sg_lancamento = ?");
                            $sql->execute(array($isbn,$categoria,$nome,$autor,$paginas,$preco,$quantidade,$resumo,$idImagem,$lancamento));
                            
                            echo '<script>
                            alert("Edição de livro feito com sucesso!");
                            window.location.href = "'.INCLUDE_PATH_CONTA.'/gerenciar";
                            </script>';
                        }
                            
                        
                }
            ?>

            <div class="form-group">
                <label>ISBN:</label>
                <input type="text" name="isbn" value="<?php echo $categoria['num_isbn']; ?>">
            </div><!--form-group-->

            <div class="form-group">
                <label>Título:</label>
                <input type="text" name="nome" value="<?php echo $categoria['num_livro']; ?>">
            </div><!--form-group-->

            <div class="form-group">
                <label>Categoria:</label>
                <select name="categoria" required>
                            <?php 
                            foreach ($valorCat as $key => $value) {
                            ?>
                            <option value="<?php echo $value['cod_categoria']; ?>"><?php echo $value['ds_categoria']; ?></option>
                            <?php } ?>
                        </select>
            </div><!--form-group-->

            <div class="form-group">
                <label>Autor:</label>
                <select name="autor" required>
                    <?php 
                    foreach ($valorAut as $key => $value) {
                    ?>
                    <option value="<?php echo $value['cod_autor']; ?>"><?php echo $value['name_autor']; ?></option>
                    <?php } ?>
                </select>
            </div><!--form-group-->

            <div class="form-group">
                <label>Páginas:</label>
                <input type="text" name="paginas" value="<?php echo $categoria['num_pag']; ?>">
            </div><!--form-group-->

            <div class="form-group">
                <label>Preço:</label>
                <input type="text" name="preco" id="preco" value="<?php echo $categoria['vl_preco']; ?>">
            </div><!--form-group-->

            <div class="form-group">
                <label>Quantidade em estoque:</label>
                <input type="text" name="quantidade" value="<?php echo $categoria['qt_estoque']; ?>">
            </div><!--form-group-->

            <div class="form-group">
                <label>Resumo:</label>
                <textarea type="text" name="resumo"><?php echo $categoria['ds_resumo_obra']; ?></textarea>
            </div><!--form-group-->

            <div class="form-group">
                <label>Imagem:</label>
                <input type="file" name="imagem">
            </div><!--form-group-->

            <div class="form-group">
                <label>Lançamento:</label>
                <select name="lancamento" required>
                    <option value="s">Sim</option>
                    <option value="n">Não</option>
                </select>
            </div><!--form-group-->

            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="nome_tabela" value="tb_livro" />
                <input type="submit" name="acao" value="Atualizar!">
            </div><!--form-group-->

            </form>
        </div><!--box-content-->
    </div><!--container-->
</section><!--editar-->