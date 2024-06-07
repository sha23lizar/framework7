
<script src="../js/sweetalert.min.js"></script>
  <script>
    const btnLogout = document.querySelector("#btn-logout");
    btnLogout.addEventListener("click", function(e) {
      const link = btnLogout.getAttribute("data-link");
      swal({
          title: "Estas seguro que desea cerrar la sesion?",
          text: "volvera a la pagina de inicio",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = link;
  
          } else {}
        });
      
    })
    // function confirmExit(link) {
    // }
  </script>