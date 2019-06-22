<?php
    require_once 'Crud/crudLogin.php';
    session_start();
    class Usuario extends Connection implements crudLogin{
        private $email, $senha,$tipo, $id;

        protected function setId($id){
            $this->id = $id;
        }
        protected function setEmail($e){
            $this->email = $e;
        }
        protected function setSenha($s){
            $this->senha = $s;
        }
        protected function setTipo($t){
            $this->tipo = $t;
        }
        //------------------------------
        protected function getId(){
            return $this->id;
        }
        protected function getEmail(){
            return $this->email;
        }
        protected function getSenha(){
            return $this->senha;
        }
        protected function getTipo(){
            return $this->tipo;
        }
        //função login
        public function Logar($email,$senha){
            $this->setEmail($email);
            $this->setSenha($senha);

            $_email = $this->getEmail();
            $_senha = $this->getSenha();
            $conn = $this->connect();

            $sql  = "SELECT idpessoa, email,senha,tipo from PESSOA where email = :email and senha = :senha ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $_email);
            $stmt->bindParam(':senha',$_senha);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $values){
                $this->setTipo($values['tipo']);
                $tipo = $this->getTipo();
                $this->setId($values['idpessoa']);
            }    
            if(empty($tipo)){ 
                $_SESSION['erro'] = "<p class='red center-align'>Login ou Senha inválidos.</p>";
                header("Location:../../public/login/login.php");
            }else{ 
                $_SESSION['user'] = $this->getId();
                switch($tipo){
                    case 1 :                        
                        header("Location:../../public/adm/adm.php");
                        break;
                    case 2 :
                        header("Location:../../public/usuario/usuario.php");
                        break;
                    case 3 :
                        header("Location:../../public/aluno/aluno.php");
                        break; 
                    }
            }

        }
    }    
?>