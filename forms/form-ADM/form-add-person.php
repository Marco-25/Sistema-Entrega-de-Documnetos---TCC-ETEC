  <form action="../../database/ADM/create.php" method="post" class="row">
      <div class="input-field col s12">
         <div class="col s8 offset-4">
            <input type="text"  id="nome" name="nome" class="validate" autofocus>
            <label for="nome">Nome </label>
         </div>
      </div>
      <!--_____________________________________________________-->
      <div class="input-field col s12">
          <div class="col s8 offset-4">
            <input type="text" name="tel" id="tel" required>
            <label for="tel">Telefone </label>
          </div>
      </div>
        <!--_____________________________________________________-->
        <div class="input-field col s12">
          <div class="col s8 offset-4">
            <input type="email" name="email" id="email" required>
            <label for="email">E-mail </label></div>
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
          <div class="col s8 offset-4">
            <input type="text" name="senha" id="senha" required>
            <label for="senha">Senha </label></div>
      </div>
       <!--_____________________________________________________-->
       <div class="input-field col s12">
          <div class="col s8 offset-4">
          <div class="input-field col s12 m4">
          <select name="id_curso" id="id_curso" required>
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
          <input type="submit" value="Cadastrar" class="btn">
          <a href="../../public/adm/adm.php" class="btn red">Cancelar</a>
      </div>
  </form>