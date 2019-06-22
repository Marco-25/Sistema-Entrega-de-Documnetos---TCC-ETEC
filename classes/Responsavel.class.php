<?php
    require_once 'Crud/CrudUser.php';
    session_start();
    class Responsavel extends Connection implements CrudUser{
        //tabela curso
        private $id, $nome, $modulo, $tempo;
        //metodos settrs
        protected function setId($x){
            $this->id = $x;
        }
        protected function setNome($x){
            $this->nome = $x;
        }
        protected function setModulo($x){
            $this->modulo = $x;
        }
        protected function setTempo($x){
            $this->tempo = $x;
        }
        //metodos getters
        protected function getId(){
            return $this->id;
        }
        protected function getNome(){
            return $this->nome;
        }
        protected function getModulo(){
            return $this->modulo;
        }
        protected function getTempo(){
            return $this->tempo;
        }
        //tabela pessoa id e nome email
        private $idpessoa, $nomepessoa ,$email;
        //settrs
        protected function setIdPessoa($x){
            $this->idpessoa = $x;
        }
        protected function setNomePessoa($x){
            $this->nomepessoa = $x;
        }
        protected function setEmail($x){
            $this->email = $x;
        }
        //gettrs
        protected function getIdPessoa(){
            return $this->idpessoa;
        }
        protected function getNomePessoa(){
            return $this->nomepessoa;
        }
        protected function getEmail(){
            return $this->email;
        }
        //--------------------------
        //tabela documento
        private $rg,$cpf,$cnh,$ctdn,$ctdc,$hist;
        //settrs
        protected function setRg($x){
            $this->rg = $x;
        }
        protected function setCpf($x){
            $this->cpf = $x;
        }
        protected function setCnh($x){
            $this->cnh = $x;
        }
        protected function setCtdn($x){
            $this->ctdn = $x;
        }
        protected function setCtdc($x){
            $this->ctdc = $x;
        }
        protected function setHist($x){
            $this->hist = $x;
        }
        //gettrs
        protected function getRg(){
            return $this->rg;
        }
        protected function getCpf(){
            return $this->cpf;
        }
        protected function getCnh(){
            return $this->cnh;
        }
        protected function getCtdn(){
            return $this->ctdn;
        }
        protected function getCtdc(){
            return $this->ctdc;
        }
        protected function getHist(){
            return $this->hist;
        }
        //--------------------------
        //metodos especificos
        public function dadosDaTabela($id){
            $conn = $this->connect();
            if( !isset($_SESSION['user']) ){
                header("Location:../login/login.php");
            }

            $this->setId($id);
            $_id = $this->getId();

            $sql  = "SELECT CURSO.idcurso,CURSO.nome_curso,PESSOA.idpessoa, PESSOA.nome FROM CURSO INNER JOIN PESSOA ON PESSOA.id_curso = CURSO.idcurso WHERE PESSOA.id_curso = :id AND PESSOA.tipo = '3' ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id',$_id);
            $stmt->execute();
           //thead inicio
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $this->setId($row['idcurso']);
                $this->setNome($row['nome_curso']);
                $id     = $this->getId();
                $nome   = $this->getNome();
            }
            echo "<table class='striped'>";
            echo "
            <thead>
                <tr>
                    <th class='center-align' colspan='3'>";
                    if(!isset($nome)){echo "Não tem alunos cadastrados nesse curso.";}
                    else{ echo $nome;}
                    echo"</th>
                </tr>
                <tr>
                    <th>Nome do Aluno</th>
                    <th>Download</th>
                    <th>visualizar</th>
                </tr>";
            //thead fim  
            //tbody inicio  
            foreach($result as $row){
                    $this->setNomePessoa($row['nome']);
                    $this->setIdPessoa($row['idpessoa']);
                    $nomepessoa = $this->getNomePessoa();
                    $idpessoa   = $this->getIdPessoa();
                    echo "<tbody>";
                        echo "
                        <tr>
                        <td class='hover'> "; 
                        if(!isset($nomepessoa)){echo "";}
                        else{echo utf8_decode($nomepessoa);}
                        echo "</td>
                        <td> <a class='hover' href='download.php?id=$idpessoa'>Gerar PDF</a></td>
                        <td> <a class='hover' href='visualizar.php?id=$idpessoa'>Visualizar</a></td>
                        </tr>";
                    echo "</tbody>";
                }
            
        }
        public function GerarPdf($id){
            $conn = $this->connect();
            //teste de segurança
            if( !isset($_SESSION["user"])){
                header("Location:../public/login/login.php");
            }
            $this->setIdPessoa($id);
            $_idP = $this->getIdPessoa();
            //query 
            $sql = "SELECT DOCUMENTO.iddocumento,DOCUMENTO.id_pessoa,DOCUMENTO.rg,DOCUMENTO.cpf,DOCUMENTO.cnh,DOCUMENTO.certidao_nascimento,DOCUMENTO.certidao_casamento,DOCUMENTO.historico_escolar,PESSOA.nome FROM DOCUMENTO INNER JOIN PESSOA ON PESSOA.idpessoa = DOCUMENTO.id_pessoa WHERE id_pessoa = :id ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id',$_idP);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //buscar a class
            require_once "../../fpdf181/fpdf.php";
            foreach($result as $linha){
                $this->setRg($linha['rg']);
                $this->setCpf($linha['cpf']);
                $this->setCnh($linha['cnh']);
                $this->setCtdn($linha['certidao_nascimento']);
                $this->setCtdc($linha['certidao_casamento']);
                $this->setHist($linha['historico_escolar']);
                $this->setNomePessoa($linha['nome']);
            }  
            $rg    = $this->getRg();
            $cpf   = $this->getCpf();
            $cnh   = $this->getCnh();
            $ctdn  = $this->getCtdn();
            $ctdc  = $this->getCtdc();
            $hist  = $this->getHist();
            $nome  = $this->getNomePessoa();

            //estanciando
            $pdf = new FPDF();
            //inicia o documento PDF com orientação P-retrato(picture) ou L -Paisagem(landscape)
            $pdf->AddPage();
            //nome do arquivo ao ser gerado ou gera o nome do arquivo com o local a ser salvo
            $arquivo = "_Documentos_".$nome."pdf.pdf";
            //definindo formatações do PDF
            $tipo_pdf = "I";
            /*
            Gerar como:
            I : Envia o arquivo para o navegador. visualizado de PDF é usado se disponivel
            D : Enviar para o navegador e forçar um download como nome especificado
            F : Salva o arquivo local como o nome dado por nome(pode incluir caminho)
            S : Retorna o documento como string
            DEFAULT : o valor padrão é "I"
            */
            $pdf->Image($rg , 60 ,10, 80 , 50, ''); 
            $pdf->Image($cpf , 60 ,70, 80 , 50, '');
            $pdf->Image($cnh , 60 ,130, 80 , 50, '');
            //pagina 2
            $pdf->AddPage();
            $pdf->Image($ctdn , 10 ,5, 190 , 285, '');
            //pag 3
            $pdf->AddPage();
            $pdf->Image($ctdc , 10 ,5, 190 , 285, '');
            //pag 4
            $pdf->AddPage();
            $pdf->Image($hist , 10 ,5, 190 , 285, '');

            //fechando o arquivo
            $pdf->OutPut($arquivo,$tipo_pdf);
        }
        public function Download($id){
            $conn = $this->connect();
            //teste de segurança
            if( !isset($_SESSION["user"])){
                header("Location:../public/login/login.php");
            }
            $this->setIdPessoa($id);
            $_idP = $this->getIdPessoa();
            //query 
            $sql = "SELECT DOCUMENTO.iddocumento,DOCUMENTO.id_pessoa,DOCUMENTO.rg,DOCUMENTO.cpf,DOCUMENTO.cnh,DOCUMENTO.certidao_nascimento,DOCUMENTO.certidao_casamento,DOCUMENTO.historico_escolar,PESSOA.nome FROM DOCUMENTO INNER JOIN PESSOA ON PESSOA.idpessoa = DOCUMENTO.id_pessoa WHERE id_pessoa = :id ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id',$_idP);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //buscar a class
            require_once "../../fpdf181/fpdf.php";
            foreach($result as $linha){
                $this->setRg($linha['rg']);
                $this->setCpf($linha['cpf']);
                $this->setCnh($linha['cnh']);
                $this->setCtdn($linha['certidao_nascimento']);
                $this->setCtdc($linha['certidao_casamento']);
                $this->setHist($linha['historico_escolar']);
                $this->setNomePessoa($linha['nome']);
            }  
            $rg    = $this->getRg();
            $cpf   = $this->getCpf();
            $cnh   = $this->getCnh();
            $ctdn  = $this->getCtdn();
            $ctdc  = $this->getCtdc();
            $hist  = $this->getHist();
            $nome  = $this->getNomePessoa();

            //estanciando
            $pdf = new FPDF();
            //inicia o documento PDF com orientação P-retrato(picture) ou L -Paisagem(landscape)
            $pdf->AddPage();
            //nome do arquivo ao ser gerado ou gera o nome do arquivo com o local a ser salvo
            $arquivo = "_Documentos_".$nome."pdf.pdf";
            //definindo formatações do PDF
            $tipo_pdf = "D";
            /*
            Gerar como:
            I : Envia o arquivo para o navegador. visualizado de PDF é usado se disponivel
            D : Enviar para o navegador e forçar um download como nome especificado
            F : Salva o arquivo local como o nome dado por nome(pode incluir caminho)
            S : Retorna o documento como string
            DEFAULT : o valor padrão é "I"
            */
            $pdf->Image($rg , 60 ,10, 80 , 50, ''); 
            $pdf->Image($cpf , 60 ,70, 80 , 50, '');
            $pdf->Image($cnh , 60 ,130, 80 , 50, '');
            //pagina 2
            $pdf->AddPage();
            $pdf->Image($ctdn , 10 ,5, 190 , 285, '');
            //pag 3
            $pdf->AddPage();
            $pdf->Image($ctdc , 10 ,5, 190 , 285, '');
            //pag 4
            $pdf->AddPage();
            $pdf->Image($hist , 10 ,5, 190 , 285, '');

            //fechando o arquivo
            $pdf->OutPut($arquivo,$tipo_pdf);
        }
        //metodos implementes
        public function read(){
            $conn = $this->connect();
            if( !isset($_SESSION['user']) ){
                header("Location:../login/login.php");
            }

            $sql  = "SELECT idcurso,nome_curso,modulo,tempo_duracao FROM CURSO ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $value){
                    $this->setId($value['idcurso']);
                    $this->setNome($value['nome_curso']);
                    $this->setModulo($value['modulo']);
                    $this->setTempo($value['tempo_duracao']);
                    
                    $_id     = $this->getId();
                    $_nome   = $this->getNome();
                    $_modulo = $this->getModulo();
                    $_tempo  = $this->getTempo();
                   
                    echo "<tr>";
                        echo "<td>" . $_id     . "</td>";
                        echo "<td class='hover'><a href='list.php?idc=$_id'>" . $_nome   . "</a></td>";
                        echo "<td>" . $_modulo . "</td>";
                        echo "<td>" . $_tempo  . "</td>";
                    echo "</tr>";
            }
        }
        public function list($id){
            $conn = $this->connect();
            if( !isset($_SESSION['user']) ){
                header("Location:../../public/login/login.php");
            }
            $this->setIdPessoa($id);
            $id  = $this->getIdPessoa();
            $sql = "SELECT `iddocumento`, `id_pessoa`, `rg`, `cpf`, `cnh`, `certidao_nascimento`, `certidao_casamento`, `historico_escolar`, `data_envio` FROM `DOCUMENTO` WHERE id_pessoa = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $value){
                $rg   = $value['rg'];
                $cpf  = $value['cpf'];
                $cnh  = $value['cnh'];
                $ctdn = $value['certidao_nascimento'];
                $ctdc = $value['certidao_casamento'];
                $hist = $value['historico_escolar'];

                echo "<div class='row col s12 center'>
                        <div class='col s6'>
                            <span>Rg</span><br/>
                            <img src='$rg' class='responsive-img' width='300px'>
                        </div>
                    
                        <div class='col s6'>
                        <span>CPF</span><br/>
                            <img src='$cpf' class='responsive-img' width='300px'>
                        </div>
                    </div>";
            //------------------------------------------------------
            echo "<div class='row col s12 center'>
                    <div class='col s6'>
                        <span>CNH</span><br/>
                        <img src='$cnh' class='responsive-img' width='300px'>
                    </div>
                
                    <div class='col s6'>
                    <span>Certidão de Nascimento</span><br/>
                        <img src='$ctdn' class='responsive-img' width='300px'>
                    </div>
                </div>";
                   //------------------------------------------------------
            echo "<div class='row col s12 center'>
                    <div class='col s6'>
                        <span>Certidão de Casamento</span><br/>
                        <img src='$ctdc' class='responsive-img' width='300px'>
                    </div>
                
                    <div class='col s6'>
                    <span>Historico</span><br/>
                        <img src='$hist' class='responsive-img' width='300px'>
                    </div>
                </div>";
            }
        }
        public function alunoid($id){
            $conn = $this->connect();
            $this->setIdPessoa($id);
            $id = $this->getIdPessoa();
            $sql = "SELECT * FROM PESSOA WHERE idpessoa = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $value){
                $this->setEmail($value['email']);
                $this->setNome($value['nome']);
                $email = $this->getEmail();
                $nome = $this->getNome();
            }
            echo "<div class='container center'>
            <p class='center-align col s8' style='color:red;'>Atenção em caso de erro nos documentos de segurança avisando o candidato do curso de desenvolvimento dos documentos em que ocorreu o erro quando vier a efetivar uma matrícula já que isso é permitido envio de documentos uma única vez. </p>
        </div>
        <form action='../../database/User/error.php' method='post'>
            <div class='input-field col s12'>
                <span>Descreva o erro</span>
                <textarea name='texto' cols='40' rows='5' style='height:220px'>
                Caro candito verifiquei que seu (rg,cpf,cnh...) está com erro; mediante a isso .....
                </textarea>
            </div>
        <!--__________________________________________________-->
            <div class='input-field col s12'>
            <input type='text' name='nome' value='$nome' style='width:50%;' readonly='true'>
            <input type='email' name='email' value='$email' style='width:50%;'readonly='true'>
            </div>
        <!--__________________________________________________-->
            <div class='input-field col s12'>
                <input type='submit' value='Enviar' class='btn right' >
            </div>
        </form>";
        }
        
    }
?>