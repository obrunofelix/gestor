<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionarios_controller extends CI_Controller {
    public function listar_funcionarios() {
      $isGestor = $this->session->userdata('tipo')  == 'gestor';
      
      if($isGestor) {
        $funcionarios = $this->funcionarios->get_all();

		    $this->load->view('Funcionarios_view', 
          ['funcionarios' => $funcionarios]
        );
      } else{
        header("location:perfil");
      }
    }

    public function formmulario_funcionario() {
		  $this->load->view('Add_funcionario_view');
    }

    public function add_funcionario() {
      $dadosFormulario = $this->input->post();
      $this->funcionarios->insert($dadosFormulario);
      header("location:funcionarios");
    }

    public function formulario_editar() {
      $idFuncionario = $this->input->get('id');
      $dadosFuncionario = $this->funcionarios->get_by_id($idFuncionario);
		  $this->load->view('Editar_funcionario_view', ['funcionario' => $dadosFuncionario]);
    }

    public function editar_funcionario() {
      $dadosFormulario = $this->input->post();
      $this->db->update("funcionarios", $dadosFormulario, ['id' => $dadosFormulario['id']]);
      header("location:funcionarios");
    }

    public function formulario_apagar() {
      $idFuncionario = $this->input->get('id');
      $dadosFuncionario = $this->db->delete("funcionarios", ['id' => $idFuncionario]);
      header("location:funcionarios");
    }

    public function perfil_funcionario() {
      $funcionario = $this->session->userdata('id');

      if($funcionario) {
        $this->load->view('Funcionario_perfil_view');
      } else{
        header("location: " . base_url());
      }
    } 


}