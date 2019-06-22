<?php
    require_once 'Crud/CrudAdm.php';
    session_start();
    class Adm extends Connection implements CrudAdm{
        private $id,$nome,$tel,$email,$tipo,$senha,$idCurso;

        //metodos de setters
        protected function setId($id){
            $this->id = $id;
        }
        protected function setNome($n){
            $this->nome = $n;
        }
        protected function setTel($t){
            $this->tel = $t;
        }
        protected function setEmail($e){
            $this->email = $e;
        }
        protected function setTipo($t){
            $this->tipo =$t;
        }
        protected function setSenha($s){
            $this->senha = $s;
        }
        protected function setIdCurso($idC){
            $this->idCurso = $idC;
        }
        //metodos gettrs
        protected function getId(){
            return $this->id;
        }
        protected function getNome(){
            return $this->nome;
        }
        protected function getTel(){
            return $this->tel;
        }
        protected function getEmail(){
            return $this->email;
        }
        protected function getTipo(){
            return $this->tipo;
        }
        protected function getSenha(){
            return $this->senha;
        }
        protected function getIdCurso(){
            return $this->idCurso;
        }
        //metodos especificos
        public function dadosDoFormulario($nome,$tel,$email,$tipo,$senha,$idCurso){
            $this->setNome($nome);
            $this->setTel($tel);
            $this->setEmail($email);
            $this->setTipo($tipo);
            $this->setSenha($senha);
            $this->setIdCurso($idCurso);
        }
        public function dadosDaTabela($id){
            $conn = $this->connect();

            $this->setId($id);
            $idPessoa = $this->getId();

            $sql  = "SELECT * FROM PESSOA WHERE idpessoa = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam('id',$idPessoa);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $values){
                require_once '../../forms/form-ADM/form-edit-person.php';
            }

        }
        //metodos dos implementos
        public function read($busca){
            $busca = $busca . "%";
            //conexão
            $conn = $this->connect();
            //teste de seguraça
           if(!isset($_SESSION['user'])){
              header("Location:login.php");
           }
            //query
            $sql1 = "SELECT PESSOA.idpessoa,PESSOA.nome,PESSOA.telefone,PESSOA.email,PESSOA.tipo,PESSOA.senha,PESSOA.id_curso,TIPO.nome_tipo FROM PESSOA INNER JOIN TIPO ON TIPO.idtipo = PESSOA.tipo WHERE PESSOA.nome LIKE :nome ORDER BY PESSOA.tipo";
            $stmt = $conn->prepare($sql1);
            $stmt->bindParam(':nome',$busca);
            $stmt->execute();
            //associar linhas dos bancos
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //mostrar os dados
            foreach($result as $value){
                $this->setId($value['idpessoa']);
                $this->setNome($value['nome']);
                $this->setTel($value['telefone']);
                $this->setEmail($value['email']);
                $this->setTipo($value['nome_tipo']);
                $this->setIdCurso($value['id_curso']);

                $_id     = $this->getId();
                $_nome   = $this->getNome();
                $_tel    = $this->getTel();
                $_email  = $this->getEmail();
                $_tipo   = $this->getTipo();
                $idCurso = $this->getIdCurso();
                echo "<tr>";
                   // echo "<td>" . $_id      ."</td>";
                    echo "<td>" . utf8_decode($_nome)  ."</td>";
                    echo "<td>" . $_tel     ."</td>";
                    echo "<td>" . $_email   ."</td>";
                    echo "<td>" . $_tipo    ."</td>";
                    echo "<td>
                            <a href='editar.php?id=$_id'><i class='material-icons left'>edit
                            </i>Editar</a>
                        </td>";
                    echo "<td>    
                            <a href='#' onclick='confirm_click($_id)' ><i class='material-icons left'>delete</i>Deletar
                            </a> 
                        </td>";
                echo "</tr>";
            }
        } 
        public function create(){
            $conn = $this->connect();

            $_nome   = $this->getNome();
            $_tel    = $this->getTel();
            $_email  = $this->getEmail();
            $_tipo   = $this->getTipo();
            $_senha  = $this->getSenha();
            $idCurso = $this->getIdCurso();

            $sql   = "INSERT INTO `PESSOA`(`idpessoa`, `nome`, `telefone`, `email`, `tipo`, `senha`,id_curso) ";
            $sql  .= "VALUES ";
            $sql  .= "(default,:nome,:tel,:email,:tipo,:senha,:idcurso) ";
            $stmt  = $conn->prepare($sql);
            $stmt->bindParam(':nome', $_nome);
            $stmt->bindParam(':tel', $_tel);
            $stmt->bindParam(':email', $_email);
            $stmt->bindParam(':tipo', $_tipo);
            $stmt->bindParam(':senha', $_senha);
            $stmt->bindParam(':idcurso',$idCurso);

            if( $stmt->execute() ){
                $_SESSION['sucess'] = "<script>alert('Cadastro realizado com sucesso'</script>";
                $destino = header('Location:../../public/adm/adm.php');
            }else{
                $_SESSION['error'] = "<script>alert('Falha ao cadastrar')</script>";
                $destino = header('Location:../../public/adm/adm.php');
            }
        }
        public function update($nome,$tel,$email,$tipo,$senha,$id,$id_curso){
            $conn = $this->connect();
            $this->setNome($nome);
            $this->setTel($tel);
            $this->setEmail($email);
            $this->setTipo($tipo);
            $this->setSenha($senha);
            $this->setId($id);
            $this->setIdCurso($id_curso);

            $_nome   = $this->getNome();
            $_tel    = $this->getTel();
            $_email  = $this->getEmail();
            $_tipo   = $this->getTipo();
            $_senha  = $this->getSenha();
            $_id     = $this->getId();
            $idCurso = $this->getIdCurso();

            $sql = "UPDATE `PESSOA` SET `nome`=:nome,`telefone`= :tel,`email`= :email,`tipo`= :tipo,`senha`= :senha,`id_curso`= :idCurso WHERE idpessoa = :id ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam('nome',$_nome);
            $stmt->bindParam('tel',$_tel);
            $stmt->bindParam('email',$_email);
            $stmt->bindParam('tipo',$_tipo);
            $stmt->bindParam('senha',$_senha);
            $stmt->bindParam('idCurso',$idCurso);
            $stmt->bindParam('id',$_id);

           if( $stmt->execute() ){
               header("Location:../../public/adm/adm.php");
           }else{
            header("Location:../../public/adm/editar.php");
           }
        }
        public function delete($id){
            $conn = $this->connect();

            $this->setId($id);
            $idPessoa = $this->getId();

            $sql = "DELETE from PESSOA where idpessoa = :id ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $idPessoa);
            
            if( $stmt->execute()){
                $destino = header("Location:../../public/adm/adm.php");
            }
        }
}
?>