<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="/public/assets/css/users.css">
    <style>
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 3px; }
        .alert-success { background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .alert-error { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
    </style>
</head>

<body class="users">
    <?php 
    require_once __DIR__ . '/../Helper/FlashMessage.php';
    include __DIR__ . '/header.php'; 
    $success = \Infrastructure\Framework\Helper\FlashMessage::getSuccess();
    $error = \Infrastructure\Framework\Helper\FlashMessage::getError();
    ?>

    <main class="users__main">
        <h1 class="users__title">Iniciar sesión</h1>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form class="users__form" action="/?login=do" method="POST">
            <div class="users__field">
                <label class="users__label">Email
                    <input class="users__input" type="email" name="email" required>
                </label>
            </div>

            <div class="users__field">
                <label class="users__label">Contraseña
                    <input class="users__input" type="password" name="password" required>
                </label>
            </div>

            <button class="users__button users__button--primary" type="submit">Entrar</button>
        </form>

        <p class="users__help"><a class="users__link" href="/?register=form">¿No tienes cuenta? Regístrate</a></p>
    </main>
</body>

</html>
