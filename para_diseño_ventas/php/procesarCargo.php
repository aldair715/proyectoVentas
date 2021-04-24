<?php
    include("../db/conexion.php");
    $cargo=$_POST["cargo"];
    $consulta="insert into cargo (cargo) values ('$cargo')";
    $res=mysqli_query($conexion,$consulta);
    header("Location:indexCargo.php");
?>