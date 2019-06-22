<?php
    session_start();
    require_once 'Crud/CrudAluno.php';
    class Aluno extends Connection implements CrudAluno{
        private $idDoc, $idPes, $status, $rg, $cpf;
        private $cnh,$certidaoN, $certidaoC, $historico, $data,$idCur;

        //metodos setters
        protected function setIdPes($x){
            $this->idPes = $x;
        }
        protected function setIdDoc($x){
            $this->idDoc = $x;
        }
        protected function setRg($x){
            $this->rg = $x;
        }
        protected function setCpf($x){
            $this->cpf = $x;
        }
        protected function setCnh($x){
            $this->cnh = $x;
        }
        protected function setCertidaoN($x){
            $this->certidaoN = $x;
        }
        protected function setCertidaoC($x){
            $this->certidaoC = $x;
        }
        protected function setHistorico($x){
            $this->historico = $x;
        }
        protected function setData($x){
            $this->data = $x;
        }
        protected function setIdCur($x){
            $this->idCur = $x;
        }
        //metodos getters
        protected function getIdPes(){
            return $this->idPes;
        }
        protected function getIdDoc(){
            return $this->idDoc;
        }
        protected function getRg(){
            return $this->rg;
        }
        protected function getCpf(){
            return $this->cpf;
        }
        protected function getCnh(){
            return $this->cnh;
        }
        protected function getCertidaoN(){
            return $this->certidaoN;
        }
        protected function getCertidaoC(){
            return $this->certidaoC;
        }
        protected function getHistorico(){
            return $this->historico;
        }
        protected function getData(){
            return $this->data;
        }
        protected function getIdCur(){
           return $this->idCur;
        }
        //tabela incrição
        private $numero;
            //settrs
                protected function setNumero($x){
                    $this->numero = $x;
                }
            //settrs
                protected function getNumero(){
                    return $this->numero;
                }
        //tabela Pessoa
                private $nome,$telefone,$email,$senha;
                //metodos setters
                protected function setNome($x){
                    $this->nome = $x;
                }
                protected function setTelefone($x){
                    $this->telefone = $x;
                }
                protected function setEmail($x){
                    $this->email = $x;
                }
                protected function setSenha($x){
                    $this->senha = $x;
                }
                //metodos gettrs
                protected function getNome(){
                    return $this->nome;
                }
                protected function getTelefone(){
                    return $this->telefone;
                }
                protected function getEmail(){
                    return $this->email;
                }
                protected function getSenha(){
                    return $this->senha;
                }
        //metodos especidicos
       public function  dadosDoFormulario($id,$rg,$cpf,$cnh,$ctdN,$ctdC,$historico,$idcurso){
            $this->setIdPes($id);
            $this->setRg($rg);
            $this->setCpf($cpf);
            $this->setCnh($cnh);
            $this->setCertidaoN($ctdN);
            $this->setCertidaoC($ctdC);
            $this->setHistorico($historico);
            $this->setIdCur($idcurso);

       }
        //metodos implements
        public function create(){
            $conn = $this->connect();

           $id    =  $this->getIdPes();
           $rg    =  $this->getRg();
           $cpf   =  $this->getCpf();
           $cnh   =  $this->getCnh();
           $ctdn  =  $this->getCertidaoN();
           $ctdc  =  $this->getCertidaoC();
           $hist  =  $this->getHistorico();
           $idcur =  $this->getIdCur();
         
           $updateCurso = "UPDATE `PESSOA` SET id_curso = :idcurso, senha = 'infonet*' WHERE idpessoa = :idpessoa";
           $smt = $conn->prepare($updateCurso);
           $smt->bindParam(':idcurso',$idcur);
           $smt->bindParam(':idpessoa',$id);
           $smt->execute();

           $sql = "INSERT INTO `DOCUMENTO`(`iddocumento`, `id_pessoa`, `rg`, `cpf`, `cnh`, `certidao_nascimento`, `certidao_casamento`, `historico_escolar`, `data_envio`) ";
           
           $sql .= "VALUES (default,:id ,:rg,:cpf,:cnh,:ctdn,:ctdc,:his,default)";
           $stmt = $conn->prepare($sql);
           $stmt->bindParam(':id', $id);
           $stmt->bindParam(':rg', $rg);
           $stmt->bindParam(':cpf', $cpf);
           $stmt->bindParam(':cnh', $cnh);
           $stmt->bindParam(':ctdn', $ctdn);
           $stmt->bindParam(':ctdc', $ctdc);
           $stmt->bindParam(':his', $hist);
            
           if( $stmt->execute() ){
                $_SESSION['sucess'] = "<script>alert('Documentos enviados com sucesso'</script>";
                $destino = header('Location:../../public/login/login.php');
            }else{
                $_SESSION['error'] = "<script>alert('Falha ao no envio')</script>";
                $destino = header('Location:../../public/login/login.php');
            }
        }
        public function cadastro($i,$n,$t,$e,$s){
            $conn = $this->connect();
            $this->setNumero($i);
            $this->setNome($n);
            $this->setTelefone($t);
            $this->setEmail($e);
            $this->setSenha($s);
            $tipo = 3;

            $i = $this->getNumero();
            $n = $this->getNome();
            $t = $this->getTelefone();
            $e = $this->getEmail();
            $s = $this->getSenha();
            
            $sql = "SELECT numero FROM INSCRICAO WHERE numero = :n";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':n',$i);
            $stmt->execute();
            
            if($stmt->rowCount() > 0 ){
               $cadastro  = "INSERT INTO `PESSOA`(`idpessoa`, `nome`, `telefone`, `email`, `tipo`, `senha`, `id_curso`) ";
               $cadastro .= "VALUES ";
               $cadastro .= "(default,:nome,:tel,:email,:tipo,:senha,null)";

               $cadastrar = $conn->prepare($cadastro);
               $cadastrar->bindParam('nome',$n);
               $cadastrar->bindParam('tel',$t);
               $cadastrar->bindParam('email',$e);
               $cadastrar->bindParam('tipo',$tipo);
               $cadastrar->bindParam('senha',$s);
               $cadastrar->execute();

                $delete = "DELETE FROM `INSCRICAO` WHERE numero = :numero ";
                $dlt = $conn->prepare($delete);
                $dlt->bindParam(':numero',$i);
                $dlt->execute();

               echo "<script>alert('Parabens pela Aprovação.')</script>".
               "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../public/login/login.php'>";
            }else{
                echo "<script>alert('Desculpe, tente no proximo semestre.')</script>".
                "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../public/login/login.php'>";
            }
        }
    }
?>