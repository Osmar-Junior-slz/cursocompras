<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_cursos extends CI_Model {

  public function buscaCursos() {
        $this->db->select('*');
        $this->db->from('cursos');

        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
              return $query->result();
        } else {
              return false;
        }
  }

}

?>