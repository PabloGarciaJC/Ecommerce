<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard panel-admin__dashboard--categorias">
            <div class="panel-admin__category-form">
                <h2 class="panel-admin__dashboard-title">Nueva Categoría</h2>
                <form action="<?php echo BASE_URL ?>Admin/guardarCategorias" method="POST">
                    <input type="hidden" name="editid" value="<?php echo isset($_GET['editid']) ? $_GET['editid'] : ''; ?>">
                    <input type="hidden" name="deteleid" value="<?php echo isset($_GET['deteleid']) ? $_GET['deteleid'] : ''; ?>">
                    <input type="hidden" name="parentid" value="<?php echo isset($_GET['parentid']) ? $_GET['parentid'] : false; ?>">
                    <div class="form-group">
                        <label for="name">Nombre de la Categoría:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ejemplo: Electrónica" value="<?php echo isset($_SESSION['form']['name']) ? $_SESSION['form']['name'] : (isset($getCategoriasId->nombre) ? $getCategoriasId->nombre : ''); ?>">
                        <?php if (isset($_SESSION['errores']['name'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['name']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Descripción de la categoría..."><?php echo isset($_SESSION['form']['descripcion']) ? $_SESSION['form']['descripcion'] : (isset($getCategoriasId->descripcion) ? $getCategoriasId->descripcion : ''); ?></textarea>
                        <?php if (isset($_SESSION['errores']['descripcion'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['descripcion']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    if (isset($_GET['editid'])) {
                        $buttonClass = 'btn-warning';
                        $buttonText = 'Editar';
                    } elseif (isset($_GET['deteleid'])) {
                        $buttonClass = 'btn-danger';
                        $buttonText = 'Eliminar';
                    } else {
                        $buttonClass = 'btn-primary';
                        $buttonText = 'Guardar';
                    }
                    ?>
                    <button type="submit" class="btn <?php echo $buttonClass; ?>"><?php echo $buttonText; ?></button>
                    <a href="<?php echo BASE_URL; ?>Admin/ecommerce<?php echo isset($_GET['parentid']) ? '?parentid=' . $_GET['parentid'] : false; ?>" class="btn btn-primary">Volver</a>
                </form>
            </div>
        </section>
    </main>
</div>

<?php
// Limpiar sesión tras mostrar errores si la página se carga sin problemas.
if (!isset($_SESSION['errores'])) {
    unset($_SESSION['form']);
}
?>