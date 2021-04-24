<?php
    include("../db/conexion.php");
    $consulta="SELECT cargo from cargo";
    $res=mysqli_query($conexion,$consulta);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar CARGO</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="centrado">
        <a class="boton-personalizado" href="indexCargo.php">VOLVER</a>
    </div>
    
    <table class="main-table">
        <thead>
            <th>Nº</th>
            <th>NOMBRE DEL CARGO</th>
        </thead>
        <tbody>
            <?php
            $i=1;
                while($reg=mysqli_fetch_array($res))
                {
                    echo "<tr>
                    <td>".$i."</td>
                    <td>".$reg["cargo"]."</td>
                    <tr>";
                    $i=$i+1;
                }
            ?>
        </tbody>
    </table>
</body>
</html>