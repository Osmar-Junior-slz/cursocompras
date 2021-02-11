<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('form');
        date_default_timezone_set('America/Sao_Paulo');
        
    }

    function index()
    {
        redirect('login');
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

    function dashboard()
    {
        $this->load->view('view_home');
    }

    function requicaoajax()
    {
        if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();

            $dados['resultadoPerfil'] = $resultadoPerfil;
            $dados['tela'] = 'view_requisicaojquery';
            $this->load->view('view_home', $dados);
        } else {
            redirect('login', 'refresh');
        }
    }



    function listcursos()
    {

        $this->load->model('Model_cursos');
        $dadoscurso = '';
        $resultadoCursos = $this->Model_cursos->buscaCursos($dadoscurso);

        $dados['resultadoCursos'] = $resultadoCursos;

        $dados['telaativa'] = 'cursos';
        $dados['tela'] = 'cursos/view_cadcursos';
        $this->load->view('view_home', $dados);
    }



    function consultacursos()
    {

        $this->load->model('Model_cursos');
        if ($this->input->post()) {
            if ((!empty(trim($this->input->post('nome'))))) {
                $dadoscurso['nome_cursos'] = $this->input->post('nome');
                $this->load->model('model_cursos');
                $resultadocursos = $this->model_cursos->consultaCursos($dadoscurso);
                if ($resultadocursos) {
                    $dados['telaativa'] = 'cursos';
                    $dados['resultadoCursos'] = $resultadocursos;
                    $dados['tela'] = 'cursos/view_cadcursos';
                    $this->load->view('view_home', $dados);
                } else {
                    $dados['telaativa'] = 'cursos';
                    $dados['msg'] = 'Nenhum curso encontrado! Tente novamente';
                    $dados['tela'] = 'cursos/view_cadcursos';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados['telaativa'] = 'cursos';
                $dados['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                $dados['tela'] = 'cursos/view_formconsultacursos';
                $this->load->view('view_home', $dados);
            }
        } else if ($this->input->get()) {
            if ($this->input->get('id')) {
                $id = (int) $this->input->get('id');

                $this->load->model('model_cursos');
                $resultadousuarioespecifico = $this->model_cursos->consultaCursosPorID($id);
                if ($resultadousuarioespecifico) {
                    $dados['telaativa'] = 'cursos';
                    $dados['resultadoUsuarioEspecifico'] = $resultadousuarioespecifico;
                    $dados['tela'] = 'cursos/view_formdetalhescurso';
                    $this->load->view('view_home', $dados);
                } else {
                    $dados['telaativa'] = 'cursos';
                    $dados['msg'] = 'Nenhum Usuário localizado para os dados informados! Tente novamente';
                    $dados['tela'] = 'cursos/view_cadcursos';
                    $this->load->view('view_home', $dados);
                }
            }
        } else {
            $dados['telaativa'] = 'cursos';
            $dados['tela'] = 'cursos/view_formconsultacursos';
            $this->load->view('view_home', $dados);
        }
    }


    /*
       CARRINHO DE COMPRAS
    */

    function cadastrocarrinho()
    {
        if ($this->input->post()) {

            $dadoscarrinho['curso_id'] = $this->input->post('id');
            $dadoscarrinho['preco'] = $this->input->post('preco');
            $dadoscarrinho['nomecurso'] = $this->input->post('nome_cursos');
            $dadoscarrinho['url'] = $this->input->post('url');

            $this->load->model('model_carrinho');
            $resultadocadastrousuario = $this->model_carrinho->cadastroCarrinho($dadoscarrinho);

            if ($resultadocadastrousuario) {
                redirect('home/listcarrinho', 'refresh');
            } else {
                $dados['telaativa'] = 'cursos';
                $dados['msg'] = 'Ocorreu um erro ao cadastrar o curso! Atualize a página e tente novamente';
                $dados['tela'] = 'cursos/view_cadcursos';
            }
            $this->load->view('view_home', $dados);
        } else {
            $dados['telaativa'] = 'cursos';
            $dados['tela'] = 'cursos/view_cadcursos';
            $this->load->view('view_home', $dados);
        }
    }

    function listcarrinho()
    {

        $this->load->model('model_carrinho');
        $dadoscarrinho = '';

        $resultadoCarrinho = $this->model_carrinho->buscaCarrinho($dadoscarrinho);

        $dados['resultadoCarrinho'] = $resultadoCarrinho;

        $dados['telaativa'] = 'carrinho';
        $dados['tela'] = 'carrinho/view_carrinhocompras';
        $this->load->view('view_home', $dados);
    }

    function deletarCarrinho()
    {
        if ($this->input->get('id')) {
            $id = (int) $this->input->get('id');
            $this->load->model('model_carrinho');
            $this->model_carrinho->deletarCarrinho($id);
            redirect('home/listcarrinho', 'refresh');
        }
    }
}
