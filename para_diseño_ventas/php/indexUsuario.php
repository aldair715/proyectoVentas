<?php
    include("head.php");
?>
<body>
    <div class="seccion">
        <form action="procesar.php?numero=6" class="form-contact" name="validar_datos_fm" method="POST">  
            <h2>USUARIO</h2>
            <select name="empleado" id="id_empleado" required>
                <option value="">------ELIGE UN EMPLEADO----</option>
            </select>
            <input type="text" name="usuario" placeholder="Coloque el usuario" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="password" name="contraseña" placeholder="Coloque la contraseña" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="number" min=0 name="nivel" placeholder="Coloque el nivel" pattern="^[0-9]{1,2}$" title="Coloque un celular reconocido" required>
            <input type="text" name="estado" placeholder="Coloque el estado de usuario" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
           <button type="button" id="boton" value="MOSTRAR USUARIOS">MOSTRAR</button>
            <input type="submit" id="enviar" value="ENVIAR">
            <div class="form-contact-loader none">
                <img src="../assets/oval.svg" alt="Cargando">
            </div> 
            <div class="form-contact-response none"> <p>datos enviados</p></div>
        </form>
    </div>  
     <?php
    include("footer.php");
?>
    <script src="../js/index.js" type="module"></script>
    <script src="../js/seleccionEmpleado.js"></script>
 