const d=document,
w=window;
const seleccionarProductos=async()=>{

    let $tabla=d.createElement("table"),
    $muestreo=d.querySelector(".muestreo");
    $tabla.classList.add("container");
    let guardarDatos=Array(),
    $contador=0,
    $string="";
    if(localStorage.getItem('data'))
    {
        guardarDatos=JSON.parse(localStorage.getItem('data'));
        $contador=1;

        guardarDatos.forEach(el => {
            $string+=el.id_producto;
            $string+="/";
        });
    }
    try{
        let res=await fetch("../php/procesar.php?numero=producto"),
        JSON=await res.json();
        let $t=`<thead>
        <tr>
        <th>Nº</th>
        <th>Nombre del Producto</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Stock</th>
        <th></th>
        <th></th>
        </tr>
        </thead>
        <tbody>`;
        let $tbody="";
        if(!res.ok)throw{status:res.status,statusText:res.statusText}
        let i=0;
        JSON.forEach(el => {
            i++;
            $tbody+=`<tr>
                <td>${i}</td>
                <td>${el.nombreProducto}</td>
                <td>${el.descripcion}</td>
                <td>${el.costoVenta}</td>
                <td>${el.stock}</td>
                `;
            if(el.stock==0)
            {
                $tbody+=`
                <td><input type="number" disabled min='0' value="0"  class="stock-${el.id_producto}"/></td>
                <td><button class="btn btn-danger" disabled id='${el.id_producto}' data-id="${el.id_producto}">AGOTADO</button></td>
            </tr>`;
            }
            else{
                $tbody+=`<td><input type="number" min='1' value="1" max='${el.stock}' class="stock-${el.id_producto}"/></td>`;
                let $cadenaClass="",$nombreBu="";
                if($contador===1)
                {
                    if($string.includes(`${el.id_producto}`))
                    {
                        $cadenaClass="btn-success";
                        $nombreBu="AGREGADO";
                    }
                    else
                    {
                        $cadenaClass="btn-primary alCarrito";
                        $nombreBu="AGREGAR";
                    }  
                }
                else{
                    $cadenaClass="btn-primary alCarrito";
                    $nombreBu="AGREGAR"
                } 
                $tbody+=`<td><button class="btn ${$cadenaClass}" id='${el.id_producto}' data-id="${el.id_producto}">${$nombreBu}</button></td>
                    </tr>`;
                
            }
                
        });
        $tbody+=`</tbody>`;
        $t+=$tbody;
        $tabla.innerHTML=$t;
        d.querySelector(".form-contact-response").insertAdjacentElement("afterend",$tabla);
        d.querySelector(".form-contact-loader").style.display=`none`;
    }
    catch(error){
        let mensaje=error.statusText || "SE TIENE ERROR";
        $muestreo.classList.add("alert","alert-danger");
        $muestreo.innerHTML=`<h1>ERROR: ${error.status} <br> ${mensaje} </h1>`;
        
        d.querySelector(".form-contact-loader").style.display=`none`;
        
    }
  
    
    
};

seleccionarProductos();