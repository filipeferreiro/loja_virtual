<section class="login">
    <div class="container">
        <div class="form-wraper">
            <?php
                if(isset($_POST['acao'])){
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $sql = $pdo->prepare("SELECT * FROM `tb_usuarios` WHERE email_usuario = ? AND senha_usuario = ?");
                    $sql->execute(array($email,$senha));
                    if($sql->rowCount() == 1){
                        $exibeUsuario = $sql->fetch(PDO::FETCH_ASSOC);
                        if($exibeUsuario['status_usuario'] == 0){
                            $_SESSION['ID'] = $exibeUsuario['cod_usuario'];
                            $_SESSION['status'] = 0;
                            header('Location: '.INCLUDE_PATH);
                        }else{
                            $_SESSION['ID'] = $exibeUsuario['cod_usuario'];
                            $_SESSION['status'] = 1;
                            header('Location: '.INCLUDE_PATH);
                        }
                    } else{
                        echo '<div class="box-alert erro"><i class="fa fa-times"></i> Email ou Senha inválidos, tente novamente </div>';
                    }
                }
            ?>
            <h2>Faça o Login</h2>
            <form method="post">
                <div class="input-wraper">
                    <h3>Email</h3>
                    <input type="email" name="email" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <h3>Senha</h3>
                    <input type="password" name="senha" required>
                </div><!--input-wraper-->
                <div class="input-wraper">
                    <input type="submit" name="acao" value="Entrar">
                    <p>Ainda não é um membro? <a href="<?php INCLUDE_PATH; ?>cadastrar">Cadastre-se</a></p>
                </div><!--input-wraper--> 
            </form>
        </div><!--form-wraper-->
    </div><!--container-->
</section>