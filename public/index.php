<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/controllers/DoadorController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'cadastrar') {
    $controller = new DoadorController();
    $resultado = $controller->cadastrar($_POST);
    echo json_encode($resultado);
} else {
    include __DIR__ . '/../app/views/cadastro.html';
}
?>