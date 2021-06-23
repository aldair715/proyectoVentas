<?php
    require("../db/conexion.php");
    require("head.php");
    include("seguridad.php");
    if($_SESSION["nivel"]==0)
    {
        include("../php/encabezado1.php");
    }
    if($_SESSION["nivel"]==1)
    {
        include("../php/encabezado2.php");
        
    }
    if(isset($_GET))
    {

        $valor=$_GET["accion"];
        $link="";
        
           switch($valor)
            {
                
                case "MOSTRAR USUARIOS INACTIVOS":
                    $consulta="SELECT * from usuario inner join empleado on empleado.id_empleado=usuario.id_empleado 
                    where usuario.estado='INACTIVO'";
                    $res=mysqli_query($conexion,$consulta);
                    $link="indexUsuario.php";
                break;
            } 
    }
?>
<body>
    <div class="centrado">
        <?php 
        echo "<a class='boton-personalizado' href='".$link."'>VOLVER</a>";
           
        ?>
        
    </div>
    <?php
        echo "<input type='hidden' id='oculto' data-estado='$valor'>";

    ?>

    <table class="main-table">
        <thead>
            <?php
                switch($valor)
                {
                    case "MOSTRAR USUARIOS INACTIVOS":
                        echo "<tr>
                        <th>Nº</th>
                        <th>Usuario</th>
                        <th>Nivel</th>
                        <th>Estado</th>
                        <th>ID_EMPLEADO</th>
                        <th>CI_EMPLEADO</th>
                        <th>ELIMINAR</th>
                        <th>REESTABLECER</th>
                        </tr>";
                        
                    break;
                }
            ?>
            
        </thead>
        <tbody>
            <?php
            switch($valor)
            {
                case "MOSTRAR USUARIOS INACTIVOS":
                    $i=1;
                    while($reg=mysqli_fetch_array($res))
                    {
                        echo "<tr>
                        <td>".$i."</td>
                        <td>".$reg["usuario"]."</td>
                        <td>".$reg["nivel"]."</td>
                        <td>".$reg["estado"]."</td>
                        <td>".$reg["id_empleado"]."</td>
                        <td>".$reg["ci"]."</td>
                        <td><button class='delete' data-id=".$reg["id_usuario"].">ELIMINAR</button></td>
                        <td><button class='reestablecer edit' data-id=".$reg["id_usuario"].">REESTABLECER</button></td></tr>";
                        $i++;
                    }
                break;
               
            }
           
            ?>
        </tbody>
    </table>
    
<script src="../js/eliminaryEdita.js">
</script>
<?php
    include("footer.php");
?>