<?php
    include("head.php");
    include("seguridad.php");
    if($_SESSION["nivel"]==0)
    {
        include("../php/encabezado1.php");
    }
    if($_SESSION["nivel"]==1)
    {
        include("../php/encabezado2.php");
        
    }
?>
    <div class="seccion">
    <br>
    <form action="../php/carrito.php" method="POST" name="oculto" id="oculto">
    
        <button class="btn btn-primary centrado" id="botonCarrito" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
        VER CARRITO DE VENTAS
        </button>
    </form>
 
        <section class="container muestreo">

        </section>
       
        <div class="form-contact-loader centrado">
                <img src="../assets/grid.svg" alt="Cargando">
            </div> 
        <div class="form-contact-response none"> <p>datos enviados</p></div>
        <br><br>
       
    </div>  <?php
    include("footer.php");
?>
    <script src="../js/index.js" type="module"></script>
    <script src="../js/seleccionProductos.js"></script>
    <script src="../js/mandarAlCarrito.js"></script>
  