<?php
    session_start();
    //require_once '../../config/header.login.inc.html';
?>
    <div class="row container">
        <form method="post" action="../../database/login/logar.php" class="col s12 14 offset-14 login">
            <div class="card">
                <div class="card-action blue white-text">
                    <img src="../../imagens/logo.png" class="im">
                </div>
                <!--________________________-->
                <div class="card-content">
                    <div class="form-field">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email">
                    </div><br/>
                    <!--__________input______________-->
                    <div class="form-field">
                        <label for="password">Senha</label>
                        <input type="password" name="senha" id="password">
                    </div><br/>
                    <!--__________input______________-->
                    <div class="form-field center-align">
                    <button class="btn waves-effect blue" type="submit" name="login">Login
                        <i class="material-icons right">send</i>
                    </button>
                    <a href="cadastro-aluno.php" class="green btn">Cadastre - se</a>
                    </div><br/>
                    <?php if(isset($_SESSION['erro'])){ echo $_SESSION['erro'];}  ?>
                </div>

            </div>
    </div>