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
        <form action="procesar.php?numero=6" class="form-contact" name="validar_datos_fm" method="POST">  
            <h2>USUARIO</h2>
            <select name="empleado" id="id_empleado" required>
                <option value="">------ELIGE UN EMPLEADO----</option>
            </select>
            <input type="text" name="usuario" autocomplete="off" placeholder="Coloque el usuario" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="password" name="contraseña" autocomplete="off" placeholder="Coloque la contraseña" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="password" name="contraseña1" autocomplete="off" placeholder="Escriba de nuevo la contraseña" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <select name="nivel" id="" required>
                <option value="0">USUARIO NORMAL</option>
                <option value="1">ADMINISTRADOR</option>
            </select>
           <button type="button" id="boton" value="MOSTRAR USUARIOS">MOSTRAR</button>
           <button type="button" id="botonInactivos" value="MOSTRAR USUARIOS INACTIVOS">MOSTRAR INACTIVOS</button>
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
 