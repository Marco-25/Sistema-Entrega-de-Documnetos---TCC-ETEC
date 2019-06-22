<?php require_once '../../config/header.adm.inc.html';?><!--cabeçalho-->
    <?php 
                if(isset($_SESSION['sucess'])){
                    echo "<p class='center green lighten-2 white-text' padding:10px>";
                    echo $_SESSION['sucesso'];
                    unset($_SESSION['sucesso']);
                    echo "</p>";
                }else if(isset($_SESSION['error'])){
                    echo "<p class='center red lighten-2 white-text' padding:10px>";
                    echo $_SESSION['erro'];
                    unset($_SESSION['erro']);
                    echo "</p>";
                }
    ?>

<?php require_once '../../forms/form-ADM/form-read.php';?><!--corpo-->

<?php require_once '../../config/footer.inc.html';?><!--rodape-->