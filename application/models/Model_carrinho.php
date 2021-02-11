<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_carrinho extends CI_Model
{

    function cadastroCarrinho($dados = NULL)
    {
        if ($dados !== NULL) {
            extract($dados);
            $this->db->insert('carrinho', array(
                'curso_id' => $dados['curso_id'],
                'preco' => $dados['preco'],
                'nomecurso' => $dados['nomecurso'],
                'url' => $dados['url']
            ));
            return true;
        } else {
            return false;
        }
    }


    public function buscaCarrinho($dados = NULL)
    {
        if ($dados !== NULL) {

            $this->db->select('*');
            $this->db->from('carrinho');
            if (!empty($dados)) {
                $this->db->like('nomecurso', $dados);
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


    function deletarCarrinho($id)
    {
        $this->db->delete('carrinho', array('id' => $id));
        return true;
    }
}
