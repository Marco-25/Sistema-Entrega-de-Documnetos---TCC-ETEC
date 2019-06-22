
    <div class="row container">
        <form method="post" action="../../database/aluno/cadastro.php" class="col s12 14 offset-14 login">
            <div class="card">
                <div class="card-action blue white-text">
                    <h5 class="light center-align">Cadastro Para Envio de Documentos </h5>
                </div>
                <!--________________________-->
                <div class="card-content">
                    <div class="input-field">
                        <label for="i">Informe o numero da sua incrição<-apenas os numeros-></label>
                        <input type="number" name="inscricao" id="i" min="0">
                    </div><br/>
                    <!--__________input______________-->
                    <div class="input-field">
                        <label for="p">Nome</label>
                        <input type="text" name="nome" id="p">
                    </div><br/>
                      <!--__________input______________-->
                      <div class="input-field">
                        <label for="p">Telefone</label>
                        <input type="text" name="tel" id="p">
                    </div><br/>
                      <!--__________input______________-->
                      <div class="input-field">
                        <label for="p">E-mail</label>
                        <input type="text" name="email" id="p">
                    </div><br/>
                      <!--__________input______________-->
                      <div class="input-field">
                        <label for="p">Senha</label>
                        <input type="password" name="pass" id="p">
                    </div><br/>
                    <!--__________input______________-->
                    <div class="form-field center-align">
                    <button class="btn waves-effect green" type="submit" name="cadastro">Cadastrar
                    </button><br/>
                    </div><br/>
                </div>

            </div>
    </div>