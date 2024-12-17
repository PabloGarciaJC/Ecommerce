<?php

require_once 'model/productos.php';
require_once 'model/categorias.php';
require_once 'controllers/HomeController.php';

class ProductoController extends HomeController
{
  public function ficha()
  {
    $this->idiomas();
    $idProducto = isset($_GET['id']) ? $_GET['id'] : false;
    $usuario = Utils::obtenerUsuario();
    $producto = new Productos();
    $producto->setId($idProducto);
    $productoFicha = $producto->obtenerProductosPorId();
    $categorias = new Categorias();
    $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/producto/ficha.php';
    require_once 'views/layout/footer.php';
  }

  public function checkout()
  {
    $this->idiomas();
    $usuario = Utils::obtenerUsuario();
    $categorias = new Categorias();
    $categoriasConSubcategoriasYProductos = $categorias->obtenerCategoriasYProductos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $items = [];
      $totalAmount = 0;

      // Recorremos todos los índices de los productos que se han enviado en el carrito
      foreach ($_POST as $key => $value) {
        // Capturar detalles de los productos y cantidades
        if (strpos($key, 'item_name_') === 0) {
          $idx = substr($key, 10);  // Extraemos el índice del producto
          $itemName = $_POST["item_name_$idx"];
          $itemNumber = isset($_POST["item_number_$idx"]) ? $_POST["item_number_$idx"] : '';
          $quantity = isset($_POST["quantity_$idx"]) ? $_POST["quantity_$idx"] : 0;
          $price = isset($_POST["amount_$idx"]) ? $_POST["amount_$idx"] : 0;
          $shipping = isset($_POST["shipping_$idx"]) ? $_POST["shipping_$idx"] : 0;
          $shipping2 = isset($_POST["shipping2_$idx"]) ? $_POST["shipping2_$idx"] : 0;
          $discount = isset($_POST["discount_amount_$idx"]) ? $_POST["discount_amount_$idx"] : 0;

          // Almacenar cada artículo en el arreglo
          $items[] = [
            'name' => $itemName,
            'number' => $itemNumber,
            'quantity' => $quantity,
            'price' => $price,
            'shipping' => $shipping,
            'shipping2' => $shipping2,
            'discount' => $discount
          ];

          // Sumar el total
          $totalAmount += $price * $quantity;
        }
      }
    }
    require_once 'views/layout/head.php';
    require_once 'views/layout/header.php';
    require_once 'views/producto/checkout.php';
    require_once 'views/layout/footer.php';
  }


  public function moviles()
  {
    $probject = new Productos();
    $productos = $probject->movil();
    require 'views/producto/lista.php';
  }

  public function tvAudios()
  {
    $probject = new Productos();
    $productos = $probject->tvAudios();
    require 'views/producto/lista.php';
  }

  public function accesorios()
  {
    $probject = new Productos();
    $productos = $probject->accesorios();
    require 'views/producto/lista.php';
  }
}
