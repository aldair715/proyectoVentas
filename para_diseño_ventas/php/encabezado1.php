<aside class="panel">
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
<br>
<?php
            include("seguridad.php");
            echo "<br><h1 class=' text-light'>".$_SESSION["usuario"]."</h1>";
            echo "<a class='boton-personalizado' href='salir.php'>SALIR</a>";
        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ">
               
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    CLIENTES
                </a>
                    <div class="dropdown-menu">
                        <a href="indexClientes.php" class="dropdown-item">REGISTRAR CLIENTE</a>
                        <a href="mostrar.php?estado=1" class="dropdown-item">MOSTRAR CLIENTES</a>
                        <a href="./busqueda.php?nbusqueda=1" class="dropdown-item">BUSCAR CLIENTES</a>
                        <a href="./reportes/realizarReporte.php?nFormulario=clientes" class="dropdown-item">REPORTE DE CLIENTES</a>
                    </div>
                
                </li> 
                
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    PRODUCTOS
                </a>
                    <div class="dropdown-menu">
                        <a href="indexProducto.php" class="dropdown-item">REGISTRAR PRODUCTOS</a>
                        <a href="mostrar.php?estado=5" class="dropdown-item">MOSTRAR PRODUCTOS</a>
                        <a href="./busqueda.php?nbusqueda=5" class="dropdown-item">BUSCAR PRODUCTOS</a>
                        <a href="./reportes/realizarReporte.php?nFormulario=productos" class="dropdown-item">REPORTE DE PRODUCTOS</a>
                    </div>
                
                </li> 
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    PROVEEDORES
                </a>
                    <div class="dropdown-menu">
                        <a href="indexProveedores.php" class="dropdown-item">REGISTRAR PROVEEDORES</a>
                        <a href="mostrar.php?estado=3" class="dropdown-item">MOSTRAR PROVEEDORES</a>
                        <a href="./busqueda.php?nbusqueda=3" class="dropdown-item">BUSCAR PROVEEDORES</a>
                        <a href="./reportes/realizarReporte.php?nFormulario=proveedores" class="dropdown-item">REPORTE DE PROVEEDORES</a>
                    </div>
                
                </li>  
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    VENTAS
                </a>
                    <div class="dropdown-menu">
                        <a href="indexVentas.php" class="dropdown-item">REGISTRAR VENTA</a>
                        <a href="mostrar.php?estado=7" class="dropdown-item">MOSTRAR VENTA</a>
                        <a href="./busqueda.php?nbusqueda=7" class="dropdown-item">BUSCAR VENTAS</a>
                        <a href="./reportes/realizarReporte.php?nFormulario=ventas" class="dropdown-item">REPORTE DE VENTA</a>
                    </div>
                
                </li>
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    COMPRAS
                </a>
                    <div class="dropdown-menu">
                        <a href="indexCompra.php" class="dropdown-item">REGISTRAR COMPRA</a>
                        <a href="mostrar.php?estado=8" class="dropdown-item">MOSTRAR COMPRA</a>
                        <a href="./busqueda.php?nbusqueda=8" class="dropdown-item">BUSCAR COMPRA</a>
                        <a href="./reportes/realizarReporte.php?nFormulario=compras" class="dropdown-item">REPORTE DE COMPRAS</a>
                    </div>
                
                </li> 
            </ul>
        </div>  
    </nav>

</aside>