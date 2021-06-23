
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
    require("../db/conexion.php");
    if(isset($_POST))
    {
        $numero_base=$_GET["mod"];
        $id=$_GET["id"];

        switch($numero_base)
        {
            case 1:
                $consulta="SELECT * from cliente where id_cliente=$id ";
                             

            break;
            case 2:
                $consulta="SELECT * from cargo where id_cargo=$id";
                
            break;
            case 3:
                $consulta="SELECT * from proveedor where id_proveedor=$id";
            break;
            case 4:
                $consulta="SELECT * from empleado where id_empleado=$id";
            break;
            case 5:
                $consulta="SELECT * from producto where id_producto=$id";
            break;
            case 6:
                $consulta="SELECT * from usuario inner join empleado on empleado.id_empleado=usuario.id_empleado  where id_usuario=$id";
            break;
            case 7:
                //$consulta="SELECT * from usuario inner join empleado on empleado.id_empleado=usuario.id_empleado  where id_usuario=$id";
            break;
            case "MOSTRAR USUARIOS INACTIVOS":
                $consulta="UPDATE usuario set estado='ACTIVO' where id_usuario=$id";
                
            break;
        }
        $res=mysqli_query($conexion,$consulta);
        
        if($numero_base==="MOSTRAR USUARIOS INACTIVOS")
        {
            header("Location:mostrar.php?estado=6");
        }
        else
        {
            $reg=mysqli_fetch_array($res); 
        } 
    }
?>
<?php
echo "<form action='mod.php?numeroFormulario=$numero_base' class='form-contact' method='POST' enctype='multipart/form-data' >";

    switch($numero_base)
    {
        case 1:
            echo "<h2>CLIENTE</h2>
            <input type='text' autocomplete='off' name='razonSocial' placeholder='Coloque la razon Social del cliente' pattern='^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["razonsocial"]."'>
            <input type='text' autocomplete='off' name='nit' placeholder='Coloque el nit del cliente' pattern='^[A-Za-z0-9ÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras,numeros o espacios en blanco' required value='".$reg['nit']."'>
            <input type='hidden' name='id' value=".$reg['id_cliente'].">
            <input type='submit' value='MODIFICAR'>
            
            <div class='form-contact-loader none'>
                <img src='../assets/oval.svg' alt='Cargando'>
            </div> 
            <div class='form-contact-response none'> <p>datos enviados</p></div>
        ";
       
      
        break;
        case 2:
            echo "<h2>CARGO</h2><input type='text' autocomplete='off' name='cargo' placeholder='Coloque el cargo que desea añadir' pattern='^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' value='".$reg["cargo"]."'  required  >
            <input type='hidden' name='id' value='".$reg['id_cargo']."'>
            <button type='button' id='boton' value='MOSTRAR CARGO'>MOSTRAR</button>
             <input type='submit' id='enviar' value='ENVIAR'>
             
            ";
        break;
        case 3:
            echo "<h2>PROVEEDOR</h2>
            <input type='text' autocomplete='off' name='empresa' placeholder='Coloque la empresa que desea añadir' pattern='^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["empresa"]."'>
            <input type='text' autocomplete='off' name='contacto' placeholder='Coloque el contacto que desea añadir' pattern='^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["contacto"]."'>
            <input type='email' autocomplete='off' name='email' placeholder='Coloque el email que desea añadir' pattern='^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$' title='Coloca email valido' required value='".$reg["email"]."'>
            <input type='number' autocomplete='off' min=0 name='telefono' placeholder='Coloque el telefono que desea añadir' pattern='^[0-9]{8}$' title='Coloca un numero de celular correcto' required value='".$reg["telefono"]."'>
            <input type='text' autocomplete='off' name='direccion' placeholder='Coloque la direccion que desea añadir' pattern='^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["direccion"]."'>
            <img height='200px'width='200px' src='data:image/jpg;base64,".base64_encode($reg["logo"])." '>
            <input type='file'  name='logito' title='Coloque archivos jpg/png/jpeg'>
            <input type='hidden' name='id' value=".$reg["id_proveedor"].">
            <input type='submit' id='enviar' value='MODIFICAR'>";
        break;
        case 4:
            
            echo "<h2>EMPLEADO</h2> 
            <select name='cargo' id='id_cargo' required>
            <option value=''>------ELIGE UN CARGO----</option>
            ";
            $consulta=("SELECT * from cargo");
            $res=mysqli_query($conexion,$consulta);
            
           while($vector=mysqli_fetch_array($res))
           {
                echo "<option name='cargo' value='".$vector["id_cargo"]." '";
                if($vector["id_cargo"]==$reg["id_cargo"])
                {
                    echo "selected";
                }
                echo ">".$vector["cargo"]." </option>";
           }
            echo "

        </select>
        <input type='number' min=0 name='cedula' placeholder='Coloque la cedula a añadir' pattern='^[0-9]{6,9}$' title='Coloque una cedula de identidad reconocido' required value='".$reg["ci"]."'>
        <input type='text' name='nombre' placeholder='Coloque el nombre del empleado' pattern='^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["nombre"]."'>
        <input type='text' name='paterno' placeholder='Coloque el apellido  paterno del empleado' pattern='^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["paterno"]."' >
        <input type='text' name='materno' placeholder='Coloque el apellido  materno del empleado' pattern='^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["materno"]."'>
        <input type='number' min=0 name='celular' placeholder='Coloque el celular a añadir' pattern='^[0-9]{8}$' title='Coloque un celular reconocido' required value='".$reg["telefono"]."'>
        <input type='text' name='direccion' placeholder='Coloque la direccion que desea añadir' pattern='^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["direccion"]."' >
        <input type='date' name='date' required placeholder='Coloque la fecha de ingreso' value='".$reg["fechanacimiento"]."' >
        <textarea name='interes' cols='50' rows='5' data-pattern='^{1,255}$'  title='Requiere menos de 255 comentarios' placeholder='Coloque los interes del empleado' required>".$reg["intereses"]."</textarea>
        <input type='hidden' name='id' value='".$reg["id_empleado"]."'>
        <div required>
        <h2>GENERO</h2> 
        ";
        $array=array("MASCULINO","FEMENINO","otro");
        forEach($array as $valor)
        {
            echo " <input type='radio' name='genero' value='".$valor." '";
            if($valor==$reg["genero"])
            {
                echo "checked ";
            }
            echo " ><label for=''>".$valor."</label><br>";
        }
        ; echo "
       
        </div>
       
        <input type='submit' id='enviar' value='MODIFICAR'>";
        break;
        case 5:
            
            echo "<h2>PRODUCTO</h2>
            <select name='proveedor' id='id_proveedor' required>
                <option value=''>------ELIGE UN PROVEEDOR----</option>";
                $consulta=("SELECT * from proveedor");
                $res=mysqli_query($conexion,$consulta);
                
               while($vector=mysqli_fetch_array($res))
               {
                    echo "<option name='proveedor' value='".$vector["id_proveedor"]." '";
                    if($vector["id_proveedor"]==$reg["id_proveedor"])
                    {
                        echo "selected";
                    }
                    echo ">".$vector["empresa"]." </option>";
               }
                echo "
            </select>
            <input type='text' name='nombre' placeholder='Coloque el nombre del producto' pattern='^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["nombreProducto"]."'>
            <input type='text' name='descripcion' placeholder='Coloque la descripcion del producto' pattern='^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["descripcion"]."'>
            <input type='number' min=0 name='compra' placeholder='Coloque el precio de compra' pattern='^{1,9}$' title='Coloque una cedula de identidad reconocido' required value='".$reg["costoCompra"]."'>
            <input type='number' min=0 name='venta' placeholder='Coloque el precio de venta' pattern='^{1,9}$' title='Coloque una cedula de identidad reconocido' required value='".$reg["costoVenta"]."'>
            <input type='number' min=0 name='stock' placeholder='Coloque el stock' pattern='^[0-9]{1,9}$' title='Coloque una cedula de identidad reconocido' required value='".$reg["stock"]."'>
            
            <input type='date' name='date' required value='".$reg["fecha"]."'>
            <input type='hidden' name='id' value='".$reg["id_producto"]."'>
        
            <input type='submit' id='enviar' value='MODIFICAR'>";
        break;
        case 6:
            echo "
            <input type='text' name='' placeholder='Coloque el nombre del producto' pattern='^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required disabled value='".$reg["paterno"]." ".$reg["materno"]." ".$reg["nombre"]."'>
            <input type='text' name='usuario' placeholder='Coloque nueva contraseña' pattern='^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required value='".$reg["usuario"]."'>
            <input type='password' name='contraseña' placeholder='Coloque nueva contraseña' pattern='^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required>
            <input type='password' name='contraseña1' placeholder='Repita Contraseña' pattern='^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$' title='Coloca solo letras o espacios en blanco' required>
            <select name='nivel'>";
            if($reg["nivel"]==0)
            {
                echo "
                <option value='0' selected>USUARIO NORMAL</option>
                <option value='1'>ADMINISTRADOR</option>
            </select>
                ";
            }
            else
            {
                echo "
                <option value='0'>USUARIO NORMAL</option>
                <option value='1' selected>ADMINISTRADOR</option>
            </select>
                ";
            }
                
            echo "
            <input type='hidden' name='id' value='".$reg["id_usuario"]."'>
            <input type='submit' id='enviar' value='ENVIAR'>
            <div class='form-contact-loader none'>
                <img src='../assets/oval.svg' alt='Cargando'>
            </div> 
            <div class='form-contact-response none'> <p>datos enviados</p></div>";
        break;
        
    }
?>
 <div class="form-contact-loader none">
                 <img src="../assets/oval.svg" alt="Cargando">
             </div> 
             <div class="form-contact-response none"> <p>datos enviados</p></div>
</div>
</form>


<script src="../js/index.js" type="no module"></script>
<?php
    include("footer.php");
?>

