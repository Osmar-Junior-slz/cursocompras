<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('form');
        date_default_timezone_set('America/Sao_Paulo');
    }

    function index() {
        redirect('login');
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

    function dashboard() {
           $this->load->view('view_home');
    }

    function requicaoajax() {
        if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();

            $dados ['resultadoPerfil'] = $resultadoPerfil;
            $dados ['tela'] = 'view_requisicaojquery';
            $this->load->view('view_home', $dados);
        } else {
            redirect('login', 'refresh');
        }
    }


    

  

    function listausuario() {
        if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
            $this->load->model('model_usuario');
            $resultadoUsuarios = $this->model_usuario->buscaUsuarios();
            //var_dump($resultadoUsuarios);
            $dados ['resultadoUsuario'] = $resultadoUsuarios;

            $dados ['telaativa'] = 'usuarios';
            $dados ['tela'] = 'usuarios/view_listausuario';
            $this->load->view('view_home', $dados);
        }
    }


    function listcursos() {
        
            $this->load->model('Model_cursos');
            $dadoscurso='';
            $resultadoCursos = $this->Model_cursos->buscaCursos($dadoscurso);
            
            $dados ['resultadoCursos'] = $resultadoCursos;

            $dados ['telaativa'] = 'cursos';
            $dados ['tela'] = 'cursos/view_cadcursos';
            $this->load->view('view_home', $dados);
        }
    
        function consultacursos() {
         
                $this->load->model('Model_cursos');
                if ($this->input->post()) {
                    if ((!empty(trim($this->input->post('nome'))))  ) {
                        $dadoscurso ['nome_cursos'] = $this->input->post('nome');
                        $this->load->model('model_cursos');
                        $resultadocursos = $this->model_cursos->consultaCursos($dadoscurso);
                        if ($resultadocursos) {
                            $dados ['telaativa'] = 'cursos';
                            $dados ['resultadoCursos'] = $resultadocursos;
                            $dados ['tela'] = 'cursos/view_cadcursos';
                            $this->load->view('view_home', $dados);
                        } else {
                            $dados ['telaativa'] = 'cursos';
                            $dados ['msg'] = 'Nenhum curso encontrado! Tente novamente';
                            $dados ['tela'] = 'cursos/view_cadcursos';
                            $this->load->view('view_home', $dados);
                        }
                    } else {
                        $dados ['telaativa'] = 'cursos';
                        $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                        $dados ['tela'] = 'cursos/view_formconsultacursos';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados ['telaativa'] = 'cursos';
                    $dados ['tela'] = 'cursos/view_formconsultacursos';
                    $this->load->view('view_home', $dados);
                }
            
        }


    


    

    function atualizausuario() {
        if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                if ((!empty(trim($this->input->post('id')))) || (!empty(trim($this->input->post('nome')))) || (!empty(trim($this->input->post('login')))) || (!empty(trim($this->input->post('email'))))) {
                    $dadosusuario ['id'] = $this->input->post('id');
                    $dadosusuario ['nome'] = $this->input->post('nome');
                    $dadosusuario ['login'] = $this->input->post('login');
                    $dadosusuario ['email'] = $this->input->post('email');

                    $this->load->model('model_usuario');
                    $resultadoatualizausuario = $this->model_usuario->atualizausuario($dadosusuario);
                    if ($resultadoatualizausuario) {
                        $dados ['telaativa'] = 'usuarios';
                        $dados ['msg'] = 'Usuário alterado com sucesso!';
                        $dados ['tela'] = 'usuarios/view_formconsultausuario';
                        $this->load->view('view_home', $dados);
                    } else {
                        $dados ['telaativa'] = 'usuarios';
                        $dados ['msg'] = 'Ocorreu um erro ao alterar o usuario! Atualize a página e tente novamente';
                        $dados ['tela'] = 'usuarios/view_formconsultausuario';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados ['telaativa'] = 'usuarios';
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'usuarios/view_formconsultausuario';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['telaativa'] = 'usuarios';
                $dados ['tela'] = 'usuarios/view_cadastrousuario';
                $this->load->view('view_home', $dados);
            }
        }
    }

   
}
