<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../app/controllers/DoadorController.php';
require_once __DIR__ . '/../app/controllers/ItemController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'cadastrarDoador') {
    $controller = new DoadorController();
    $resultado = $controller->cadastrar($_POST);
    echo json_encode($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'cadastrarItem') {
    $controller = new ItemController();
    $resultado = $controller->cadastrar($_POST);
    echo json_encode($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'listarItens') {
    $controller = new ItemController();
    $resultado = $controller->listar();
    echo json_encode($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'atualizarItem') {
    $controller = new ItemController();
    $resultado = $controller->atualizar($_POST);
    echo json_encode($resultado);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'deletarItem') {
    $controller = new ItemController();
    $resultado = $controller->deletar($_POST);
    echo json_encode($resultado);
}
?>