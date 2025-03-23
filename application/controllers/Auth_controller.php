<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_controller extends CI_Controller {

    // Página inicial de login
    public function index() {
        $this->load->view("Login_view");
    }

    // Processa o login
    public function logar() {
        // Coleta os dados do formulário
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        // Busca funcionário pelo e-mail
        $funcionario = $this->db
                            ->get_where("funcionarios", ['email' => $email])
                            ->row_array();

        if ($funcionario) {
            // Verifica se a senha está correta
            if ($funcionario['senha'] == $senha) {
                // Login bem-sucedido: armazena os dados na sessão
                $this->session->set_userdata($funcionario);
                redirect('perfil');
            } else {
                // Senha incorreta
                $this->session->set_flashdata('erro', 'Usuário ou senha incorretos.');
                redirect(base_url());
            }
        } else {
            // E-mail não encontrado no banco
            $this->session->set_flashdata('erro', 'Usuário ou senha incorretos.');
            redirect(base_url());
        }
    }

    // Faz logout do sistema
    public function deslogar() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
