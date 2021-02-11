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
                'preco' => $dados['preco']
            ));
            return true;
        } else {
            return false;
        }
    }
}
