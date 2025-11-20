<?php
require_once __DIR__ . '/../Helper/FlashMessage.php';
$success = \Infrastructure\Framework\Helper\FlashMessage::getSuccess();
$error = \Infrastructure\Framework\Helper\FlashMessage::getError();
?>
<main class="register-container">
    <h1 class="register-title">Crear Usuario</h1>
    <?php if (!empty($success)): ?>
        <div class="register-alert success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="register-alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form class="register-form" action="/?register=do" method="POST">
        <div class="register-field">
            <label class="register-label">Nombre:
                <input class="register-input" type="text" name="name" required>
            </label>
        </div>

        <div class="register-field">
            <label class="register-label">Email:
                <input class="register-input" type="email" name="email" required>
            </label>
        </div>

        <div class="register-field">
            <label class="register-label">Contraseña (mínimo 6 caracteres):
                <input class="register-input" type="password" name="password" minlength="6" required>
            </label>
        </div>

        <button class="register-button" type="submit">Crear</button>
        <a class="register-link" href="/?login=form">¿Ya tienes cuenta? Inicia sesión</a>
    </form>
</main>