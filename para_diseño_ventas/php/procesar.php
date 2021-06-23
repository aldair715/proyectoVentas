<?php
//aldair pañuni rojas
    include("../db/conexion.php");
    $numero=$_GET["numero"];
    if($numero==1)
    {
        $razon=$_POST["razonSocial"];
        $nit=$_POST["nit"];
        $consulta=("INSERT into cliente(razonsocial,nit) values('$razon','$nit')");
        $res=mysqli_query($conexion,$consulta);
        header("Location:indexClientes.php");
    }
    if($numero==2)
    {
        $cargo=$_POST["cargo"];
        $consulta=("INSERT into cargo(cargo) values ('$cargo')");
        $res=mysqli_query($conexion,$consulta);
        header("Location:indexCargo.php");
    }
    if($numero==3)
    {
        if(isset($_FILES['logo']))
        {
            $empresa=$_POST["empresa"];
            $contacto=$_POST["contacto"];
            $email=$_POST["email"];
            $telefono=$_POST["telefono"];
            $direccion=$_POST["direccion"];
            $logo=$_FILES["logo"]["tmp_name"];
            $imagen=addslashes(file_get_contents($logo));
            
            $consulta=("INSERT into proveedor(empresa,contacto,email,telefono,direccion,logo) values('$empresa','$contacto','$email','$telefono','$direccion','$imagen')");
            $res=mysqli_query($conexion,$consulta);

            header("Location:indexProveedores.php");
        }

    }
    if($numero==4)
    {
        $idcargo=$_POST["cargo"];
        $cedula=$_POST["cedula"];
        $nombre=$_POST["nombre"];
        $paterno=$_POST["paterno"];
        $materno=$_POST["materno"];
        $celular=$_POST["celular"];
        $direccion=$_POST["direccion"];
        $fechaNacimiento=$_POST["date"];
        $genero=$_POST["genero"];
        $interes=$_POST["interes"];
      
        $consulta=("INSERT into empleado(id_cargo,ci,nombre,paterno,materno,direccion,telefono,fechanacimiento,genero,intereses) values ('$idcargo','$cedula','$nombre','$paterno','$materno','$direccion','$celular','$fechaNacimiento','$genero','$interes')");
        $res=mysqli_query($conexion,$consulta);
        
        header("Location:indexEmpleados.php");
    }
    if($numero==5)
    {
        $proveedor=$_POST["proveedor"];
        $nombre=$_POST["nombre"];
        $descripcion=$_POST["descripcion"];
        $compra=$_POST["compra"];
        $venta=$_POST["venta"];
        $stock=$_POST["stock"];
        $fecha=$_POST["date"];
        $consulta=("INSERT INTO producto(id_proveedor,nombreProducto,descripcion,costoCompra,costoVenta,stock,fecha) values ('$proveedor','$nombre','$descripcion','$compra','$venta','$stock','$fecha')" );
        $res=mysqli_query($conexion,$consulta);
        if($res)
        {
            echo "hola";
        }
       header("Location:indexProducto.php");
    }
    if($numero==6)
    {
        if($_POST)
        {
            $empleado=$_POST["empleado"];
            $usuario=$_POST["usuario"];
            $contraseña=$_POST["contraseña"];
            $contraseña1=$_POST["contraseña1"];
            if(strcmp($contraseña,$contraseña1)==0)
            {
                $nivel=$_POST["nivel"];
                $estado="ACTIVO";
                $contraseña=md5($contraseña);
                $consulta=("INSERT INTO usuario(id_empleado,usuario,pasword,nivel,estado) values ('$empleado','$usuario','$contraseña','$nivel','$estado')");
                $consultaParaMostrar=("SELECT * from usuario where id_empleado=$empleado");
                $res=mysqli_query($conexion,$consultaParaMostrar);
                if(mysqli_num_rows($res)!=0)
                {
                    echo "<script>
                    alert('usuario ya existe');
                    window.location.href='indexUsuario.php';</script>";
                }
                else{
                    $res=mysqli_query($conexion,$consulta);
                    header("Location:indexUsuario.php");
                }
                
            }
            else{
                echo "<script>
                alert('CONTRASEÑA NO COINCIDE');
                window.location.href='indexUsuario.php'</script>";
            }
        }
        
    }
    if($numero==7)
    {
        
        if(isset($_POST))
        {
            
            $i=$_POST["longitud"];
            $nit=$_POST["nit"];
            $razon=$_POST["razon"];
            $id_empleado=$_POST["id_empleado"];
            $id_venta="";
           
            $call=mysqli_prepare($conexion,"CALL insertarVenta($nit, $razon, $id_empleado,@res)");
            mysqli_stmt_execute($call);
            $select = mysqli_query($conexion, 'SELECT @res as idventa');
            $result = mysqli_fetch_assoc($select);
            $id_venta=$result["idventa"];
            mysqli_stmt_close($call);
            
        
            $id_producto;
            $cantidad=1;
            foreach ($_POST as $clave=>$valor)
            {       
                    if(substr_compare("$clave","id_producto_",0,10)==0)
                    {
                        $id_producto="";
                        $id_producto=$valor;
                    }
                    else if(substr_compare("$clave","cantidad",0,6)==0)
                    {

                        $consulta="";
                        $consulta=("CALL insertarProducto('$id_producto', '$valor', $id_venta)");
                        $select = mysqli_multi_query($conexion,$consulta);
                    
                    
                 }       
            }
               
                $vector=array();
                for($i=0;$i<1;$i++)
                {
                    $vector[]="exito";
                }
                echo json_encode($vector);
        }
        
        
        
    }
    if($numero==8)
    {
        if(isset($_POST))
        {

            $empresa=$_POST["empresa"];
            $id_empleado=$_POST["id_empleado"];
            $id_compra="";
           
            $call=mysqli_prepare($conexion,"CALL insertarCompra( $id_empleado,@res)");
            mysqli_stmt_execute($call);
            $select = mysqli_query($conexion, 'SELECT @res as idcompra');
            $result = mysqli_fetch_assoc($select);
            $id_compra=$result["idcompra"];
            mysqli_stmt_close($call);
            
        
            $id_producto;
            $cantidad=1;
            foreach ($_POST as $clave=>$valor)
            {       
                    if(substr_compare("$clave","id_producto_",0,10)==0)
                    {
                        $id_producto="";
                        $id_producto=$valor;
                    }
                    else if(substr_compare("$clave","cantidad",0,6)==0)
                    {

                        $consulta="";
                        $consulta=("CALL insertarProductoCompra('$id_producto', '$valor', $id_compra)");
                        $select = mysqli_multi_query($conexion,$consulta);
                    
                    
                 }       
            }
    
               
                $vector=array();
                for($i=0;$i<1;$i++)
                {
                    $vector[]="exito";
                }
                echo json_encode($vector);
        }
    }
    if($numero=="cargo")
    {
        $consulta=("SELECT * from cargo");
        $res=mysqli_query($conexion,$consulta);
        
        $vector=array();
        while($reg=mysqli_fetch_array($res))
        {
            $vector[]=$reg;
         
        }
        echo json_encode($vector);
        
        
    }
    if($numero=="proveedor")
    {
        $consulta=("SELECT id_proveedor,empresa from proveedor");
        $res=mysqli_query($conexion,$consulta);
       
        $vector=array();
        while($reg=mysqli_fetch_array($res))
        {
            $vector[]=$reg;
            
         
        }
        
        echo json_encode($vector);
    }
    if($numero=="empleado")
    {
        $consulta=("SELECT id_empleado,ci,paterno,materno,nombre from empleado");
        $res=mysqli_query($conexion,$consulta);
        $vector=array();
        while($reg=mysqli_fetch_array($res))
        {
            $vector[]=$reg;
        }
        echo json_encode($vector);
    }
    if($numero=="producto")
    {
        $consulta=("SELECT id_producto,nombreProducto,empresa,descripcion,costoVenta,costoCompra,stock from producto inner join proveedor on 
        producto.id_proveedor=proveedor.id_proveedor");
        $res=mysqli_query($conexion,$consulta);
        $vector=array();
        while($reg=mysqli_fetch_array($res))
        {
            $vector[]=$reg;
        }
        echo json_encode($vector);
    }
?>