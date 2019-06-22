<form action="../../database/ADM/delete.php" method="post" class="row">

      <div class="input-field col s12">
          <input type="text"  id="nome" name="nome" class="validate" value="<?php echo $values['nome']?>" readonly="true" >
          <label for="nome">Nome </label>
      </div>
      <!--_____________________________________________________-->
      <div class="input-field col s12">
          <input type="text" name="tel" id="tel" value="<?php echo $values['telefone']?>" readonly="true">
          <label for="tel">Telefone </label>
      </div>
        <!--_____________________________________________________-->
        <div class="input-field col s12">
          <input type="email" name="email" id="email" value="<?php echo $values['email']?>" readonly="true">
          <label for="email">E-mail </label>
      </div>
      <!--_____________________________________________________-->
      <div class="input-field col s12">
          <input type="number" name="tipo" id="tipo" max="3" min="1" value="<?php echo $values['tipo']?>" readonly="true">
          <label for="tipo">Tipo </label>
      </div>    
      <!--_____________________________________________________-->
        <div class="input-field col s12">
          <input type="hidden" name="id" value="<?php echo $values['idpessoa']?>"?>
      </div>
        <!--_____________________________________________________-->
        <div class="input-field col s12">
          <input type="submit" value="Deletar" class="btn">
          <a href="../../public/adm/adm.php" class="btn red">Cancelar</a>
      </div>
  </form>