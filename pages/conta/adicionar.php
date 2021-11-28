<section class="cadastro">
    <div class="container">
        <div class="form-wraper">
            <?php
            include('classes/Painel.php');
                if(isset($_POST['cadastrar'])){
                    $isbn = $_POST['isbn'];
                    $categoria = $_POST['categoria'];
                    $nome = $_POST['nome'];
                    $autor = $_POST['autor'];
                    $paginas = $_POST['paginas'];
                    $preco = $_POST['preco'];
                    $quantidade = $_POST['quantidade'];
                    $resumo = $_POST['resumo'];
                    $foto = $_FILES['foto'];
                    $lancamento = $_POST['lancamento'];
                    print_r($foto);
                    $remover1='.';  // criando variável e atribuindo o valor de ponto para ela
                    $preco = str_replace($remover1, '', $preco); // removendo ponto de casa decimal,substituindo por vazio
                    $remover2=','; // criando variável e atribuindo o valor de virgula para ela
                    $preco = str_replace($remover2, '.', $preco); // removendo virgula de casa decimal,substituindo por ponto

                    if($isbn == '' || $nome == '' || $paginas == '' || $preco == '' || $quantidade == '' || $resumo == ''){
                        echo '<div class="box-alert erro"><i class="fa fa-times"></i> Todos os campos devem ser preenchidos!</div>';
                    } else if(Painel::imagemValida($foto) == true){
                            $idImagem = Painel::uploadFile($foto);
                            $sql = $pdo->prepare("INSERT INTO `tb_livro` VALUES(null,?,?,?,?,?,?,?,?,?,?)");
                            $sql->execute(array($isbn,$categoria,$nome,$autor,$paginas,$preco,$quantidade,$resumo,$idImagem,$lancamento));
                            
                            echo '<script>
                            alert("Cadastro de livro feito com sucesso!");
                            window.location.href = "'.INCLUDE_PATH.'/conta";
                            </script>';
                        } else{
                            echo '<div class="box-alert erro"><i class="fa fa-times"></i> A imagem não é válida!</div>';
                        }
                    /*$verEmail = $pdo->query("SELECT email_usuario FROM `tb_usuarios` WHERE email_usuario = '$email' ");
                    $executa = $verEmail->fetch(PDO::FETCH_ASSOC);

                    if($nome == '' || $email == '' || $senha == '' || $endereco == '' || $cidade == '' || $cep == ''){
                        echo '<div class="box-alert erro"><i class="fa fa-times"></i> Todos os campos devem ser preenchidos!</div>';
                    }else if($verEmail->rowCount() == 1){
                        echo '<div class="box-alert erro"><i class="fa fa-times"></i> E-mail já cadastrado!</div>';
                    } else{
                        $sql = $pdo->prepare("INSERT INTO `tb_usuarios` VALUES(null,?,?,?,?,?,?,?)");
                        $sql->execute(array($nome,$email,$senha,0,$endereco,$cidade,$cep));
                        echo '<script>
                            alert("Conta criada com sucesso, faça seu login!");
                            window.location.href = "'.INCLUDE_PATH.'/login";
                        </script>';
                    }*/
                }
            ?>
            <h2>Faça o seu Cadastro</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="input-wraper">
                    <h3>ISBN</h3>
                    <input type="text" name="isbn" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>categoria</h3>
                    <select name="categoria" required>
                        <?php 
                        foreach ($valorCat as $key => $value) {
                        ?>
                        <option value="<?php echo $value['cod_categoria']; ?>"><?php echo $value['ds_categoria']; ?></option>
                        <?php } ?>
                    </select>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Nome do livro</h3>
                    <input type="text" name="nome" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Nome do autor</h3>
                    <select name="autor" required>
                        <?php 
                        foreach ($valorAut as $key => $value) {
                        ?>
                        <option value="<?php echo $value['cod_autor']; ?>"><?php echo $value['name_autor']; ?></option>
                        <?php } ?>
                    </select>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Número de Páginas</h3>
                    <input type="text" name="paginas" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Preço</h3>
                    <input type="text" name="preco" id="preco" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Quantidade em estoque</h3>
                    <input type="text" name="quantidade" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Resumo</h3>
                    <textarea name="resumo"></textarea>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Foto Principal</h3>
                    <input type="file" name="foto">
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Lançamento</h3>
                    <select name="lancamento" required>
                        <option value="s">Sim</option>
                        <option value="n">Não</option>
                    </select>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <input type="submit" name="cadastrar" value="Cadastrar">
                </div><!--input-wraper--> 
            </form>
        </div><!--form-wraper-->
    </div><!--container-->
</section>