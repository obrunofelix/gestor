<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionarios_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Carrega biblioteca de sessão e o model de funcionários
        $this->load->library('session');
        $this->load->model('funcionarios');

        // Métodos que não exigem que o usuário seja gestor
        $permitidosSemGestor = ['perfil_funcionario', 'get_funcionario'];
        $metodoAtual = $this->router->method;

        // Para todos os outros métodos, exige que o usuário seja gestor
        if (!in_array($metodoAtual, $permitidosSemGestor)) {
            $this->verifica_gestor();
        }
    }

    // Impede acesso de usuários não gestores aos métodos protegidos
    private function verifica_gestor() {
        if ($this->session->userdata('tipo') != 'gestor') {
            $this->session->set_flashdata('erro', 'Você não tem permissão para acessar essa página.');
            redirect(base_url()); // Redireciona para o início
        }
    }

    // Lista todos os funcionários e carrega a view principal
    public function listar_funcionarios() {
        $funcionarios = $this->funcionarios->get_all();

        $this->load->view('Funcionarios_view', [
            'funcionarios' => $funcionarios
        ]);
    }

    // View de formulário para adicionar funcionário
    public function formmulario_funcionario() {
        $this->load->view('Add_funcionario_view');
    }

    // Recebe POST e adiciona novo funcionário no banco
    public function add_funcionario() {
        $dadosFormulario = $this->input->post();
        $this->funcionarios->insert($dadosFormulario);
        redirect('funcionarios');
    }

    // View de formulário para editar funcionário
    public function formulario_editar() {
        $idFuncionario = $this->input->get('id');
        $dadosFuncionario = $this->funcionarios->get_by_id($idFuncionario);

        $this->load->view('Editar_funcionario_view', [
            'funcionario' => $dadosFuncionario
        ]);
    }

    // Recebe POST e atualiza dados do funcionário
    public function editar_funcionario() {
        $dadosFormulario = $this->input->post();
        $this->db->update("funcionarios", $dadosFormulario, ['id' => $dadosFormulario['id']]);
        redirect('funcionarios');
    }

    // Apaga funcionário (com proteção para evitar autoexclusão)
    public function formulario_apagar() {
        $idFuncionario = $this->input->get('id');
        $idLogado = $this->session->userdata('id');

        if ($idFuncionario == $idLogado) {
            $this->session->set_flashdata('erro', 'Você não pode se excluir.');
            redirect('funcionarios');
            return;
        }

        $this->db->delete("funcionarios", ['id' => $idFuncionario]);
        redirect('funcionarios');
    }

    // View do perfil do funcionário (somente se logado)
    public function perfil_funcionario() {
        $funcionario = $this->session->userdata('id');

        if ($funcionario) {
            $this->load->view('Funcionario_perfil_view');
        } else {
            redirect(base_url());
        }
    }

    // Retorna dados de funcionário via JSON (usado em edição via AJAX)
    public function get_funcionario() {
        $id = $this->input->get('id');
        $funcionario = $this->funcionarios->get_by_id($id);
        echo json_encode($funcionario);
    }

    public function ajax_listar_funcionarios() {
        $funcionarios = $this->funcionarios->get_all();
        echo json_encode($funcionarios);
    }
    
}
