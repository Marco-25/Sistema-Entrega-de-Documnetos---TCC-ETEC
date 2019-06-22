<?php
    spl_autoload_register(function($classes){
        require "$classes.class.php";
    }); //função para chamar todas as classes do meu projeto
?>