<?php
require("../db/conexion.php");
if(isset($_POST))
{
    $usuario=$_POST["usuario"];
    $contraseña=$_POST["contraseña"];
    $consulta="SELECT * from usuario where usuario='$usuario'";
    $res=mysqli_query($conexion,$consulta);
    if(mysqli_num_rows($res)!=0)
    {
            
            $consulta="SELECT *  from usuario where usuario='$usuario'";
            $res=mysqli_query($conexion,$consulta);
            $reg=mysqli_fetch_array($res);
            $contra=md5($contraseña);
            if($contra==$reg["pasword"])
            {
                session_start();
                $_SESSION['ingreso']="si";
                $_SESSION["id_empleado"]=$reg['id_empleado'];
                $_SESSION["usuario"]=$reg['usuario'];
                $_SESSION['nivel']=$reg['nivel'];
                
                header("Location:admin.php");
            }
            else
            {
                header("Location:../index.php?error=2");
            }
    }
    else
    {
        header("Location:../index.php?error=1");
    }
}
?>