<h5 class="light">Cursos Cadastrados</h5><hr/>

<!--inicio tabela-->
    <div class="row"><!--Se não ficar legal é so retirar essa div-->
        <table class="striped">
            <thead>
               <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>Modulo</th>
                    <th>Duração</th> 
               </tr>              
            </thead>

            <tbody>
                <tr>
                    <?php require_once '../../database/User/read.php'; ?>
                </tr>
            </tbody>
        </table>
    </div>
<!--inicio tabela-->