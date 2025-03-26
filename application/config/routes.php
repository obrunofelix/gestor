<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Auth_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Funcionarios
$route['funcionarios']['get'] = 'Funcionarios_controller/listar_funcionarios';
// ROTAS PARA ADD FUNCIONARIO
$route['adicionar-funcionario']['get'] = 'Funcionarios_controller/formmulario_funcionario';
$route['adicionar-funcionario']['post'] = 'Funcionarios_controller/add_funcionario';
// ROTAS PARA EDITAR FUNCIONARIO
$route['editar-funcionario']['get'] = 'Funcionarios_controller/formulario_editar';
$route['editar-funcionario']['post'] = 'Funcionarios_controller/editar_funcionario';
// ROTAS PARA APAGAR FUNCIONARIO
$route['deletar-funcionario']['get'] = 'Funcionarios_controller/formulario_apagar';

$route['perfil']['get'] = 'Funcionarios_controller/perfil_funcionario';

// Auth_controller - >autentificação
$route['login']['post'] = 'Auth_controller/logar';
$route['deslogar']['get'] = 'Auth_controller/deslogar';

// Rotas para Funcionario (MODAL)
$route['get-funcionario']['get'] = 'Funcionarios_controller/get_funcionario';

$route['ajax-funcionarios']['get'] = 'Funcionarios_controller/ajax_listar_funcionarios';