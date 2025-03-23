<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <!-- Configuração de caracteres e responsividade -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Perfil - Casacare</title>

  <!-- Importação da fonte Inter do Google Fonts -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');

    /* Configurações globais */
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background-color: #f7f7f7;
      color: #000;
    }

    /* --- NAVBAR --- */
    .navbar {
      width: 100%;
      background-color: #fff;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #eee;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .navbar .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar .logo img {
      height: 35px;
    }

    .navbar .menu a {
      margin-left: 20px;
      text-decoration: none;
      color: #333;
      font-weight: 500;
      transition: color 0.3s;
    }

    .navbar .menu a:hover {
      color: #000;
    }

    /* --- CONTAINER DO PERFIL --- */
    .profile-container {
      max-width: 800px;
      margin: 60px auto;
      padding: 40px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    /* Cabeçalho do perfil (foto + nome e cargo) */
    .profile-header {
      display: flex;
      align-items: center;
      gap: 25px;
      border-bottom: 1px solid #eee;
      padding-bottom: 30px;
      margin-bottom: 30px;
    }

    .profile-header img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #000;
    }

    .profile-info h2 {
      margin: 0;
      font-size: 24px;
      font-weight: 600;
    }

    .profile-info p {
      margin: 4px 0;
      color: #666;
      font-size: 14px;
    }

    /* Informações detalhadas do perfil */
    .profile-details {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .detail-box {
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      border: 1px solid #e1e1e1;
    }

    .detail-box h4 {
      margin: 0 0 5px;
      font-size: 13px;
      color: #888;
      text-transform: uppercase;
    }

    .detail-box p {
      margin: 0;
      font-size: 15px;
      font-weight: 500;
    }

    /* Ações disponíveis no perfil */
    .profile-actions {
      margin-top: 40px;
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      flex-wrap: wrap;
    }

    /* Botões */
    .btn {
      padding: 12px 20px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-edit {
      background-color: #000;
      color: #fff;
    }

    .btn-edit:hover {
      background-color: #333;
      transform: translateY(-2px);
    }

    .btn-logout {
      background-color: #eee;
      color: #000;
    }

    .btn-logout:hover {
      background-color: #ddd;
      transform: translateY(-2px);
    }

    /* Responsividade para telas menores */
    @media (max-width: 600px) {
      .profile-details {
        grid-template-columns: 1fr;
      }

      .profile-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .navbar {
        flex-direction: column;
        gap: 10px;
        text-align: center;
      }

      .navbar .menu {
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR COM LOGO -->
  <div class="navbar">
    <div class="logo">
      <img src="https://i.imgur.com/Ek4QgNJ.jpeg" alt="Casacare Logo">
      <strong>Casacare</strong>
    </div>
  </div>

  <!-- CONTAINER PRINCIPAL DO PERFIL -->
  <div class="profile-container">

    <!-- Cabeçalho do perfil (imagem e dados principais) -->
    <div class="profile-header">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZ6th-oTbkDMbDOPGU_kkRMM55lfvRYgM8JA&s" alt="Foto de Perfil" />
      <div class="profile-info">
        <h2>Olá, <?= $this->session->userdata('nome');?>! Seja bem-vindo.</h2>
        
      </div>
    </div>

    <!-- Detalhes de contato -->
    <div class="profile-details">
      <div class="detail-box">
        <h4>Telefone</h4>
        <p><?= $this->session->userdata('telefone');?></p>
      </div>
      <div class="detail-box">
        <h4>E-mail</h4>
        <p><?= $this->session->userdata('email');?></p>
      </div>
      <div class="detail-box">
        <h4>Cargo</h4>
        <p><?= $this->session->userdata('cargo');?></p>
      </div>
      <div class="detail-box">
        <h4>Setor</h4>
        <p><?= $this->session->userdata('setor');?></p>
      </div>
      <div class="detail-box">
        <h4>Tipo</h4>
        <p><?= $this->session->userdata('tipo');?></p>
      </div>
    </div>

    <!-- Ações do perfil -->
    <div class="profile-actions">
      <?php if ($this->session->userdata('tipo') == 'gestor') { ?>
        <!-- Botão para visualizar a lista de funcionários, visível apenas para gestores -->
        <a href="funcionarios">
          <button class="btn btn-edit">Lista de Funcionários</button>
        </a>
      <?php } ?>

      <!-- Botão de logout -->
      <a href="deslogar">
        <button class="btn btn-logout">Sair</button>
      </a>
    </div>

  </div>

  <!-- Rodapé -->
  <footer style="text-align: center; font-size: 13px; color: #888; margin-top: 60px; padding: 20px 0;">
    © Casacare 2025 — Todos os direitos reservados.
  </footer>

</body>
</html>