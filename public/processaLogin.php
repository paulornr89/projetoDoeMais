<?php
    require_once __DIR__ . '/../app/controllers/UsuarioController.php';

    $controller = new UsuarioController();
    $controller->autenticar($_POST);
?>

<script>
    sessionStorage.clear();
</script>