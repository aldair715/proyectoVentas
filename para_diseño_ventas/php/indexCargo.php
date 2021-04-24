<?php
    include("head.php");
?>
    <div class="seccion">
        <form action="procesar.php?numero=2" class="form-contact" name="validar_datos_fm" method="POST">  
            <h2>CARGO</h2>
            <input type="text" autocomplete="off" name="cargo" placeholder="Coloque el cargo que desea añadir" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
           <button type="button" id="boton" value="MOSTRAR CARGO">MOSTRAR</button>
            <input type="submit" id="enviar" value="ENVIAR">
            
            <div class="form-contact-loader none">
                <img src="../assets/oval.svg" alt="Cargando">
            </div> 
            <div class="form-contact-response none"> <p>datos enviados</p></div>
        </form>
    </div>  <?php
    include("footer.php");
?>
    <script src="../js/index.js" type="module"></script>
  