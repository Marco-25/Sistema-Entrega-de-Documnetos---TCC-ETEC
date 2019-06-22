<?php
    if(isset($_FILES['rg']) ){
        require_once '../../funcoes/funcao.php';

        $foto1  = salvarImagem($_FILES['rg']);
        $foto2  = salvarImagem($_FILES['cpf']);
        $foto3  = salvarImagem($_FILES['cnh']);
        $foto4  = salvarImagem($_FILES['ctdN']);
        $foto5  = salvarImagem($_FILES['ctdC']);
        $foto6  = salvarImagem($_FILES['historico']);

        $idcurso   = filter_input(INPUT_POST, 'idcurso' ,FILTER_SANITIZE_NUMBER_INT);
        $rg        =  $foto1[1];
        $cpf       =  $foto2[1];
        $cnh       =  $foto3[1];
        $ctdN      =  $foto4[1];
        $ctdC      =  $foto5[1];
        $historico =  $foto6[1];
        $idpessoa   = filter_input(INPUT_POST, 'idpessoa' ,FILTER_SANITIZE_NUMBER_INT);

       require_once '../../classes/autoload.php';
       $createDoc = new Aluno();
       $createDoc->dadosDoFormulario($idpessoa,$rg,$cpf,$cnh,$ctdN,$ctdC,$historico,$idcurso);
       $createDoc->create();
    }
?>