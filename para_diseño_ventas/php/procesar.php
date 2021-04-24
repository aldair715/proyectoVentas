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
        $empleado=$_POST["empleado"];
        $usuario=$_POST["usuario"];
        $contraseña=$_POST["contraseña"];
        $nivel=$_POST["nivel"];
        $estado=$_POST["estado"];
        $consulta=("INSERT INTO usuario(id_empleado,usuario,pasword,nivel,estado) values ('$empleado','$usuario','$contraseña','$nivel','$estado')");
        $res=mysqli_query($conexion,$consulta);
        if($res)
        {
            echo "ola";
        }
        header("Location:indexUsuario.php");
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
        $consulta=("SELECT id_empleado,ci from empleado");
        $res=mysqli_query($conexion,$consulta);
        $vector=array();
        while($reg=mysqli_fetch_array($res))
        {
            $vector[]=$reg;
        }
        echo json_encode($vector);
    }
?>