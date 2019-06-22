<?php 
    require_once '../../classes/autoload.php';
    if(isset($_GET['idc'])){
        $id = filter_input(INPUT_GET, 'idc' ,FILTER_SANITIZE_NUMBER_INT);
        $listar = new Responsavel();
        $listar->dadosDaTabela($id);
    }
?>