<?php
   abstract class Connection{//classe para proteger os dados da conexão
        private $servDB   = "mysql:host=localhost;dbname=TCC2";
        private $user     = "root";
        private $password = "";

        protected function connect(){
            try{
                $conn = new PDO($this->servDB,$this->user,$this->password);
                $conn->exec("set names utf8");//salvar no banco na codificação pt br
                return $conn;
            }catch( PDOException $erro ){
                echo $erro->getMessage();
            }
        }
    }
?>