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
?>
<main>
<a href="indexCompra.php" class="btn btn-success">VOLVER</a>
<table class="main-table">
    <thead>
        <tr>
            <th>Nº</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>ELIMINAR</th>                    
        </tr>
    </thead>
    <tbody>
        <?php
        
            if($_POST)
            {
            $i=1;$consulta="";$res="";$reg="";$suma=0;
            $id="";
            $valor_id="";
            $proveedores="";
                foreach ($_POST as $clave=>$valor)
                {
                    
                    if(substr_compare("$clave","id_producto_",0,10)==0)
                    {
                        $consulta="SELECT * from producto inner join proveedor on proveedor.id_proveedor=producto.id_proveedor where id_producto='$valor'";
                        $res=mysqli_query($conexion,$consulta);
                        $id=$clave;
                        $valor_id=$valor;
                    }
                    if(substr_compare("$clave","cantidad_",0,8)==0)
                    {
                        $reg=mysqli_fetch_array($res);
                                echo "<tr>
                                <td>".$i."</td>
                                <td>".$reg["nombreProducto"]."</td>
                                <td>".$reg["descripcion"]."</td>
                                <td>".$reg["costoCompra"]."</td>
                                <td>".$valor."</td>
                                <td>".$valor*$reg["costoCompra"]."</td>
                                <td><button class='delete' data-id='$valor_id' data-cantidad='$valor'>ELIMINAR</button></td>
                                </tr>"
                                ;

                            $suma=$suma+($valor*$reg["costoCompra"]);
                            $i=$i+1;
                            $proveedores=$proveedores." ".$reg["empresa"];                      
                        
                    }
                   
                }
            }
            
        
        ?>

    </tbody>
    <tfoot>

        <tr >
        <form action="realizarCompra.php" id="venta" method="POST">
        <input type="hidden" name="suma" value="<?php echo $suma ?>">
        <input type="hidden" name="proveedores" value="<?php echo $proveedores?>">
        <td colspan="7"><button class="btn btn-light realizarVenta" type="submit">REALIZAR COMPRA</button></td> </tr>
        </form>
        
         <tr>

            <td colspan="6">TOTAL COMPRA</td>
            <td><?php echo "$suma" ?>
         </tr>
         </td>  
    </tfoot>
    
</table>


</main>
<script>
    const d=document;
    d.addEventListener("click",e=>{
        if(e.target.matches(".delete"))
        {
            let id=e.target.dataset.id,
            cantidad=e.target.dataset.cantidad;
            let guardarDatos=Array();
            guardarDatos=JSON.parse(localStorage.getItem('data_compra'));
            let i=0;
            if(guardarDatos!=null)
            {
                guardarDatos.forEach(el=>{
                    if(el.id_producto==id)
                    {
                        (i<guardarDatos.length)
                        ?guardarDatos.splice(i,1)
                        :console.log('no se hizo nada');
                        e.target.parentNode.parentNode.remove();
                        localStorage.setItem('data',JSON.stringify(guardarDatos));
                        window.location.href=`indexVentas.php`;
                    }
                    i++;
                });
            }
        }
      
    });
    d.addEventListener("submit",e=>{
        e.preventDefault();
        let $fragment=d.createDocumentFragment();
            let id=1;
                guardarDatos=Array();
                guardarDatos=JSON.parse(localStorage.getItem('data_compra'));
                guardarDatos.forEach(el => {
                    console.log(el.id_producto);
                    let $input=d.createElement("input"),
                    $input1=d.createElement("input");
                    $input.type="hidden";
                    $input.name=`id_producto_${id}`;
                    $input.value=`${el.id_producto}`;
            
                    $input1.type="hidden";
                    $input1.name=`cantidad_${id}`;
                    $input1.value=`${el.cantidad}`;
                    id++;
                    $fragment.appendChild($input);
                    $fragment.appendChild($input1);
                    
                });
            d.getElementById("venta").appendChild($fragment);
            d.getElementById("venta").submit();
    });
</script>