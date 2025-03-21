<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <h1>Olá <?= $this->session->userdata('nome');?></h1>

    <a href="deslogar">
        <button>Sair do sistema</button>
    </a>
    
    <?php if ($this->session->userdata('tipo') == 'gestor') { ?>
            <a href="funcionarios">
            <button>Lista de funcionarios</button>
        </a>
    <?php } ?>

</body>
</html>