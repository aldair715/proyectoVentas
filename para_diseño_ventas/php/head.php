<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>-</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<aside class="panel">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <a href="#INICIO">INICIO</a>
        <button class="navbar-toggler" data-target="#menu" data-toggle="collapse" type="button">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ">
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    CARGO
                </a>
                    <div class="dropdown-menu">
                        <a href="indexCargo.php" class="dropdown-item">REGISTRAR CARGO</a>
                        <a href="mostrar.php?estado=2" class="dropdown-item">MOSTRAR CARGOS</a>
                    </div>
                
                </li>
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    CLIENTES
                </a>
                    <div class="dropdown-menu">
                        <a href="indexClientes.php" class="dropdown-item">REGISTRAR CLIENTE</a>
                        <a href="mostrar.php?estado=1" class="dropdown-item">MOSTRAR CLIENTES</a>
                    </div>
                
                </li> 
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    EMPLEADOS
                </a>
                    <div class="dropdown-menu">
                        <a href="indexEmpleados.php" class="dropdown-item">REGISTRAR EMPLEADO</a>
                        <a href="mostrar.php?estado=4" class="dropdown-item">MOSTRAR EMPLEADOS</a>
                    </div>
                
                </li> 
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    PRODUCTOS
                </a>
                    <div class="dropdown-menu">
                        <a href="indexProducto.php" class="dropdown-item">REGISTRAR PRODUCTOS</a>
                        <a href="mostrar.php?estado=5" class="dropdown-item">MOSTRAR PRODUCTOS</a>
                    </div>
                
                </li> 
                <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    PROVEEDORES
                </a>
                    <div class="dropdown-menu">
                        <a href="indexProveedores.php" class="dropdown-item">REGISTRAR PROVEEDORES</a>
                        <a href="mostrar.php?estado=3" class="dropdown-item">MOSTRAR PROVEEDORES</a>
                    </div>
                
                </li>  
            </ul>
         </div>  
    </nav>
</aside>