<style>
    .table__favoritos td,
    .table__favoritos th {
        vertical-align: middle;
        /* Centra verticalmente el contenido */
        text-align: center;
        /* Centra horizontalmente el contenido */
    }

    .table-striped {
        text-align: center;
    }


    @media (max-width:767px) {
        .table-btns-striped {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
    }
</style>

<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Favoritos</h2>

            <?php if (isset($_SESSION['exito'])) : ?>
                <div class="alert <?php echo $_SESSION['messageClass']; ?> alert-dismissible fade show mt-2 text-center" role="alert">
                    <i class="<?php echo isset($_SESSION['icon']) ? $_SESSION['icon'] : 'fas fa-check-circle'; ?>"></i>
                    <?php echo $_SESSION['exito']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['exito'], $_SESSION['messageClass'], $_SESSION['icon']); ?>
            <?php endif; ?>

            <div class="panel-admin__category-list">
                <!-- Contenedor responsivo -->
               
                    <table class="table__favoritos table table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Imagen</th>
                                <th>Stock</th>
                                <th>Oferta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($favoritos)): ?>
                                <?php foreach ($favoritos as $producto): ?>
                                    <tr>
                                        <td><?php echo $producto->nombre; ?></td>
                                        <td>
                                            <?php
                                            $imagenes = json_decode($producto->imagenes);
                                            $imagenProducto = (!empty($imagenes) && !empty($imagenes[0]))
                                                ? BASE_URL . 'uploads/images/productos/' . $imagenes[0]
                                                : BASE_URL . 'uploads/images/productos/default.jpg';
                                            ?>
                                            <img src="<?php echo $imagenProducto; ?>" alt="Imagen del producto" style="width: 100px;">
                                        </td>
                                        <td><?php echo $producto->stock; ?></td>
                                        <td>
                                            <?php if (!empty($producto->oferta) && $producto->oferta > 0): ?>
                                                <span class="badge badge-success">En Oferta</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Sin Oferta</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="table-btns-striped">
                                            <a href="<?php echo BASE_URL; ?>Producto/ficha?id=<?php echo $producto->id; ?>&parent_id=<?php echo urlencode($producto->parent_id); ?>" class="btn btn-info btn-sm">Ver Producto</a>

                                            <a href="<?php echo BASE_URL; ?>Admin/eliminarFavoritos?id=<?php echo $producto->id; ?>" class="btn btn-danger btn-sm borrar-favorito">Eliminar</a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No tienes productos en favoritos.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
               
            </div>
        </section>
    </main>
</div>