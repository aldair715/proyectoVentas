<?php
//aldair pañuni rojas
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
    include("../db/conexion.php");
    $mostrar=$_GET["estado"];
    $res;
    $link;
    switch($mostrar)
    {
        case 1:
             $consulta="SELECT * from cliente";
            $res=mysqli_query($conexion,$consulta);
            $link="indexClientes.php";
        break;
        case 2:
            $consulta="SELECT * FROM cargo";
            $res=mysqli_query($conexion,$consulta);
            $link="indexCargo.php";
        break;
        case 3:
            $consulta="SELECT * from proveedor";
            $res=mysqli_query($conexion,$consulta);
            $link="indexProveedores.php";
        break;
        case 4:
            $consulta="SELECT * from empleado inner join cargo on cargo.id_cargo=empleado.id_cargo";
            $res=mysqli_query($conexion,$consulta);
            $link="indexEmpleados.php";
        break;
        case 5:
            $consulta="SELECT * from producto inner join proveedor on proveedor.id_proveedor=producto.id_proveedor";
            $res=mysqli_query($conexion,$consulta);
            $link="indexProducto.php";
        break;
        case 6:
            $consulta="SELECT * from usuario inner join empleado on empleado.id_empleado=usuario.id_empleado 
            where usuario.estado='ACTIVO'";
            $res=mysqli_query($conexion,$consulta);
            $link="indexUsuario.php";
        break;
        case 7:
            $consulta="SELECT ven.id_venta as N, count(det.id_venta) as numero, cli.razonsocial as razon, concat(em.paterno,' ',em.materno,' ',em.nombre)
             as empleado, ven.fecha as fecha FROM venta as ven inner join detalle_venta as det on det.id_venta=ven.id_venta inner join cliente as cli on 
             cli.id_cliente=ven.id_cliente inner join empleado as em on ven.id_empleado=em.id_empleado group by ven.id_venta ";
            $res=mysqli_query($conexion,$consulta);
            $link="indexVenta.php";
        break;
        case 8:
            $consulta="SELECT comp.id_compra,concat(emp.paterno,' ',emp.materno,' ',emp.nombre) as nombre,count(det.id_compra)as contar,
            prove.empresa,comp.fecha from compra as comp inner join detalle_compra as det on det.id_compra=comp.id_compra inner join producto 
            as prod on prod.id_producto=det.id_producto inner join proveedor as prove on prove.id_proveedor=prod.id_proveedor inner join empleado 
            as emp on emp.id_empleado=comp.id_empleado group by comp.id_compra ";
            $res=mysqli_query($conexion,$consulta);
            $link="indexCompra.php";
        break;
       
    }
?>
<body>
  
    <?php
        echo "<input type='hidden' id='oculto' data-estado=$mostrar>";
    ?>
    <table class="main-table container">
        <thead>
            <?php
                switch($mostrar)
                {
                    case 1:
                        echo "<th>Nº</th>
                        <th>RAZON SOCIAL</th>
                        <th>NIT</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>";
                        
                    break;
                    case 2:
                        echo "<th>Nº</th>
                        <th>CARGO</th>
                        <th>ELIMINAR</th>
                        <th>EDITAR</th>";
                    break;
                    case 3:
                        echo "<th>Nº</th>
                        <th>EMPRESA</th>
                        <th>contacto</th>
                        <th>email</th>
                        <th>telefono</th>
                        <th>direccion</th>
                        <th>logo</th>
                        <th>ELIMINAR</th>
                        <th>EDITAR</th>
                        ";
                    break;
                    case 4:
                        echo "<tr>
                            <th>Nº</th>
                            <th>Cargo</th>
                            <th>CEDULA</th>
                            <th>NOMBRE</th>
                            <th>PATERNO</th>
                            <th>MATERNO</th>
                            <th>DIRECCION</th>
                            <th>TELEFONO</th>
                            <th>FECHA DE NACIMIENTO</th>
                            <th>GENERO</th>
                            <th>INTERESES</th>
                            <th>ELIMINAR</th>
                            <th>EDITAR</th>
                        </tr>";
                    break;
                    case 5:
                        echo "<tr>
                            <th>Nº</th>
                            <th>Empresa Proveedor</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Costo Compra</th>
                            <th>Costo Venta</th>
                            <th>Stock</th>
                            <th>fecha</th>
                            <th>ELIMINAR</th>
                            <th>EDITAR</th>
                          
                        </tr>";
                    break;
                    case 6:
                        echo "<tr>
                        <th>Nº</th>
                        <th>Usuario</th>
                        <th>Nivel</th>
                        <th>Estado</th>
                        <th>NOMBRE EMPLEADO</th>
                        <th>CI_EMPLEADO</th>
                        <th>ELIMINAR</th>
                        <th>EDITAR</th>
                       
                      
                    </tr>";
                    break;
                    case 7:
                        echo "<tr>
                        <th>Nº</th>
                        <th>Nº VENTA</th>
                        <th>NUMERO DE PRODUCTOS VENDIDOS</th>
                        <th>CLIENTE</th>
                        <th>FECHA DE VENTA</TH>
                        <th>FECHA</th>
                        <th>ELIMINAR</th>
                        <th>EDITAR</th>
                      
                    </tr>";
                    break;
                    case 8:
                        echo "<tr>
                        <th>Nº</th>
                        <th>Nº COMPRA</th>
                        <th>NUMERO DE PRODUCTOS VENDIDOS</th>
                        <th>PROVEEDOR</th>
                        <th>FECHA DE VENTA</TH>
                        <th>EMPLEADO</th>
                        <th>ELIMINAR</th>
                        <th>EDITAR</th>
                      
                    </tr>";
                    break;
                }
            ?>
            
        </thead>
        <tbody>
            <?php
            switch($mostrar)
            {
                case 1:
                   $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                    echo "<tr>
                    <td>".$i."</td>
                    <td>".$reg["razonsocial"]."</td>
                    <td>".$reg["nit"]."</td>
                    <td><button class='edit' data-id=".$reg["id_cliente"]." >EDITAR</button></td>
                    <td><button class='delete' data-id=".$reg["id_cliente"].">ELIMINAR</button></td></tr>";
                    $i=$i+1;
                    } 
                break;
                case 2:
                    $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                        echo "<tr>
                        <td>".$i."</td>
                        <td>".$reg["cargo"]."</td>
                        <td><button class='edit' data-id=".$reg["id_cargo"].">EDITAR</button></td>
                        <td><button class='delete' data-id=".$reg["id_cargo"].">ELIMINAR</button></td></tr>
                        </tr>";
                        $i++;
                    }
                break;
                case 3:
                    $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                    echo "<tr>
                    <td>".$i."</td>
                    <td>".$reg["empresa"]."</td>
                    <td>".$reg["contacto"]."</td>
                    <td>".$reg["email"]."</td>
                    <td>".$reg["telefono"]."</td>
                    <td>".$reg["direccion"]."</td>
                    
                    <td><img width='200px' height='200px' src='data:image/jpg;base64,".base64_encode($reg["logo"])."'></td>
                    <td><button class='delete' data-id=".$reg["id_proveedor"].">ELIMINAR</button></td> 
                    <td><button class='edit' data-id=".$reg["id_proveedor"].">EDITAR</button></td>   
                    </tr>";
                    $i=$i+1;
                    } 
                break;
                case 4:
                    $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                    echo "<tr>
                    <td>".$i."</td>
                    <td>".$reg["cargo"]."
                    <td>".$reg["ci"]."</td>
                    <td>".$reg["nombre"]."</td>
                    <td>".$reg["paterno"]."</td>
                    <td>".$reg["materno"]."</td>
                    <td>".$reg["direccion"]."</td>
                    <td>".$reg["telefono"]."</td>
                    <td>".$reg["fechanacimiento"]."</td>
                    <td>".$reg["genero"]."</td>
                    <td>".$reg["intereses"]."</td>
                    <td><button class='delete' data-id=".$reg["id_empleado"].">ELIMINAR</button></td>
                    <td><button class='edit' data-id=".$reg["id_empleado"].">EDITAR</button></td></tr>
                    </tr>
                    ";
                    $i=$i+1;
                    } 
                break;
                case 5:
                    $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                    echo "<tr>
                    <td>".$i."</td>
                    <td>".$reg["empresa"]."</td>
                    <td>".$reg["nombreProducto"]."</td>
                    <td>".$reg["descripcion"]."</td>
                    <td>".$reg["costoCompra"]."</td>
                    <td>".$reg["costoVenta"]."</td>
                    <td>".$reg["stock"]."</td>
                    <td>".$reg["fecha"]."</td>
                    <td><button class='delete' data-id=".$reg["id_producto"].">ELIMINAR</button></td>
                    <td><button class='edit' data-id=".$reg["id_producto"].">EDITAR</button></td></tr>
                    ";
                    $i=$i+1;
                    } 
                break;
                case 6:
                    $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                        $nombreCompleto=$reg["paterno"]." ".$reg["materno"]." ".$reg["nombre"];
                        echo "<tr>
                        <td>".$i."</td>
                        <td>".$reg["usuario"]."</td>
                        <td>".$reg["nivel"]."</td>
                        <td>".$reg["estado"]."</td>
                        <td>".$nombreCompleto."</td>
                        <td>".$reg["ci"]."</td>
                        <td><button class='delete' data-id=".$reg["id_usuario"].">ELIMINAR</button></td>
                        <td><button class='edit' data-id=".$reg["id_usuario"].">EDITAR</button></td></tr>
                    
                        
                        </tr>";
                    $i=$i+1;
                    } 
                break;
                case 7:
                    $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                
                        echo "<tr>
                        <td>$i</td>
                        <td>".$reg["N"]."</td>
                        <td>".$reg["numero"]."</td>
                        <td>".$reg["razon"]."</td>
                        <td>".$reg["empresa"]."</td>
                        <td>".$reg["fecha"]."</td>
                        <td><button class='delete' data-id=".$reg["N"].">ELIMINAR</button></td>
                        <td><button class='edit' data-id=".$reg["N"].">EDITAR</button></td></tr>
                        </tr>"; 
                    $i=$i+1;
                    }
                break;
                case 8:
                    $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                
                        echo "<tr>
                        <td>$i</td>
                        <td>".$reg["id_compra"]."</td>
                        <td>".$reg["contar"]."</td>
                        <td>".$reg["empresa"]."</td>
            
                        <td>".$reg["fecha"]."</td>
                        <td>".$reg["nombre"]."</td>
                        <td><button class='delete' data-id=".$reg["N"].">ELIMINAR</button></td>
                        <td><button class='edit' data-id=".$reg["N"].">EDITAR</button></td></tr>
                        </tr>"; 
                    $i=$i+1;
                    }
                break;
           
        }
            
            ?>
        </tbody>
    </table>
    <?php
    include("footer.php");
?>
    <script src="../js/eliminaryEdita.js">

    </script>
