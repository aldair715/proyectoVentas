<?php
    include("head.php");
?>

    <div class="seccion">
        <form action="procesar.php?numero=5" class="form-contact" name="validar_datos_fm" method="POST">  
            <h2>PRODUCTO</h2>
            <select name="proveedor" id="id_proveedor" required>
                <option value="">------ELIGE UN PROVEEDOR----</option>
            </select>
            <input type="text" name="nombre" placeholder="Coloque el nombre del producto" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="text" name="descripcion" placeholder="Coloque la descripcion del producto" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="number" min=0 name="compra" placeholder="Coloque el precio de compra" pattern="^{1,9}$" title="Coloque una cedula de identidad reconocido" required>
            <input type="number" min=0 name="venta" placeholder="Coloque el precio de venta" pattern="^{1,9}$" title="Coloque una cedula de identidad reconocido" required>
            <input type="number" min=0 name="stock" placeholder="Coloque el stock" pattern="^[0-9]{1,9}$" title="Coloque una cedula de identidad reconocido" required>
            
            <input type="date" name="date" required>
            
           <button type="button" id="boton" value="MOSTRAR PRODUCTOS">MOSTRAR</button>
            <input type="submit" id="enviar" value="ENVIAR">
            <div class="form-contact-loader none">
                <img src="../assets/oval.svg" alt="Cargando">
            </div> 
            <div class="form-contact-response none"> <p>datos enviados</p></div>
        </form>
    </div><?php
    include("footer.php");
?>
    <script src="../js/index.js" type="module"></script>
    <script src="../js/seleccionProveedor.js"></script>
