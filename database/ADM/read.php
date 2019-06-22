<?php
    require_once '../../classes/autoload.php';
        $busca = filter_input(INPUT_POST, 'busca',FILTER_SANITIZE_SPECIAL_CHARS);

        $read = new Adm();
        $read->read($busca);

?>