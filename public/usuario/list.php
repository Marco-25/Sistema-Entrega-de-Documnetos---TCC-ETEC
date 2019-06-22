<?php require_once '../../config/header.usuario.inc.html';?><!--header-->
    <div class="container">
    <h5 class="light">Lista de Alunos</h5><hr/>
         <?php require_once '../../database/User/listar.php';?>
    </div>
<?php require_once '../../config/footer.inc.html';?><!--footer-->