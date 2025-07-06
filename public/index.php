<?php
    

    // if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'D') {
    //     header('Location: logout.php');
    //     exit;
    // }
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();

    require_once __DIR__ . '/../app/controllers/DoadorController.php';
    require_once __DIR__ . '/../app/controllers/ItemController.php';
    require_once __DIR__ . '/../app/controllers/InstituicaoController.php';
    require_once __DIR__ . '/../app/controllers/DoacaoController.php';
    require_once __DIR__ . '/../app/controllers/DoacaoItemController.php';
    require_once __DIR__ . '/../app/controllers/UsuarioController.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'cadastrarDoador') {
        $controller = new DoadorController();
        $resultado = $controller->cadastrar($_POST);
        echo json_encode($resultado);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'cadastrarInstituicao') {
        $controller = new InstituicaoController();
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
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'listarInstituicoes') {
        $controller = new InstituicaoController();
        $resultado = $controller->listar();
        echo json_encode($resultado);
    }
   
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'listarDoadores') {
        $controller = new DoadorController();
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'registrarDoacao') {
        $controller = new DoacaoController();
        $resultado = $controller->cadastrar($_POST);
        echo json_encode($resultado);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'registrarDoacaoItem') {
        $controller = new DoacaoItemController();
        $resultado = $controller->registrar($_POST);
        echo json_encode($resultado);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'deletarUsuario') {
        $controller = new UsuarioController();
        $resultado = $controller->deletar($_POST['id']);
        echo json_encode($resultado);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'atualizarDoador') {
        $controller = new DoadorController();
        $resultado = $controller->atualizar($_POST);
        echo json_encode($resultado);
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'consultarPorEmail') {
        $controller = new UsuarioController();
        $resultado = $controller->consultarPorEmail($_SESSION['usuario_id']);//$_GET['email'] para testar
        echo json_encode($resultado);
    }
?>