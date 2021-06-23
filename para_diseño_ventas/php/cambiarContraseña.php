<?php
    require("head.php");
?>
<form action="verificarContraseña.php" class="form-contact" name="validar_datos_fm" method="POST">  
            <h2>USUARIO</h2>
            <input type="text" name="usuario" autocomplete="off" placeholder="Coloque el usuario" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="password" name="contraseña" autocomplete="off" placeholder="Coloque la contraseña" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="submit" id="enviar" value="ENVIAR">
</form>

<?php
    require("footer.php");
?>