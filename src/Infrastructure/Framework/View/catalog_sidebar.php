<aside class="catalog-sidebar">
    <form method="GET" action="/?shop=catalog">
        <h3 style="margin-top:0;">Filtrar</h3>
        <div style="margin-bottom:1rem;">
            <label for="cat">Categoría:</label>
            <select name="cat" id="cat" style="width:100%;padding:0.3rem;">
                <option value="">Todas</option>
                <option value="electronica">Electrónica</option>
                <option value="libros">Libros</option>
                <option value="hogar">Hogar</option>
                <option value="moda">Moda</option>
                <option value="deportes">Deportes</option>
            </select>
        </div>
        <div style="margin-bottom:1rem;">
            <label>Precio:</label><br>
            <input type="number" name="min" placeholder="Mín" style="width:45%;"> - 
            <input type="number" name="max" placeholder="Máx" style="width:45%;">
        </div>
        <div style="margin-bottom:1rem;">
            <label for="order">Ordenar por:</label>
            <select name="order" id="order" style="width:100%;padding:0.3rem;">
                <option value="">Relevancia</option>
                <option value="price_asc">Precio menor</option>
                <option value="price_desc">Precio mayor</option>
                <option value="name_asc">Nombre A-Z</option>
                <option value="name_desc">Nombre Z-A</option>
            </select>
        </div>
        <button type="submit" style="width:100%;background:#febd69;color:#232f3e;border:none;padding:0.5rem 0;border-radius:4px;font-weight:bold;">Filtrar</button>
    </form>
</aside>
