<div class="checkout-container">
    <h1>Resumen del Pedido</h1>
    <?php if (!empty($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <div class="checkout-section checkout-summary">
        <h2>Artículos del Pedido</h2>
        <?php if (!empty($cart)): ?>
            <?php foreach ($cart as $item): ?>
                <div class="summary-item">
                    <span>Producto ID: <?= $item['product_id'] ?> × <?= $item['quantity'] ?></span>
                    <span>Cantidad: <?= $item['quantity'] ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tu carrito está vacío.</p>
        <?php endif; ?>
    </div>

    <div class="checkout-section">
        <h2>Información de Entrega</h2>
        <p>La entrega será a la dirección registrada en tu perfil.</p>
        <p><strong>Nota:</strong> Este es un pago simulado. En producción integrarías Stripe/PayPal aquí.</p>
    </div>

    <div class="checkout-section">
        <form method="POST" action="/?order=checkout">
            <div style="margin: 20px 0;">
                <button type="submit" class="btn">Confirmar Pedido</button>
                <a class="btn btn-secondary" href="/?cart=view">Volver al Carrito</a>
            </div>
        </form>
    </div>
</div>