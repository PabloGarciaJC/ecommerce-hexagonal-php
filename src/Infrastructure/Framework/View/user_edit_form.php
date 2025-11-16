<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="/public/assets/css/users.css">
</head>

<body class="users">
    <?php include __DIR__ . '/header.php'; ?>

    <main class="users__main">
        <h1 class="users__title">Editar Usuario</h1>

        <form class="users__form" action="/?user=update" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user->getId()) ?>">

            <div class="users__field">
                <label class="users__label">Nombre
                    <input class="users__input" type="text" name="name" value="<?= htmlspecialchars($user->getName()) ?>">
                </label>
            </div>

            <div class="users__field">
                <label class="users__label">Email
                    <input class="users__input" type="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>">
                </label>
            </div>

            <div class="users__field">
                <label class="users__label">Contraseña (dejar en blanco para mantenerla)
                    <input class="users__input" type="password" name="password">
                </label>
            </div>

            <button class="users__button users__button--primary" type="submit">Guardar cambios</button>
        </form>
    </main>
</body>

</html>
