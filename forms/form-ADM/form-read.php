<div class="row container">
    <div class="col s12">
        <h5 class="light">Pessoas Cadastradas no Sistema </h5><hr/>
        <!--Form inicio-->
        <form action="adm.php" method="post" class="row">
            <div class="input-field col s12 m4">
                <input type="text" name="busca" id="busca" autofocus>
                <label for="busca">Pesquise </label>
            </div>
            <!--__________________________________________________-->
            <div class="input-field col s12 m6">
                <input type="submit" value="Consultar" class="btn-small">
            </div>
        </form>
        <!--form fim-->
    </div>
        <!--tabela inicio-->
            <table class="striped">
                <thead>
                    <tr>
                        <!--<th>ID</th>-->
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                <?php require_once '../../database/ADM/read.php'; ?>
                </tbody>
            </table>
        <!--tabela fim-->
    </div>
</div>