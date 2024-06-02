<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD con PHP,PDO,Ajax,Datatable</title>
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./bootstrap/icon/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="./DataTables/datatables.css" />
  <link rel="stylesheet" href="./css/styles.css" />
</head>

<style>

.botones{
  display: flex;
  width: 100%;
  gap: 10px;
  padding: auto;
  margin: auto;
  justify-content: space-between;
  text-transform: uppercase;
  font-weight: bold;
}

#buttom {
  width:auto!important;
  font-size: 12px !important;
  border: transparent;
}

th {
  color: #495057 !important;
}

.btn-xs {
  justify-content: center;
  width: auto;
  display: flex;
  margin: auto;
}
</style>
<body>

  <div class="container fondo">
    <div class="row">
      <div class="botones offset-10">
        <div class="botones">
          <!-- Button trigger modal -->
          <button type="button" id="buttom" class="btn btn-primary w-100" style="background-color: #3f6ad8F3;" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
            <i class="bi bi-plus-circle-fill"></i> NUEVO PROVEEDOR
          </button>

          LISTADO 

          <button type="button" id="buttom" class="btn btn-primary w-100" data-bs-toggle="modal" style="background-color: #3ac47d;" data-bs-target="#modalEmpresa">
            <i class="bi bi-plus-circle-fill"></i> GENERAR EXEL
          </button>
        </div>
      </div>
    </div>
    <hr>
    <div class="table-responsive">
      <table id="datos-empresas" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>id</th>
            <th>Rif</th>
            <th>Razon social</th>
            <th>Direccion</th>
            <thSeudonimo</th>
            <th>editar</th>
            <th>borrar</th>
          </tr>
        </thead>

      </table>
    </div>

  </div>






  <!-- Modal Agregar -->
  <div class="modal fade" id="modalEmpresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="form-empresa" action="codigodeconexion.php" enctype="multipart/form-data">
          <div class="moda-content">
            <div class="modal-body">
              <label for="Rif">Ingrese el Rif</label>
              <input type="text" class="form-control" placeholder="J-" name="Rif" id="Rif">
              <br />

              <label for="Razonsocial">Ingrese la Razon social</label>
              <input type="text" class="form-control" name="Razonsocial" id="Razonsocial">
              <br />

              <label for="Direccion">Ingrese su Direccion</label>
              <input type="text" class="form-control" name="Direccion" id="Direccion">
              <br />

              <!-- 
              <label for="Seudonimo">Ingrese el Seudonimo</label>
              <input type="text" class="form-control" name="Seudonimo" id="Seudonimo">
              <br />

              
              <label for="image">Ingrese su image</label>
              <input type="file" class="form-control" name="imagen_empresa" id="image-empresa">
              <span id="imagen_subida"></span>
              <br />
              -->

            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id_empresa" id="id_empresa">
            <input type="hidden" name="operacion" id="operacion" value="crear">
            <input type="submit" name="action" id="action" class="btn btn-success" value="crear">
          </div>
        </form>
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>







  <!-- JQuery (Tiene que estar antes que datatables por que esta la necesita) -->
  <script src="./js/jquery-3.7.1.min.js"></script>
  <!-- datatables -->
  <script src="./DataTables/datatables.js"></script>
  <!-- Bootstrap JS -->
  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="almacenacientoJSON.js"></script>

  <!-- Script -->

  <script type="text/javascript">
    $(document).ready(function() {
      var dataTable = $("#datos-empresas").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
          url: "obtener_registros.php",
          type: "POST"
        },
        "columnsDefs": [{
          "targets": [0, 3, 4],
          "orderable": false,
        }, ],
        "language": {
          "decimal": "",
          "emptyTable": "No hay datos disponibles en la tabla",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
          }
          
        }
      });


      /*
      $(document).on("submit", "#form-empresa", function(e) {
        e.preventDefault();
        var Rif = $("#Rif").val();
        var Razonsocial = $("#Razonsocial").val();
        var Direccion = $("#Direccion").val();
        var Seudonimo = $("#Seudonimo").val();
        var extencion = $("#image-empresa").val().split('.').pop().toLowerCase();
        if (extencion != "") {
          if ($.inArray(extencion, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert('El archivo seleccionado no es una imagen');
            $("#image-empresa").val("");
            return false;
          }
          if (Rif != '' && Razonsocial != '' && Direccion != '' && Seudonimo != '') {
            $.ajax({
              url: "crear.php",
              method: "POST",
              data: new FormData(this),
              contentType: false,
              processData: false,
              success: function(data) {
                alert(data);
                $("#form-empresa")[0].reset();
                $("#modalEmpresa").modal('hide');
                dataTable.ajax.reload();
              }
            });
          } else {
            alert('Todos los campos son requeridos');
          }
        }
      })
      */

    $(document).on("submit", "#form-empresa", function(e) {
    e.preventDefault();
    var Rif = $("#Rif").val();
    var Razonsocial = $("#Razonsocial").val();
    var Direccion = $("#Direccion").val();
    var seudonimo = $("#seudonimo").val();
    
    if (Rif != '' && Razonsocial != '' && Direccion != '' && seudonimo != '') {
        $.ajax({
            url: "crear.php",
            method: "POST",
            data: {
                Rif: Rif,
                Razonsocial: Razonsocial,
                Direccion: Direccion,
                seudonimo: seudonimo,
                operacion: $("#operacion").val(),
                id_empresa: $("#id_empresa").val()
            },
            success: function(data) {
                alert(data);
                $("#form-empresa")[0].reset();
                $("#modalEmpresa").modal('hide');
                dataTable.ajax.reload();
            }
        });
    } else {
        alert('Todos los campos son requeridos');
       }
    });

    
      /* Funcionalidad editar
      $(document).on("click", ".editar", function(e) {
        var id_empresa = e.target.id;
        $.ajax({
          url: "obtener_registro.php",
          method: "POST",
          data: {
            id_empresa: id_empresa
          },
          dataType: "json",
          success: function(data) {
            $("#modalEmpresa").modal("show");
            $("#Rif").val(data.Rif);
            $("#Razonsocial").val(data.Razonsocial);
            $("#Direccion").val(data.Direccion);
            $("#Seudonimo").val(data.Seudonimo);
            
            $("#imagen_subida").html(data.imagen_empresa);
            
            $("#id_empresa").val(id_empresa);
            $("#action").val("editar");
            $("#operacion").val("editar");
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        })
      })
      */

      // Funcionalidad editar
$(document).on("click", ".editar", function(e) {
    var id_empresa = e.target.id;
    $.ajax({
        url: "obtener_registro.php",
        method: "POST",
        data: {
            id_empresa: id_empresa
        },
        dataType: "json",
        success: function(data) {
            $("#modalEmpresa").modal("show");
            $("#Rif").val(data.Rif);
            $("#Razonsocial").val(data.Razonsocial);
            $("#Direccion").val(data.Direccion);
            $("#seudonimo").val(data.seudonimo);
            $("#id_empresa").val(id_empresa); // Asegúrate de que el ID se esté enviando
            $("#action").val("editar");
            $("#operacion").val("editar");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    })
})

      // Funcionalidad Borrar
      $(document).on("click", ".borrar", function(e) {
        var id_empresa = e.target.id;
        if (confirm("¿Desea borrar el registro nro: "+ id_empresa+"?")) {
          $.ajax({
            url: "borrar.php",
            method: "POST",
            data: {
              id_empresa: id_empresa
            },
            success: function(data) {
              alert(data);
              dataTable.ajax.reload();
            }
          })
        }
      })


      // Final scritp
    })
  </script>

</body>

</html>