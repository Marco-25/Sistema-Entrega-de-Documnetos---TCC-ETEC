<?php
session_start();
?>
<div class="row">
    <h5 class="light">Envio de documentos</h5><hr/>
</div>
<form action="../../database/aluno/create.php" method="post" enctype="multipart/form-data" class="row">
<div class="row">
    <div class="input-field col s12 m6">
        <select name="idcurso" required>
        <option selected>Cursos</option>
        <option value="1"> Técnico em Administração </option>
        <option value="2"> Técnico em Contabilidade </option>
        <option value="3"> Técnico em Emfermagem </option>
        <option value="4"> Técnico em Informática para Internet </option>
        <option value="5"> Técnico em Logística </option>
        <option value="6"> Técnico em Segurança do Trabalho </option>
        <option value="7"> Técnico em Serviços Jurídicos</option>       
        </select>
        <label>Selecione o curso ao qual se matriculou</label>
    </div>
</div>
<!--__________________________________________________________Select_____________-->
<div class="row s12">
    <img src="../../imagem/rg.jpeg" class="ima"> 
            <div class="input-field">
                <input type="file" name="rg" class="btn btn-small col s6" required>
                <span class="col s3 bolder">Rg-frente e Verso</span>
            </div>
</div><hr/>
<!--__________________________________________________________rg______________-->
<div class="row s12">
    <img src="../../imagem/cpf.jpg" class="ima">
        <div class="input-field">
            <input type="file" name="cpf" class="btn btn-small col s6" required>
            <span class="col s3 bolder">CPF</span>
        </div>
</div><hr/>
<!--__________________________________________________________cpf______________-->
<div class="row s12">
    <img src="../../imagem/cnh.png" class="ima">
        <div class="input-field">
            <input type="file" name="cnh" class="btn btn-small col s6" required>
            <span class="col s3 bolder">CNH-Frente e Verso</span>
        </div>
</div><hr/>
<!--__________________________________________________________cpf______________-->
<div class="row s12">
    <img src="../../imagem/certidao_n.jpg" class="ima">
        <div class="input-field">
            <input type="file" name="ctdN" class="btn btn-small col s6" required>
            <span class="col s3 bolder">Certidão de Nascimento</span>
        </div>
</div><hr/>
<!--__________________________________________________________certidao Nasc______________-->
<div class="row s12">
    <img src="../../imagem/certidao_c.jpg" class="ima">
        <div class="input-field">
            <input type="file" name="ctdC" class="btn btn-small col s6" required>
            <span class="col s3 bolder">Certidão de Casamento</span>
        </div>
</div><hr/>
<!--__________________________________________________________certidao casa______________-->
<div class="row s12">
    <img src="../../imagem/historico.png" class="ima">
        <div class="input-field">
            <input type="file" name="historico" class="btn btn-small col s6" required>
            <span class="col s3 bolder">Histórico</span>
        </div>
</div><hr/>
<!--__________________________________________________________Historico______________-->
<input type="hidden" name="idpessoa" value=<?php echo $_SESSION['user'] ?> >
<div class="row s12">
        <div class="input-field">
          <input type="submit" name="enviar" value="Enviar Documentos" class="col s12 btn">
        </div>
</div>
</form>