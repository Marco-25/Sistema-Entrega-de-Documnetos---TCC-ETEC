<?php  require_once '../../classes/autoload.php';
    $id  = filter_input(INPUT_GET, 'id' ,FILTER_SANITIZE_NUMBER_INT);
    $email = new Responsavel();
    $email->alunoid($id);
    
?>
