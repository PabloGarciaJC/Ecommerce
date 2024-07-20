let mdFormularioActualizarCategoria = document.getElementById(
  "mdFormularioActualizarCategoria"
);

if (mdFormularioActualizarCategoria) {
  mdFormularioActualizarCategoria.addEventListener("submit", (e) => {
    e.preventDefault(); // Freno Submit o Envío;

    // Capturo el Valor de los Inputs MODAL
    let id = $("#idCategoria").val();
    let categoria = $("#editarCategoria").val();

    // Validacion
    if (categoria == null || categoria == "") {
      mostrarMensajeError("errorCategoria", "Ingrese Categoria");
    } else {
      mostrarMensajeError("errorCategoria", "");
    }

    // Funcion para Mostrar y Borrar los Mensajes:
    function mostrarMensajeError(claseInput, mensaje) {
      let elemento = document.querySelector(`.${claseInput}`);
      elemento.lastElementChild.innerHTML = mensaje;
    }

    // Categoria Ajax
    $.ajax({
      type: "POST",
      url: baseUrl + "Categoria/editar",
      data: "id=" + id + "&categoria=" + categoria,
    }).done(function (response) {
      $("#respuestaPhpEditarCategoria").html(response);
      if (response == 1) {
        Swal.fire({
          title: "Completado",
          icon: "success",
          timer: 500,
          showConfirmButton: false
        }).then(function () {
          window.location = baseUrl + "Categoria/gestionarCategorias";
        });
      }
    });
  });
}
