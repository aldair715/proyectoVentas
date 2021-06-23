<?php
include("head.php");
include("seguridad.php");
require("../db/conexion.php");
if($_SESSION["nivel"]==0)
    {
        include("../php/encabezado1.php");
    }
    if($_SESSION["nivel"]==1)
    {
        include("../php/encabezado2.php");
        
    }
    if($_POST)
            {
            $suma=0;
            
            foreach ($_POST as $clave=>$valor)
            {
                if($clave=="suma")
                {
                    $suma=$valor;
                }
            }
            $proveedor=$_POST["proveedores"];
            }
?>
<body>
    <div class="seccion">
            <form class="form-contact" name="validar_datos_fm" >  
                <h2>COMPRA</h2>
                
                <label for="">EMPRESA</label>
                <input type="text" autocomplete="off" readonly value="<?php echo "$proveedor"?>" name="empresa" placeholder="Coloque la empresa que desea añadir" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
               
                <label for="">PRECIO TOTAL</label>
                <input type="text" autocomplete="off" value="<?php echo $suma ?>" readonly disabled pattern="^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Coloca solo letras o espacios en blanco" required>
                <?php
                    if($_POST)
                    {
                        $i=1;
                        foreach ($_POST as $clave=>$valor)
                        {
                            
                            if($clave!="suma")
                            {
                                echo "<input type='hidden' value='$valor' name='$clave'/>";
                                $i++;
                            }
                        }
                            echo "<input type='hidden' value='".$_SESSION["id_empleado"]."' name='id_empleado'/>";
                    }
                    
                ?>
                
                <input type="submit" id="enviar" value="ENVIAR" >
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-dark">
                    
                    </div>
                </div>
                </div>
            </div>
                <div class="form-contact-response none"> <p>datos enviados</p></div>
            </form>
        
    </div> 

    <?php
    include("footer.php");
?><script>
        const doc=document,
        funcionCargaElLoader=async()=>{
            let $loader=doc.createElement("img");
            $loader.src=`../assets/grid.svg`;
            $loader.alt=`CARGANDO.....`;
            $loader.id="loader";
            doc.getElementById("myModal").querySelector(".modal-body").appendChild($loader);
            $("#myModal").modal("show");
        };
        const llamadaFetch=async(props)=>{
            
            try{
                let {url,method,body}=props,
                option={method,body};
                let res=await fetch(url,option);
                let json=await res.json();
                if(!res.ok){throw{status:res.status,statusText:res.statusText};
                }
                json.forEach(el=>{
                    if(el==="exito")
                    {
                        let modal=doc.getElementById("myModal").querySelector(".modal-body");
                        let $p=`<i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            <p>REGISTRO REALIZADO</p>`;   
                        setTimeout(()=>{
                            modal.innerHTML=$p;
                            modal.classList.add("bg-success");
                        },5000);
                        localStorage.clear();
                        window.location.href="indexCompra.php";
                        //modal.innerHTML=""; 
                        
                    }
                });
                
            }catch(error){
                console.log(error);
                let mensaje=error.statusText || "OCURRIO UN ERROR",
                $p=`<p>ERROR ${error.status} : ${mensaje}</p>`;
                doc.getElementById("myModal").querySelector(".modal-body").removeChild(doc.getElementById("loader"));
                doc.getElementById("myModal").querySelector(".modal-body").innerHTML=$p;
                $("myModal").modal("show");
            }
          
        };
        doc.addEventListener("submit",async e=>{
            if(e.target.matches(".form-contact"))
            {
                console.log(e.target);
                e.preventDefault();
                await funcionCargaElLoader();
                await llamadaFetch({
                    url:`procesar.php?numero=8`,
                    method:`POST`,
                    body:new FormData(e.target)
                });
            }
        });
    </script>
    