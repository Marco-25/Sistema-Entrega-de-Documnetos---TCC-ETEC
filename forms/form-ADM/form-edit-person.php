<form action="../../database/ADM/update.php" method="post" class="row">
      <div class="input-field col s12">
          <input type="text"  id="nome" name="nome" class="validate" value="<?php echo $values['nome']?>" required autofocus>
          <label for="nome">Nome </label>
      </div>
      <!--_____________________________________________________-->
      <div class="input-field col s12">
          <input type="text" name="tel" id="tel" value="<?php echo $values['telefone']?>" required>
          <label for="tel">Telefone </label>
      </div>
        <!--_____________________________________________________-->
        <div class="input-field col s12">
          <input type="email" name="email" id="email" value="<?php echo $values['email']?>" required>
          <label for="email">E-mail </label>
      </div>
      <!--_____________________________________________________-->
      <div class="input-field col s12 m4">
          <select name="tipo" id="tipo" required>
            <option value="">Selecione o tipo de acesso</option>
            <option value="1">Administrador Master</option>
            <option value="2">Administrador</option>
            <option value="3">Aluno</option>
          </select>
          <label for="tipo">Tipo </label>
      </div>
      <!--_____________________________________________________-->
      <div class="input-field col s12">
          <input type="text" name="senha" id="senha" value="<?php echo $values['senha']?>" required>
          <label for="senha">Senha </label>
      </div>
       <!--_____________________________________________________-->
       <div class="input-field col s12">
          <div class="input-field col s12 m4">
          <select name="id_curso" id="id_curso">
            <option value="">Selecione um curso</option>
            <option value="1">	Técnico em Administração</option>
            <option value="2">  Técnico em Contabilidade</option>
            <option value="3">  Técnico em Emfermagem</option>
            <option value="4">	Técnico em Informática para Internet</option>
            <option value="5">	Técnico em Logística</option>
            <option value="6">	Técnico em Segurança do Trabalho</option>
            <option value="7">  Técnico em Serviços Jurídicos</option>
          </select>
          <label for="id_curso">Curso <-Opcional-> </label></div>
      </div>
      <!--_____________________________________________________-->
        <div class="input-field col s12">
          <input type="hidden" name="id" value="<?php echo $id?>"?>
      </div>
        <!--_____________________________________________________-->
        <div class="input-field col s12">
          <input type="submit" value="Alterar" class="btn">
          <a href="../../public/adm/adm.php" class="btn red">Cancelar</a>
      </div>
  </form>