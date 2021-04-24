<?php
    include("head.php");
?>
<body>
    <div class="seccion">
        <form action="procesar.php?numero=3" class="form-contact" enctype="multipart/form-data" name="validar_datos_fm" method="POST">  
            <h2>PROVEEDOR</h2>
            <input type="text" autocomplete="off" name="empresa" placeholder="Coloque la empresa que desea añadir" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="text" autocomplete="off" name="contacto" placeholder="Coloque el contacto que desea añadir" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="email" autocomplete="off" name="email" placeholder="Coloque el email que desea añadir" pattern="^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$" title="Coloca email valido" required>
            <input type="number" autocomplete="off" min=0 name="telefono" placeholder="Coloque el telefono que desea añadir" pattern="^[0-9]{8}$" title="Coloca un numero de celular correcto" required>
            <input type="text" autocomplete="off" name="direccion" placeholder="Coloque la direccion que desea añadir" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="file"  name='logo' title="Coloque archivos jpg/png/jpeg" required>
           <button type="button" id="boton" value="MOSTRAR PROVEEDOR">MOSTRAR</button>
            <input type="submit" id="enviar" value="ENVIAR">
            <div class="form-contact-loader none">
                <img src="../assets/oval.svg" alt="Cargando">
            </div> 
            <div class="form-contact-response none"> <p>datos enviados</p></div>
        </form>
    </div>    <?php
    include("footer.php");
?>
    <script src="../js/index.js" type="module"></script>
