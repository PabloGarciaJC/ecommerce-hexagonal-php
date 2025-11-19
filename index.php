<?php
require __DIR__ . '/vendor/autoload.php';

use Infrastructure\Persistence\Database;
use Infrastructure\Persistence\MySQLUserRepository;
use Infrastructure\Persistence\MySQLProductRepository;
use Infrastructure\Persistence\MySQLOrderRepository;
use Application\UseCase\CreateUser;
use Application\UseCase\ListUsers;
use Application\UseCase\UpdateUser;
use Application\UseCase\DeleteUser;
use Application\UseCase\ListProducts;
use Application\UseCase\ShowProduct;
use Application\UseCase\CreateProduct;
use Application\UseCase\CreateOrder;
use Infrastructure\Framework\Http\UserController;
use Infrastructure\Framework\Http\AuthController;
use Infrastructure\Framework\Http\ProductController;
use Infrastructure\Framework\Http\CartController;
use Infrastructure\Framework\Http\OrderController;

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Conexión y repositorios
$pdo = Database::connect();
$userRepository    = new MySQLUserRepository($pdo);
$productRepository = new MySQLProductRepository($pdo);
$orderRepository   = new MySQLOrderRepository($pdo);

// Casos de uso
$createUser    = new CreateUser($userRepository);
$listUsers     = new ListUsers($userRepository);
$updateUser    = new UpdateUser($userRepository);
$deleteUser    = new DeleteUser($userRepository);

$listProducts  = new ListProducts($productRepository);
$showProduct   = new ShowProduct($productRepository);
$createProduct = new CreateProduct($productRepository);

$createOrder   = new CreateOrder($orderRepository, $productRepository);

// Controladores
$userController    = new UserController($createUser, $listUsers, $updateUser, $deleteUser);
$authController    = new AuthController($userRepository);
$productController = new ProductController($listProducts, $showProduct, $createProduct);
$cartController    = new CartController();
$orderController   = new OrderController($createOrder);

// Detectar página
$page = key($_GET) ?? 'home';

// EMPEZAR BUFFER (todo lo que imprima el controlador se guarda)
ob_start();

// ---------------- ROUTER --------------------------

switch ($page) {

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' || ($_GET['login'] ?? '') === 'do') {
            $authController->login($_POST);
        } else {
            $authController->showLoginForm();
        }
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'register':
        ($_SERVER['REQUEST_METHOD'] === 'POST') ? $userController->store($_POST) : $userController->form();
        break;

    case 'list':
        $userController->index();
        break;

    case 'user':
        $action = $_GET['user'] ?? '';
        switch ($action) {
            case 'edit':   $userController->edit($_GET); break;
            case 'update': if ($_SERVER['REQUEST_METHOD'] === 'POST') $userController->update($_POST); break;
            case 'delete': if ($_SERVER['REQUEST_METHOD'] === 'POST') $userController->delete($_POST); break;
            default: header('Location: /?list=listar'); exit;
        }
        break;

    case 'shop':
        $action = $_GET['shop'] ?? '';
        switch ($action) {
            case 'catalog': $productController->index(); break;
            case 'product': $productController->show(); break;
            case 'create': if ($_SERVER['REQUEST_METHOD'] === 'GET') $productController->create(); break;
            case 'store': if ($_SERVER['REQUEST_METHOD'] === 'POST') $productController->store(); break;
            default: $productController->index();
        }
        break;

    case 'cart':
        $action = $_GET['cart'] ?? '';
        switch ($action) {
            case 'view':   $cartController->view(); break;
            case 'add':    if ($_SERVER['REQUEST_METHOD'] === 'POST') $cartController->add(); break;
            case 'remove': if ($_SERVER['REQUEST_METHOD'] === 'POST') $cartController->remove(); break;
            case 'clear':  $cartController->clear(); break;
            default:       $cartController->view();
        }
        break;

    case 'order':
        $action = $_GET['order'] ?? '';
        switch ($action) {
            case 'checkout': if ($_SERVER['REQUEST_METHOD'] === 'POST') $orderController->checkout(); break;
            case 'success':  $orderController->viewOrder(); break;
            default:         $productController->index();
        }
        break;

    default:
        $products = $productRepository->findAll();
        include __DIR__ . '/src/Infrastructure/Framework/View/home.php';
}

// ---------------- FIN ROUTER --------------------------

$content = ob_get_clean(); // capturamos el contenido del router
?>
<!doctype html>
<html>

<?php include __DIR__ . '/src/Infrastructure/Framework/View/head.php'; ?>

<body>

<?php include __DIR__ . '/src/Infrastructure/Framework/View/header.php'; ?>

<?= $content ?> <!-- Se inserta lo que imprimio el router -->

<?php include __DIR__ . '/src/Infrastructure/Framework/View/footer.php'; ?>

</body>
</html>
