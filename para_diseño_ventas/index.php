<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
 <h1>INGRESO DE USUARIOS</h1>
  <div class="container">
    
        <form action="php/verificarContraseña.php" class="form-contact" name="validar_datos_fm" method="POST">  
            <h2>USUARIO</h2>
            <input type="text" name="usuario" autocomplete="off" placeholder="Coloque el usuario" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="password" name="contraseña" autocomplete="off" placeholder="Coloque la contraseña" pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
            <input type="submit" id="enviar" value="ENVIAR">
            <div class="error">
            <?php
              if(isset($_GET["error"]))
              {
                  $error=$_GET["error"];
                  if($error==1)
                  {
                    echo "<p class='error1'>USUARIO NO ENCONTRADO</p>";
                    
                  }
                  if($error==2)
                  {
                    echo "<br>";
                    echo "<p class='error1'>CONTRASEÑA INCORRECTA</p>";
                  }
                  if($error=3)
                  {
                    echo "<br>";
                    echo "<p class='error1'>acceso no autorizado</p>";
                  }
              }
              else
              {
                echo "<p class='no-hay-error'></p>";
              }
            ?>
            </div>
        </form>
    
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
 
</script>

</body>
</html>