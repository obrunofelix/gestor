<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Casacare</title>

    <!-- Importa a fonte 'Inter' do Google Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap');

        /* Define o box-sizing padrão para todos os elementos */
        * {
            box-sizing: border-box;
        }

        /* Estilização geral do body da página */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #ffffff, #f0f0f0);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #000;
        }

        /* Container principal do formulário */
        .container {
            background: #fff;
            padding: 50px 40px;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: relative;
        }

        /* Espaço reservado para o logo */
        .logo {
            margin-bottom: 25px;
        }

        /* Estilização da imagem do logo */
        .logo img {
            max-width: 120px;
            height: auto;
        }

        /* Título do formulário */
        h1 {
            margin-bottom: 10px;
            font-size: 26px;
            font-weight: 600;
        }

        /* Parágrafo informativo abaixo do título */
        p {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        /* Estilização dos rótulos (labels) dos campos */
        label {
            display: block;
            text-align: left;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        /* Estilização dos campos de entrada */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
        }

        /* Efeito ao focar nos inputs */
        input:focus {
            border-color: #000;
            outline: none;
        }

        /* Estilização do botão de envio */
        .btn {
            width: 100%;
            padding: 14px;
            background: #000;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        /* Efeito hover no botão */
        .btn:hover {
            background: #222;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Estilização do rodapé */
        footer {
            margin-top: 25px;
            font-size: 12px;
            color: #888;
        }

        /* Responsividade para telas pequenas */
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }

            .logo img {
                max-width: 100px;
            }
        }
    </style>
</head>

<body>
    <!-- Container principal -->
    <div class="container">
        <!-- Área do logotipo -->
        <div class="logo">
            <!-- Substitua o src abaixo pelo caminho da imagem do logo -->
            <img src="https://i.imgur.com/Ek4QgNJ.jpeg" alt="Logo Casacare">
        </div>

        <!-- Título e subtítulo -->
        <h1>Login</h1>
        <p>Digite os seus dados de acesso no campo abaixo.</p>

        <!-- Formulário de login -->
        <form action="login" method="post">
            <label for="email">E-mail</label>
            <input name="email" type="email" placeholder="Digite seu e-mail" required />

            <label for="senha">Senha</label>
            <input name="senha" type="password" placeholder="Digite sua senha" required />

            <input type="submit" value="Acessar" class="btn" />
        </form>

        <!-- Rodapé -->
        <footer>© Casacare 2025 - Todos os direitos reservados.</footer>
    </div>

    <!-- Biblioteca SweetAlert2 para exibir alertas elegantes -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Verifica se há uma mensagem de erro e exibe com SweetAlert2 -->
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