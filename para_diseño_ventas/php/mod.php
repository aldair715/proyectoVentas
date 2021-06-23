<?php
    require("../db/conexion.php");
    if(isset($_POST))
    {
        $formularioN=$_GET["numeroFormulario"];
        switch($formularioN)
        {
            case 1:

                //para el registro del cliente
                $razon_social=$_POST["razonSocial"];
                $nit=$_POST["nit"];
                $id=$_POST["id"];
          
                $consulta="UPDATE cliente set `razonsocial`='$razon_social',`nit`=$nit where id_cliente=$id ";
                $res=mysqli_query($conexion,$consulta);
                header("Location:mostrar.php?estado=1");
            break;
            case 2:
                //para la modificacion del cargo
                $cargo=$_POST["cargo"];
                $id=$_POST["id"];
                $consulta="UPDATE cargo set `cargo`='$cargo' where id_cargo=$id";
                $res=mysqli_query($conexion,$consulta);
                header("Location:mostrar.php?estado=2");
            break;
            case 3:
                //para la modificacion del proveedor
                $empresa=$_POST["empresa"];
                $contacto=$_POST["contacto"];
                $email=$_POST["email"];
                $telefono=$_POST["telefono"];
                $direccion=$_POST["direccion"];
                $id=$_POST["id"];
                if(!empty($_FILES["logito"]["tmp_name"]))
                {
                   
                    $logo=$_FILES["logito"]["tmp_name"];
                    $imagen=addslashes(file_get_contents($logo));
                    $res=mysqli_query($conexion, "UPDATE proveedor set logo='$imagen' where id_proveedor=$id");
                    
                }
                $consulta="UPDATE  proveedor SET empresa='$empresa',contacto='$contacto',email='$email',telefono=
                $telefono,direccion='$direccion' WHERE id_proveedor=$id";
                $res=mysqli_query($conexion,$consulta);
            
                header("Location:mostrar.php?estado=3");
            break;
            case 4:
                //para lo modificacion del empleado
                if(isset($_POST))
                {
                    $cargo=$_POST["cargo"];
                    $cedula=$_POST["cedula"];
                    $nombre=$_POST["nombre"];
                    $paterno=$_POST["paterno"];
                    $materno=$_POST["materno"];
                    $direccion=$_POST["direccion"];
                    $telefono=$_POST["celular"];
                    $fechanacimiento=$_POST["date"];
                    $genero=$_POST["genero"];
                    $intereses=$_POST["interes"];
                    $id=$_POST["id"];
                    $consulta="UPDATE empleado set id_cargo=$cargo,ci=$cedula,nombre='$nombre',paterno='$paterno',materno='$materno',direccion='$direccion',telefono=$telefono
                    ,fechanacimiento='$fechanacimiento',genero='$genero',intereses='$intereses' where id_empleado=$id";
                    $res=mysqli_query($conexion,$consulta);
                    header("Location:mostrar.php?estado=4");
                }
                

            break;
            case 5:
                //para la modificacion del producto
                if(isset($_POST))
                {
                    $proveedor=$_POST["proveedor"];
                    $nombreProducto=$_POST["nombre"];
                    $descripcion=$_POST["descripcion"];
                    $costoCompra=$_POST["compra"];
                    $costoVenta=$_POST["venta"];
                    $stock=$_POST["stock"];
                    $fecha=$_POST["date"];
                    $id=$_POST["id"];
                    $consulta="UPDATE producto set id_proveedor='$proveedor',nombreProducto='$nombreProducto',descripcion='$descripcion',costoCompra=$costoCompra,
                    costoVenta=$costoVenta,stock=$stock,fecha='$fecha' where id_producto=$id";
                    $res=mysqli_query($conexion,$consulta);
                    
                    header("Location:mostrar.php?estado=5");
                }
            break;
            case  6:
                if($_POST)
                {
                    $usuario=$_POST["usuario"];
                    $contraseña=$_POST["contraseña"];
                    $contraseña1=$_POST["contraseña1"];
                    if(strcmp($contraseña,$contraseña1)==0)
                    {
                        $nivel=$_POST["nivel"];
                        $estado="ACTIVO";
                        $contraseña=md5($contraseña);
                        $id=$_POST["id"];
                        $consulta=("UPDATE usuario set usuario='$usuario',pasword='$contraseña',nivel='$nivel' where id_usuario=$id");
                        $consultaParaMostrar=("SELECT * from usuario where usuario='$usuario'");
    

                            $res=mysqli_query($conexion,$consulta);
                            header("Location:indexUsuario.php");
                       
                        
                    }
                    else{
                        echo "<script>
                        alert('CONTRASEÑA NO COINCIDE');
                        window.location.href='indexUsuario.php'</script>";
                    }
                }
            break;
             default:
            break;
        }
    }
?>