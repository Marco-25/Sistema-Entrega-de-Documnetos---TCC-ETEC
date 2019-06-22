<?php require_once '../../config/header.adm.inc.html';?><!--cabeçalho-->
    <div class="container">
            <div class="row col s12">
                <h5 class="light">Editar cadastro de pessoa </h5><hr/>
            </div>
            <?php 
                require_once '../../classes/autoload.php';
                $id = filter_input(INPUT_GET, 'id' ,FILTER_SANITIZE_NUMBER_INT);
                $edit = new Adm();
                $edit->dadosDaTabela($id);     
            ?>
        </div>
<?php require_once '../../config/footer.inc.html';?><!--rodape-->