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
        <form action="procesar.php?numero=4" class="form-contact" name="validar_datos_fm" method="POST">  
            <h2>EMPLEADO</h2>
            <select name="cargo" id="id_cargo" required>
                <option value="">------ELIGE UN CARGO----</option>
            </select>
            <input type="number" min=0 name="cedula" placeholder="Coloque la cedula a añadir" pattern="^[0-9]{6,9}$" title="Coloque una cedula de identidad reconocido" required>
            <input type="text" name="nombre" placeholder="Coloque el nombre del empleado" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="text" name="paterno" placeholder="Coloque el apellido  paterno del empleado" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="text" name="materno" placeholder="Coloque el apellido  materno del empleado" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="number" min=0 name="celular" placeholder="Coloque el celular a añadir" pattern="^[0-9]{8}$" title="Coloque un celular reconocido" required>
            <input type="text" name="direccion" placeholder="Coloque la direccion que desea añadir" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="date" name="date" required placeholder="Coloque la fecha de ingreso">
            <textarea name="interes" cols="50" rows="5" data-pattern="^{1,255}$"  title="Requiere menos de 255 comentarios" placeholder="Coloque los interes del empleado" required></textarea>
            <div required>
                <h2>GENERO</h2>
                <input type="radio" name="genero" value="MASCULINO" ><label for="">Hombre</label><br>
                <input type="radio" name="genero" value="FEMENINO" ><label for="">Mujer</label><br>
                <input type="radio" name="genero" value="otro"><label for="">OTRO</label><br>
            </div>
           <button type="button" id="boton" value="MOSTRAR EMPLEADOS">MOSTRAR</button>
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
    <script src="../js/seleccionCargos.js"></script>
 