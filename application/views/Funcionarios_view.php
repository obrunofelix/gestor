  <!DOCTYPE html>
  <html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Listagem de Funcionários</title>
    
    <!-- Importando a fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
      /* Estilos globais */
      * { box-sizing: border-box; }
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
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
      }
      .navbar .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
      }
      .navbar img { height: 30px; }
      .navbar a {
        text-decoration: none;
        color: #333;
        margin-left: 20px;
        font-weight: 500;
      }
      .navbar a:hover { color: #000; }
      
      /* --- CONTEÚDO PRINCIPAL --- */
      .container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      }
      h1 { font-size: 26px; font-weight: 600; margin-bottom: 20px; }
      .btn-add {
        background-color: #000;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 20px;
      }
      .btn-add:hover {
        background-color: #333;
        transform: translateY(-2px);
      }
      
      /* --- TABELA --- */
      table { width: 100%; border-collapse: collapse; font-size: 14px; }
      thead { background-color: #f0f0f0; }
      th, td {
        padding: 12px 10px;
        text-align: left;
        border-bottom: 1px solid #e1e1e1;
      }
      th {
        font-weight: 600;
        color: #555;
        text-transform: uppercase;
        font-size: 13px;
      }
      tr:hover { background-color: #f9f9f9; }
      td:last-child {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: flex-start;
      }
      .btn-sm {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
      .btn-warning { background-color: #000; color: #fff; }
      .btn-warning:hover {
        background-color: #333;
        transform: translateY(-2px);
      }
      .btn-danger {
        background-color: #d9534f;
        color: #fff;
      }
      .btn-danger:hover {
        background-color: #c9302c;
        transform: translateY(-2px);
      }
      
      /* --- RODAPÉ --- */
      footer {
        text-align: center;
        font-size: 13px;
        color: #aaa;
        margin-top: 60px;
        padding: 20px 0;
      }
      
      /* --- RESPONSIVIDADE --- */
      @media (max-width: 600px) {
        .navbar {
          flex-direction: column;
          align-items: flex-start;
        }
        .navbar a { margin: 5px 0 0; }
        table { font-size: 12px; }
        th, td { padding: 10px 6px; }
      }
      
      /* --- MODAIS --- */
      .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
      }
      .modal.show {
        display: flex;
        opacity: 1;
      }
      .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        max-width: 600px;
        width: 100%;
        position: relative;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        animation: modalAnim 0.4s;
        max-height: 90vh;  /* Altura máxima limitada à tela */
        overflow-y: auto;  /* Scroll vertical quando necessário */
      }
      @keyframes modalAnim {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
      }
      .close {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 24px;
        cursor: pointer;
        color: #555;
        transition: color 0.3s;
      }
      .close:hover { color: #000; }
      
      /* --- FORMULÁRIOS --- */
      .form-group { margin-bottom: 15px; }
      .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
      }
      .form-group input,
      .form-group select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
      }
    </style>
  </head>
  <body>

    <!-- NAVBAR -->
    <div class="navbar">
      <div class="logo">
        <img src="https://i.imgur.com/Ek4QgNJ.jpeg" alt="Logo Casacare">
        Casacare
      </div>
      <div>
        <a href="perfil">Voltar</a>
        <a href="deslogar" style="color: #d00;">Sair</a>
      </div>
    </div>

    <?php $idLogado = $this->session->userdata('id'); ?>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="container">
      <h1>Listagem de Funcionários</h1>
      
      <!-- Botão de adicionar funcionário -->
      <button class="btn-add" onclick="abrirModal('modalAdicionarFuncionario')">Adicionar Funcionário</button>
      
      <!-- Filtros de busca -->
      <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Pesquisar por nome..." />
      <input type="text" id="searchId" onkeyup="filterTable()" placeholder="Pesquisar por ID..." />
      
      <!-- Botões de ordenação -->
      <div style="margin-bottom: 20px;">
        <button class="btn-add" onclick="sortTableByName(true)">Nome A-Z</button>
        <button class="btn-add" onclick="sortTableByName(false)">Nome Z-A</button>
        <button class="btn-add" onclick="sortTableById(true)">ID ↑</button>
        <button class="btn-add" onclick="sortTableById(false)">ID ↓</button>
      </div>
      
      <!-- Tabela de funcionários -->
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Setor</th>
            <th>Email</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($funcionarios as $funcionario) { ?>
            <tr>
              <td><?= $funcionario['id'] ?></td>
              <td>
                <?= $funcionario['nome'] ?>
                <?php if ($funcionario['id'] == $idLogado): ?>
                  <span style="color: red; font-size: 0.9em;">(VOCÊ)</span>
                <?php endif; ?>
              </td>
              <td><?= $funcionario['cpf'] ?></td>
              <td><?= $funcionario['cargo'] ?></td>
              <td><?= $funcionario['setor'] ?></td>
              <td><?= $funcionario['email'] ?></td>
              <td>
                <button class="btn-sm btn-warning" onclick="abrirModalEditar(<?= $funcionario['id'] ?>)">Editar</button>
                <?php if ($funcionario['id'] != $idLogado): ?>
                  <button onclick="apagar_funcionario(<?= $funcionario['id'] ?>)" class="btn-sm btn-danger">Apagar</button>
                <?php endif; ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- RODAPÉ -->
    <footer>
      © Casacare 2025 — Todos os direitos reservados.
    </footer>

    <!-- MODAL ADICIONAR FUNCIONÁRIO -->
    <div id="modalAdicionarFuncionario" class="modal">
      <div class="modal-content">
        <span class="close" onclick="fecharModal('modalAdicionarFuncionario')">&times;</span>
        <h2>Adicionar Funcionário</h2>
        <form id="formAdicionar">
          <div class="form-group">
            <label>Nome</label>
            <input name="nome" required>
          </div>
          <div class="form-group">
            <label>Cargo</label>
            <input name="cargo" required>
          </div>
          <div class="form-group">
            <label>Setor</label>
            <input name="setor" required>
          </div>
          <div class="form-group">
            <label>CPF</label>
            <input name="cpf" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input name="email" required>
          </div>
          <div class="form-group">
            <label>Telefone</label>
            <input name="telefone">
          </div>
          <div class="form-group">
            <label>Senha</label>
            <input name="senha" required>
          </div>
          <div class="form-group">
            <label>Tipo</label>
            <select name="tipo" required>
              <option value="comum">Comum</option>
              <option value="gestor">Gestor</option>
            </select>
          </div>
          <button class="btn-add" type="submit">Salvar</button>
        </form>
      </div>
    </div>

    <!-- MODAL EDITAR FUNCIONÁRIO -->
    <div id="modalEditarFuncionario" class="modal">
      <div class="modal-content">
        <span class="close" onclick="fecharModal('modalEditarFuncionario')">&times;</span>
        <h2>Editar Funcionário</h2>
        <form id="formEditar">
          <input type="hidden" name="id" id="editar-id">
          <div class="form-group">
            <label>Nome</label>
            <input name="nome" id="editar-nome" required>
          </div>
          <div class="form-group">
            <label>Cargo</label>
            <input name="cargo" id="editar-cargo" required>
          </div>
          <div class="form-group">
            <label>Setor</label>
            <input name="setor" id="editar-setor" required>
          </div>
          <div class="form-group">
            <label>CPF</label>
            <input name="cpf" id="editar-cpf" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input name="email" id="editar-email" required>
          </div>
          <div class="form-group">
            <label>Telefone</label>
            <input name="telefone" id="editar-telefone">
          </div>
          <div class="form-group">
            <label>Senha</label>
            <input name="senha" id="editar-senha" required>
          </div>
          <div class="form-group">
            <label>Tipo</label>
            <select name="tipo" id="editar-tipo" required>
              <option value="comum">Comum</option>
              <option value="gestor">Gestor</option>
            </select>
          </div>
          <button class="btn-add" type="submit">Atualizar</button>
        </form>
      </div>
    </div>

    <!-- JS: SweetAlert2, jQuery e scripts personalizados -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
      // Define a variável global com o ID do usuário logado
      const idLogado = <?= json_encode($idLogado) ?>;

      // Função para atualizar a tabela via AJAX
      function atualizarTabela() {
        $.getJSON('ajax-funcionarios', function(data) {
          let tbodyHtml = '';
          data.forEach(function(funcionario) {
            tbodyHtml += `<tr>
                            <td>${funcionario.id}</td>
                            <td>
                              ${funcionario.nome} ${funcionario.id == idLogado ? '<span style="color: red; font-size: 0.9em;">(VOCÊ)</span>' : ''}
                            </td>
                            <td>${funcionario.cpf}</td>
                            <td>${funcionario.cargo}</td>
                            <td>${funcionario.setor}</td>
                            <td>${funcionario.email}</td>
                            <td>
                              <button class="btn-sm btn-warning" onclick="abrirModalEditar(${funcionario.id})">Editar</button>
                              ${funcionario.id != idLogado ? `<button onclick="apagar_funcionario(${funcionario.id})" class="btn-sm btn-danger">Apagar</button>` : ''}
                            </td>
                          </tr>`;
          });
          $('table tbody').html(tbodyHtml);
        });
      }

      // Exclusão de funcionário via AJAX com SweetAlert2
      const apagar_funcionario = (id) => {
        Swal.fire({
          title: "Você tem certeza?",
          text: "Essa ação não poderá ser revertida",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "Apagar"
        }).then((result) => {
          if (result.isConfirmed) {
            $.get('deletar-funcionario', { id: id }, function() {
              atualizarTabela(); // Atualiza imediatamente
              Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Funcionário apagado!',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
              });
            });
          }
        });
      }

      // Abrir e fechar modais
      function abrirModal(id) {
        $('#' + id).addClass('show');
      }
      function fecharModal(id) {
        $('#' + id).removeClass('show');
      }

      // Fechar modal ao clicar fora do conteúdo
    $(document).on('click', function(event) {
      if ($(event.target).hasClass('modal')) {
        fecharModal($(event.target).attr('id'));
      }
    });

      // Abrir modal de edição e preencher com dados via AJAX
      function abrirModalEditar(id) {
        $.get('get-funcionario', { id }, function(data) {
          $('#editar-id').val(data.id);
          $('#editar-nome').val(data.nome);
          $('#editar-cargo').val(data.cargo);
          $('#editar-setor').val(data.setor);
          $('#editar-cpf').val(data.cpf);
          $('#editar-email').val(data.email);
          $('#editar-telefone').val(data.telefone);
          $('#editar-senha').val(data.senha);
          $('#editar-tipo').val(data.tipo);
          abrirModal('modalEditarFuncionario');
        }, 'json');
      }

      // Submissão do formulário de adicionar funcionário via AJAX
      $('#formAdicionar').on('submit', function(e) {
        e.preventDefault();
        $.post('adicionar-funcionario', $(this).serialize(), function() {
          fecharModal('modalAdicionarFuncionario');
          atualizarTabela(); // Atualiza imediatamente
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Funcionário adicionado com sucesso!',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });
        });
      });

      // Submissão do formulário de editar funcionário via AJAX
      $('#formEditar').on('submit', function(e) {
        e.preventDefault();
        $.post('editar-funcionario', $(this).serialize(), function() {
          fecharModal('modalEditarFuncionario');
          atualizarTabela(); // Atualiza imediatamente
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Funcionário atualizado!',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });
        });
      });

      // Funções de filtro e ordenação da tabela
      function filterTable() {
        const nomeInput = document.getElementById("searchInput").value.toLowerCase();
        const idInput = document.getElementById("searchId").value.toLowerCase();
        const rows = document.querySelectorAll("table tbody tr");
        rows.forEach(row => {
          const nome = row.cells[1].innerText.toLowerCase();
          const id = row.cells[0].innerText.toLowerCase();
          row.style.display = nome.includes(nomeInput) && id.includes(idInput) ? "" : "none";
        });
      }
      function sortTableByName(asc = true) {
        const tbody = document.querySelector("table tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        rows.sort((a, b) => {
          const nomeA = a.cells[1].innerText.toLowerCase();
          const nomeB = b.cells[1].innerText.toLowerCase();
          return asc ? nomeA.localeCompare(nomeB) : nomeB.localeCompare(nomeA);
        });
        rows.forEach(row => tbody.appendChild(row));
      }
      function sortTableById(asc = true) {
        const tbody = document.querySelector("table tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        rows.sort((a, b) => {
          const idA = parseInt(a.cells[0].innerText);
          const idB = parseInt(b.cells[0].innerText);
          return asc ? idA - idB : idB - idA;
        });
        rows.forEach(row => tbody.appendChild(row));
      }
    </script>

    <!-- Alerta de erro (se houver flashdata) -->
    <?php if ($this->session->flashdata('erro')): ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?= $this->session->flashdata('erro'); ?>',
          showConfirmButton: false,
          timer: 1500
        });
      </script>
    <?php endif; ?>
  </body>
  </html>
