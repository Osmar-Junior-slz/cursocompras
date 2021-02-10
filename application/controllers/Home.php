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

    /*
     * USUARIOS
     */

    function cadastrausuario() {
        if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                if ((!empty(trim($this->input->post('nome')))) || (!empty(trim($this->input->post('login')))) || (!empty(trim($this->input->post('email')))) || (!empty(trim($this->input->post('senha')))) || (!empty(trim($this->input->post('perfilid'))))) {

                    $dadosusuario ['nome'] = $this->input->post('nome');
                    $dadosusuario ['login'] = $this->input->post('login');
                    $dadosusuario ['email'] = $this->input->post('email');
                    $dadosusuario ['senha'] = $this->input->post('senha');
                    $dadosusuario ['datacadastro'] = date('Y-m-d');
                    $dadosusuario ['perfilid'] = $this->input->post('perfilid');
                    $dadosusuario ['status'] = 1;

                    $this->load->model('model_usuario');
                    $resultadocadastrousuario = $this->model_usuario->cadastrausuario($dadosusuario);

                    if ($resultadocadastrousuario) {
                        $dados ['telaativa'] = 'usuarios';
                        $dados ['tela'] = 'view_dashboard';
                    } else {
                        $dados ['telaativa'] = 'usuarios';
                        $dados ['msg'] = 'Ocorreu um erro ao cadastrar o usuario! Atualize a p�gina e tente novamente';
                        $dados ['tela'] = 'usuarios/view_cadastrousuario';
                    }
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['telaativa'] = 'usuarios';
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'usuarios/view_cadastrousuario';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['telaativa'] = 'usuarios';
                $dados ['tela'] = 'usuarios/view_cadastrousuario';
                $this->load->view('view_home', $dados);
            }
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
            $resultadoCursos = $this->Model_cursos->buscaCursos();
          //  var_dump($resultadoCursos);
            $dados ['resultadoCursos'] = $resultadoCursos;

            $dados ['telaativa'] = 'cursos';
            $dados ['tela'] = 'cursos/view_cadcursos';
            $this->load->view('view_home', $dados);
        }
    

    


    function consultausuario() {
        if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
            $this->load->model('model_usuario');
            if ($this->input->post()) {
                if ((!empty(trim($this->input->post('nome')))) || (!empty(trim($this->input->post('login')))) || (!empty(trim($this->input->post('email'))))) {
                    $dadosusuario ['nome'] = $this->input->post('nome');
                    $dadosusuario ['login'] = $this->input->post('login');
                    $dadosusuario ['email'] = $this->input->post('email');

                    $this->load->model('model_usuario');
                    $resultadousuario = $this->model_usuario->consultausuario($dadosusuario);
                    if ($resultadousuario) {
                        $dados ['telaativa'] = 'usuarios';
                        $dados ['resultadoUsuario'] = $resultadousuario;
                        $dados ['tela'] = 'usuarios/view_listausuario';
                        $this->load->view('view_home', $dados);
                    } else {
                        $dados ['telaativa'] = 'usuarios';
                        $dados ['msg'] = 'Nenhum Usuário localizado para os dados informados! Tente novamente';
                        $dados ['tela'] = 'usuarios/view_listausuario';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados ['telaativa'] = 'usuarios';
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'usuarios/view_formconsultausuario';
                    $this->load->view('view_home', $dados);
                }
            } else if ($this->input->get()) {
                if ($this->input->get('id')) {
                    $id = (int) $this->input->get('id');

                    $this->load->model('model_usuario');
                    $resultadousuarioespecifico = $this->model_usuario->consultausuarioespecifico($id);
                    if ($resultadousuarioespecifico) {
                        $dados ['telaativa'] = 'usuarios';
                        $dados ['resultadoUsuarioEspecifico'] = $resultadousuarioespecifico;
                        $dados ['tela'] = 'usuarios/view_formalterausuario';
                        $this->load->view('view_home', $dados);
                    } else {
                        $dados ['telaativa'] = 'usuarios';
                        $dados ['msg'] = 'Nenhum Usuário localizado para os dados informados! Tente novamente';
                        $dados ['tela'] = 'usuarios/view_listausuario';
                        $this->load->view('view_home', $dados);
                    }
                }
            } else {
                $dados ['telaativa'] = 'usuarios';
                $dados ['tela'] = 'usuarios/view_formconsultausuario';
                $this->load->view('view_home', $dados);
            }
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
