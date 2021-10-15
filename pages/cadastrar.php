<section class="cadastro">
    <div class="container">
        <div class="form-wraper">
            <?php
                if(isset($_POST['cadastrar'])){
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $endereco = $_POST['endereco'];
                    $cidade = $_POST['cidade'];
                    $cep = $_POST['cep'];
                    $verEmail = $pdo->query("SELECT email_usuario FROM `tb_usuarios` WHERE email_usuario = '$email' ");
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
                    }
                }
            ?>
            <h2>Faça o seu Cadastro</h2>
            <form method="post">
                <div class="input-wraper">
                    <h3>Nome</h3>
                    <input type="text" name="nome" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Email</h3>
                    <input type="email" name="email" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Senha</h3>
                    <input type="password" name="senha" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Endereço</h3>
                    <input type="text" name="endereco" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Cidade</h3>
                    <input type="text" name="cidade" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>CEP</h3>
                    <input type="text" name="cep" id="cep" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <input type="submit" name="cadastrar" value="Cadastrar">
                </div><!--input-wraper--> 
            </form>
        </div><!--form-wraper-->
    </div><!--container-->
</section>