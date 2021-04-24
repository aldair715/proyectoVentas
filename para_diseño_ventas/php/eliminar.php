<?php
    include("head.php");
    include("../db/conexion.php");
    $_estado=$_GET["elim"];
    $_id=$_GET["id"];
    
    $res;
    switch($_estado)
    {
        case 1:
            $consulta="DELETE FROM cliente where id_cliente='$_id'";
            $res=mysqli_query($conexion,$consulta);
        break;
        case 2:
            $consulta="DELETE FROM cargo where id_cargo='$_id'";
            $res=mysqli_query($conexion,$consulta);
        break;
        case 3:
            $consulta="DELETE FROM proveedor where id_proveedor='$_id'";
            $res=mysqli_query($conexion,$consulta);
        break;
        case 4:
            $consulta="DELETE FROM empleado where id_empleado='$_id'";
            $res=mysqli_query($conexion,$consulta);
        break;
        case 5:
            $consulta="DELETE FROM producto where id_producto='$_id'";
            $res=mysqli_query($conexion,$consulta);
        break;
    }
?>