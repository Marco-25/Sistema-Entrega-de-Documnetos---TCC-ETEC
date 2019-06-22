<?php
     require_once '../../config/header.usuario.inc.html';
     $id  = filter_input(INPUT_GET, 'id' ,FILTER_SANITIZE_NUMBER_INT);
?><!--header-->
<!--Body inicio-->
    <div class="container">
    <h5 class="light">Documentos</h5><hr/>
       <ul class="row"> 
         <li class="col s5"><button class="btn red"> <a href="erro.php?id=<?php echo $id;?>">Dados Errados</a> </button></li>
         <li class="col s2"><button class="btn blue"> <a href="pdf.php?id=<?php echo $id;?>">Imprimir</a> </button></li>
         <li class="col s5">
           <button class="btn right"> <a href="list.php?idc=<?php ?>">Voltar</a> </button>
          </li>
       </ul>
        <?php require_once '../../database/User/view.php' ;?>
    </div>
<!--Body inicio-->
<?php require_once '../../config/footer.inc.html';?><!--footer-->