<?php
    if(isset($_POST['login'])){
        $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, 'senha',FILTER_SANITIZE_SPECIAL_CHARS);

        require_once '../../classes/autoload.php';
        $login = new Usuario();
        $login->Logar($email,$senha); 
    }
?>