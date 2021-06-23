<?php
    include("../php/head.php");
    include("../php/seguridad.php");
    
    if($_SESSION["nivel"]==0)
    {
        include("../php/encabezado1.php");
    }
    if($_SESSION["nivel"]==1)
    {
        include("../php/encabezado2.php");
        
    }
    $nFormulario=$_POST["nFormulario"];
    $texto=$_POST["texto"];
   
    require("../db/conexion.php");
    switch($nFormulario)
    {
        case 1:
            $consulta="SELECT * from cliente where razonsocial like '$texto%'  ";
            
        break;
        case 2:
            $consulta="SELECT * FROM cargo where cargo like '$texto%'";
           
        break;
        case 3:
            $consulta="SELECT * from proveedor where empresa like '$texto%' ";
           
        break;
        case 4:
            $consulta="SELECT * from empleado inner join cargo on cargo.id_cargo=empleado.id_cargo where concat(paterno,' ',materno,' ',nombre) like '$texto%'";
        break;
        case 5:
            $consulta="SELECT * from producto inner join proveedor on proveedor.id_proveedor=producto.id_proveedor where nombreProducto like '$texto%' ";
          
        break;
        case 6:
            $consulta="SELECT * from usuario inner join empleado on empleado.id_empleado=usuario.id_empleado 
            where usuario.usuario like '$texto%'";
        break;
        case 7:
            $consulta="SELECT ven.id_venta as N, det.cantidad ,det.costo,prod.nombreProducto, cli.razonsocial as razon, concat(em.paterno,' ',em.materno,' ',em.nombre)
            as empleado, ven.fecha as fecha FROM venta as ven inner join detalle_venta as det on det.id_venta=ven.id_venta inner join producto as prod on det.id_producto=prod.id_producto inner join cliente as cli on 
            cli.id_cliente=ven.id_cliente inner join empleado as em on ven.id_empleado=em.id_empleado where ven.id_venta like '$texto%'";
        break;
        case 8:
            $consulta="SELECT comp.id_compra,prod.nombreProducto,concat(emp.paterno,' ',emp.materno,' ',emp.nombre) 
            as nombre,det.cantidadCompra,det.costoCompra, prove.empresa,comp.fecha from compra as comp inner join 
            detalle_compra as det on det.id_compra=comp.id_compra inner join producto as prod on prod.id_producto=det.id_producto 
            inner join proveedor as prove on prove.id_proveedor=prod.id_proveedor inner join empleado as emp on 
            emp.id_empleado=comp.id_empleado where comp.id_compra like '$texto%'  ";
        break;

    }
    $res=mysqli_query($conexion,$consulta);
?>
<body>
    <table class="main-table">
            <thead>
                <?php
                    switch($nFormulario)
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
                            <th>ID VENTA</th>
                            <th>NOMBRE DEL PRODUCTO VENDIDO</th>
                            <th>CANTIDAD</th>
                            <th>COSTO</th>
                            <th>EMPLEADO</th>
                            <th>RAZON SOCIAL DEL CLIENTE</th>
                            <th>FECHA</th>
                           
                          
                        </tr>";
                        break;
                        case 7:
                                echo "<tr>
                                <th>Nº</th>
                                <th>ID VENTA</th>
                                <th>NOMBRE DEL PRODUCTO VENDIDO</th>
                                <th>CANTIDAD</th>
                                <th>COSTO</th> 
                                <th>RAZON SOCIAL DEL CLIENTE</th>
                                <th>EMPLEADO</th>
                               
                                <th>FECHA</th>
                                <th>ELIMINAR</th>
                                <th>EDITAR</th>
                              
                            </tr>";
                        break;
                        case 8:
                            echo "<tr>
                                <th>Nº</th>
                                <th>ID COMPRA</th>
                                <th>NOMBRE DEL PRODUCTO COMPRADO</th>
                                <th>CANTIDAD</th>
                                <th>COSTO</th> 
                                <th>PROVEEDOR</th>
                                <th>EMPLEADO</th>
                               
                                <th>FECHA</th>
                                <th>ELIMINAR</th>
                                <th>EDITAR</th>
                              
                            </tr>";
                        break;
                        default:
                        break;
                    }
                ?>
            </thead>
            <tbody>
                <?php
                switch($nFormulario)
                {
                    case 1:
                    $i=1;
                        if(mysqli_num_rows($res)!=0)
                        {
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
                        }
                        else
                        {
                            echo "<tr >
                                NO HAY REGISTROS CON SU BUSQUEDA
                                </tr>";
                        } 
                    break;
                    case 2:
                        $i=1;
                        if(mysqli_num_rows($res)!=0)
                        {
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
                        }
                        else{
                            echo "<tr >
                                NO HAY REGISTROS CON SU BUSQUEDA
                                </tr>";
                        }
                    break;
                    case 3:
                        $i=1;
                        if(mysqli_num_rows($res)!=0)
                        {
                            echo "hoa";
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
                        }
                        else{
                            echo "<tr >
                                NO HAY REGISTROS CON SU BUSQUEDA
                                </tr>";
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
                    
                        
                        <tr>";
                        $i=$i+1;
                        } 
                    break;
                    case 7:
                        $i=1;
                        while($reg=mysqli_fetch_array($res))
                        {
                        echo "<tr>
                        <td>".$i."</td>
                        <td>".$reg["N"]."</td>
                        <td>".$reg["nombreProducto"]."</td>
                        <td>".$reg["cantidad"]."</td>
                        <td>".$reg["costo"]."</td>
                        <td>".$reg["razon"]."</td>
                        <td>".$reg["empleado"]."</td>
                        <td>".$reg["fecha"]."</td>
                        <td><button class='delete' data-id=".$reg["id_usuario"].">ELIMINAR</button></td>
                        <td><button class='edit' data-id=".$reg["id_usuario"].">EDITAR</button></td></tr>
                    
                        
                        <tr>";
                        $i=$i+1;
                        } 
                    break;
                    case 8:
                        $i=1;
                        while($reg=mysqli_fetch_array($res))
                        {
                        echo "<tr>
                        <td>".$i."</td>
                        <td>".$reg["id_compra"]."</td>
                        <td>".$reg["nombreProducto"]."</td>
                        <td>".$reg["cantidadCompra"]."</td>
                        <td>".$reg["costoCompra"]."</td>
                        <td>".$reg["empresa"]."</td>
                        <td>".$reg["nombre"]."</td>
                        <td>".$reg["fecha"]."</td>
                        <td><button class='delete' data-id=".$reg["id_usuario"].">ELIMINAR</button></td>
                        <td><button class='edit' data-id=".$reg["id_usuario"].">EDITAR</button></td></tr>
                    
                        
                        <tr>";
                        $i=$i+1;
                        } 
                    break;
                }
                
                ?>
            </tbody>
    </table>
</body>