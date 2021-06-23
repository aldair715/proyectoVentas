<?php
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
?>

<body>
    <div class="seccion">
        <form action="procesar.php?numero=1" class="form-contact" name="validar_datos_fm" method="POST">  
            <h2>CLIENTE</h2>
            <input type="text" autocomplete="off" name="razonSocial" placeholder="Coloque la razon Social del cliente" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="text" autocomplete="off" name="nit" placeholder="Coloque el nit del cliente" pattern="^[A-Za-z0-9ÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras,numeros o espacios en blanco" required>
           <button type="button" id="boton" value="MOSTRAR CLIENTE">MOSTRAR</button>
            <input type="submit" id="enviar" value="ENVIAR">
            
            <div class="form-contact-loader none">
                <img src="../assets/oval.svg" alt="Cargando">
            </div> 
            <div class="form-contact-response none"> <p>datos enviados</p></div>
        </form>
    </div>   <?php
    include("footer.php");
?>
    <script src="../js/index.js" type="module"></script>
 