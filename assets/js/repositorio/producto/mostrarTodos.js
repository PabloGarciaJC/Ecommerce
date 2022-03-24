
// Obtengo los Checked Selecionados 
let checkedMarca = document.querySelectorAll('.checkedMarca');
let checkedboxMemoriaRam = document.querySelectorAll('.checkedMemoriaRam');
let checkedPrecio = document.querySelectorAll('.checkedPrecio');
let checkedOfertas = document.querySelectorAll('.checkedOfertas');

// Obtengo Valor de Buscador 
var buscadorMostrarProducto = document.getElementById('buscadorMostrarProducto');

// Capturo Valores del Buscador a tiempo real y repueblo el otro Buscador
if (buscadorMostrarProducto) {
  buscadorMostrarProducto.addEventListener('keyup', (event) => {
    valorBuscador = event.path[0].value;
    $('#buscadorGlobal').val(valorBuscador);
  });
}
// Obtengo IdCategoria
let productoIdCategoriaMarca = $('#productoIdCategoria').val();

// Array Checkbox
let arrayCheckMarca = [];
let arrayCheckMemoriaRam = [];
let arrayCheckedPrecio = [];
let arrayCheckedOfertas = [];
let valorBuscador = '';

if (buscadorMostrarProducto) {

  /******************* Primero en Cargar  *************/
  //Ajax 
  ajaxMostrarProductos(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio, arrayCheckedOfertas, valorBuscador);


  /****************** Obtener Tiempo Real Datos Buscador *************/
  buscadorMostrarProducto.addEventListener('keyup', (event) => {
    valorBuscador = event.path[0].value;
    ajaxMostrarProductos(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio, arrayCheckedOfertas, valorBuscador);
    //Invocar al ajax y pasar un nuevo parametro con buscador y mandarlo a php
  });

  /****************** Ajax Filtro Sidebar ***************************/

  // Checkedbox => Marca Selecionados
  for (var checkedTodosMarca of checkedMarca) {
    checkedTodosMarca.addEventListener('click', function () {

      if (this.checked) {
        // implemento valores al array
        arrayCheckMarca.push(this.value);
      } else {
        //Remuevo valores array
        arrayCheckMarca = arrayCheckMarca.filter(e => e !== this.value);
      }
      //Ajax 
      ajaxMostrarProductos(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio, arrayCheckedOfertas, valorBuscador);
    }); //Fin del click
  }//Fin del for

  // Checkedbox => Memoria Ram Selecionados
  for (var checkedboxTodosMemoriaRam of checkedboxMemoriaRam) {
    checkedboxTodosMemoriaRam.addEventListener('click', function () {

      if (this.checked) {
        // implemento valores al array
        arrayCheckMemoriaRam.push(this.value);
      } else {
        //Remuevo valores array
        arrayCheckMemoriaRam = arrayCheckMemoriaRam.filter(e => e !== this.value);
      }
      //Ajax 
      ajaxMostrarProductos(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio, arrayCheckedOfertas, valorBuscador);
    }); //Fin del click
  }//Fin del for

  // Checkedbox => Precio Selecionados
  for (var checkedTodosPrecio of checkedPrecio) {
    checkedTodosPrecio.addEventListener('click', function () {

      if (this.checked) {
        // implemento valores al array
        arrayCheckedPrecio.push(this.value);
      } else {
        //Remuevo valores array
        arrayCheckedPrecio = arrayCheckedPrecio.filter(e => e !== this.value);
      }
      //Ajax 
      ajaxMostrarProductos(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio, arrayCheckedOfertas, valorBuscador);
    }); //Fin del click
  }//Fin del for


  // Checkedbox => Ofertas Selecionados
  for (var checkedTodosOfertas of checkedOfertas) {
    checkedTodosOfertas.addEventListener('click', function () {

      if (this.checked) {
        // implemento valores al array
        arrayCheckedOfertas.push(this.value);
      } else {
        //Remuevo valores array
        arrayCheckedOfertas = arrayCheckedOfertas.filter(e => e !== this.value);
      }
      //Ajax 
      ajaxMostrarProductos(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio, arrayCheckedOfertas, valorBuscador);
    }); //Fin del click
  }//Fin del for


  // Function  Ajax
  function ajaxMostrarProductos(arrayCheckMarca, productoIdCategoriaMarca, arrayCheckMemoriaRam, arrayCheckedPrecio, arrayCheckedOfertas, valorBuscador) {

    $.ajax({
      type: 'POST',
      url: baseUrl + 'Producto/mostrarTodos',
      data: { arrayMarca: JSON.stringify(arrayCheckMarca), productoByIdCategoria: productoIdCategoriaMarca, arrayMemoriaRam: JSON.stringify(arrayCheckMemoriaRam), arrayPrecio: JSON.stringify(arrayCheckedPrecio), arrayOfertas: JSON.stringify(arrayCheckedOfertas), buscadorProducto: valorBuscador },
    })
      .done(function (respuestaPhpMostrarProductos) {
        $("#respuestaPhpMostrarProductos").html(respuestaPhpMostrarProductos);
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("completo");
      });
  } // Fin Funcion Ajax

}


