<?php
    if(isset($_POST['nome'])){
        $i     = filter_input(INPUT_POST, 'inscricao' ,FILTER_SANITIZE_NUMBER_INT);
        $nome  = filter_input(INPUT_POST, 'nome'      ,FILTER_SANITIZE_SPECIAL_CHARS);
        $Tel   = filter_input(INPUT_POST, 'tel'       ,FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email'     ,FILTER_SANITIZE_SPECIAL_CHARS);
        $pass  = filter_input(INPUT_POST, 'pass'      ,FILTER_SANITIZE_SPECIAL_CHARS);
            require_once '../../classes/autoload.php';
            $insc = new Aluno();
            $insc->cadastro($i,$nome,$Tel,$email,$pass);
           
    }
?>