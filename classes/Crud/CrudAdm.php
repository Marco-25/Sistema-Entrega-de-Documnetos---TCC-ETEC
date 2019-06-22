<?php
    interface CrudAdm{
        public function read($busca);
        public function create();
        public function update($nome,$tel,$email,$tipo,$senha,$id,$id_curso);
        public function delete($id);
    }
?>