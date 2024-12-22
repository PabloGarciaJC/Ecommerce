
    <div class="categorias-container">
        <?php if (!empty($getCategorias['categorias']) && $getCategorias['categorias']->num_rows > 0) : ?>
            <?php while ($categoria = $getCategorias['categorias']->fetch_object()) : ?>
                <?php
                if (is_string($categoria->imagenes)) {
                    $imagenesArray = json_decode($categoria->imagenes, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $imagenesArray = [];
                    }
                } elseif (is_array($categoria->imagenes)) {
                    $imagenesArray = $categoria->imagenes;
                } else {
                    $imagenesArray = [];
                }
                if (!empty($imagenesArray) && isset($imagenesArray[0]['archivo'])) {
                    $imagenSrc = BASE_URL . 'uploads/images/categorias/' . $imagenesArray[0]['archivo'];
                } else {
                    $imagenSrc = BASE_URL . 'uploads/images/default.jpg';
                }
                ?>
                <a href="<?php echo BASE_URL; ?>Catalogo/index?categoriaId=<?= $categoria->id ?>" class="categoria-card">
                    <div class="categoria-header">
                        <img src="<?= $imagenSrc; ?>" alt="<?= htmlspecialchars($categoria->nombre); ?>" class="categoria-imagen">
                        <h3 class="categoria-nombre"><?= htmlspecialchars($categoria->nombre); ?></h3>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>