<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_cursos extends CI_Model {

  public function buscaCursos($dados) {
        $this->db->select('*');
        $this->db->from('cursos');
        if (!empty($dados)) {
            $this->db->like('nome_cursos', $dados);
        }
        
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
              return $query->result();
        } else {
              return false;
        }
  }


  function consultaCursos($dados = NULL) {
      if ($dados !== NULL) {
            extract($dados);

            $this->db->select('*');
            $this->db->from('cursos');

            if (!empty($dados ['nome_cursos'])) {
                  $this->db->like('nome_cursos', $dados ['nome_cursos']);
            }

            $query = $this->db->get();
            if ($query->num_rows() >= 1) {
                  return $query->result();
            } else {
                  return false;
            }
      } else {
            return false;
      }
}

}

?>