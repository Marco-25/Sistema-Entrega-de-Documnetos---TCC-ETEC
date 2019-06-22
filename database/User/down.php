<?php
if( isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id' , FILTER_SANITIZE_NUMBER_INT);
    require_once '../../classes/autoload.php';
    $Download = new Responsavel();
    $Download->Download($id);
}
?>