class App {

  onReady() {
    this.customApp();
  }

  mostrarCiudades() {
    function mostrarCodigoPaises() {
      $("#pais").change(function () {
        let pais = $("#pais").val();
        $.ajax({
          type: "POST",
          url: baseUrl + "ciudad/obtenerTodos",
          data: "pais=" + pais,
        })
          .done(function (response) {
            $("#ciudad").attr("disabled", false);
            $("#ciudad").html(response);
          })
      });
    }
    mostrarCodigoPaises();
  }

  avatarVistaPrevia() {

    function changeIndividual() {
      $('#avatar').on('change', function (event) {
        const file = event.target.files[0];
        const $preview = $('#avatarPreview');
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            $preview.attr('src', e.target.result).show();
          };
          reader.readAsDataURL(file);
        } else {
          $preview.attr('src', '').hide();
        }
      });
    }

    function changeMulti() {
      let imageFiles = [];

      $('#productImages').on('change', function (event) {
        const files = event.target.files;
        const $previewContainer = $('#imagePreview');
        $previewContainer.empty();

        imageFiles = [];

        // Mostrar todas las imágenes seleccionadas
        $.each(files, function (i, file) {
          const reader = new FileReader();

          reader.onload = function (e) {
            const $imgContainer = $('<div>').addClass('panel-admin__image-container');

            const $imgElement = $('<img>')
              .attr('src', e.target.result)
              .addClass('panel-admin__image-thumbnail');

            // Añadir archivo al arreglo de archivos para gestión posterior
            imageFiles.push(file);

            // Añadir la imagen, botones de editar y eliminar al contenedor
            $imgContainer.append($imgElement);
            $previewContainer.append($imgContainer);
          };

          reader.readAsDataURL(file);
        });
      });
    }
    changeIndividual();
    changeMulti();
  }

  mostrarPassword() {
    $('#togglePassword').on('click', function () {
      // Alternar el tipo de input entre 'password' y 'text'
      const input = $('#password');
      const type = input.attr('type') === 'password' ? 'text' : 'password';
      input.attr('type', type);

      // Cambiar el ícono según el estado
      $(this).html(type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>');
    });
  }

  autoHideAlert() {
    setTimeout(function () {
      $('.success-alert').alert('close')
    }, 1500);
  }

  select2() {
    $('#subcategoria').select2({
      placeholder: "Seleccione...",
      allowClear: true
    });
  }

  // Método customApp
  customApp() {
    this.avatarVistaPrevia();
    this.mostrarCiudades();
    this.mostrarPassword();
    this.autoHideAlert();
    this.select2();
  }

  // Iniciar aplicación
  init() {
    this.onReady();
  }
}

// Instanciamos e iniciamos
const app = new App();
app.init();