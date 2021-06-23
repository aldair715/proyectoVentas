<?php 
    include("../php/head.php");
    include("./seguridad.php");
    $nFormulario=$_GET["nbusqueda"];
   
    if($_SESSION["nivel"]==0)
    {
        include("../php/encabezado1.php");
    }
    if($_SESSION["nivel"]==1)
    {
        include("../php/encabezado2.php");
        
    }
    require("../db/conexion.php");
?>
<body>
<div class="container">
<br>
    <form action="./procesoBusqueda.php" method="POST">
            
            <?php
                echo "<input type='hidden' name='nFormulario' value='$nFormulario'> ";
                switch($nFormulario)
                {
                    case 1:
                        echo "<input type='search' name='texto' class='form-control' placeholder='ESCRIBA EL NOMBRE DEL CLIENTE QUE QUIERE BUSCAR'>";
                    break;
                    case 2:
                        echo "<input type='search' name='texto' class='form-control' placeholder='ESCRIBA EL NOMBRE DEL CARGO QUE QUIERE BUSCAR'>";
                    break;
                    case 3:
                        echo "<input type='search' name='texto' class='form-control' placeholder='ESCRIBA EL NOMBRE DEL PROVEEDOR QUE QUIERE BUSCAR'>";
                    break;
                    case 4:
                        echo "<input type='search' name='texto' class='form-control' placeholder='ESCRIBA EL NOMBRE DEL EMPLEADO QUE QUIERE BUSCAR'>";
                    break;
                    case 5:
                        echo "<input type='search' name='texto' class='form-control' placeholder='ESCRIBA EL NOMBRE DEL PRODUCTO QUE QUIERE BUSCAR'>";
                    break;
                    case 6:
                        echo "<input type='search' name='texto' class='form-control' placeholder='ESCRIBA EL NOMBRE DEL USUARIO QUE QUIERE BUSCAR'>";
                    break;
                    case 7:
                        echo "<input type='search' name='texto' class='form-control' placeholder='ESCRIBA EL ID DE LA VENTA QUE SE QUIERE BUSCAR'>";
                    break;
                    case 8:
                        echo "<input type='text' name='texto' class='form-control' placeholder='ESCRIBA EL ID DE LA COMPRA A BUSCAR'>";
                    break;
                    default:
                    break;
                }
            ?>
            
            <input type="submit" placeholder="ENVIAR">
        </form>
</div>

</body>
<?php
    include("../php/footer.php");
?>