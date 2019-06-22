<?php
    if(isset($_POST['nome'])){
        $nome    = filter_input(INPUT_POST, 'nome'  ,FILTER_SANITIZE_SPECIAL_CHARS);
        $tel     = filter_input(INPUT_POST, 'tel'   ,FILTER_SANITIZE_SPECIAL_CHARS);
        $email   = filter_input(INPUT_POST, 'email' ,FILTER_SANITIZE_SPECIAL_CHARS);
        $tipo    = filter_input(INPUT_POST, 'tipo'  ,FILTER_SANITIZE_NUMBER_INT);
        $senha   = filter_input(INPUT_POST, 'senha' ,FILTER_SANITIZE_SPECIAL_CHARS);
        $idCurso = filter_input(INPUT_POST, 'id_curso' ,FILTER_SANITIZE_SPECIAL_CHARS);

        require_once "../../classes/autoload.php";
        $cadastro = new Adm();
        $cadastro->dadosDoFormulario($nome,$tel,$email,$tipo,$senha,$idCurso);
        $cadastro->create();
    }
?>