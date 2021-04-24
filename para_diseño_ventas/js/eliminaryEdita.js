const d=document,
$tabla=d.querySelector(".main-table"),
$id=d.getElementById("oculto");
const ajax=(options)=>{
    let {url,method,success,error,data}=options;
            const xhr=new XMLHttpRequest();
            xhr.addEventListener("readystatechange",e=>{
                if(xhr.readyState!=4)return;
                if(xhr.status>=200 && xhr.status<300)
                {
                    success();
                }
                else{
                    let mensaje=xhr.statusText || "ocurrio un error";
                    error(mensaje);
                }
            });console.log(data);
            xhr.open(method || "GET",url);
            xhr.setRequestHeader("Content-Type","application/json;charset=utf-8");
            xhr.send(JSON.stringify(data));
};
d.addEventListener("click",e=>{
     console.log('hoa');
     
    if(e.target.matches(".delete"))
    {
        let confirmar=confirm("Eliminar el registro seleccionado");
        if(confirmar)
        {
             ajax({
            url:`../php/eliminar.php?elim=${$id.dataset.estado}&id=${e.target.dataset.id}`,
            method:`DELETE`,
            success:(json)=>{
                location.reload();
            },
            error:(mensaje)=>{
                alert(`error en la eliminacion ${mensaje}`);
            }
            });
        }
       
    }
    if(e.target.matches(".edit"))
    {
        
        let confirmar=confirm("MODIFICAR EL REGISTRO SELECCIONADO????????");
        
        if(confirmar)
        {
            ajax({
                url:`../php/modificar.php?mod=${$id.dataset.estado}`,
                method:`POST`,
                success:(json)=>{
                   location.href=`../php/modificar.php?mod=${$id.dataset.estado}&id=${e.target.dataset.id}`;
                },
                error:(mensaje)=>{
                    alert( `Error en la edicion de ${mensaje}`);
                },
                data:e.target.dataset.id
                    
                
                
                
            });
            /*
            const xhr1=new XMLHttpRequest();
            xhr1.open("POST",`../php/modificar.php?mod=${$id.dataset.estado}`);
            xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr1.send("id="+JSON.stringify(e.target.dataset.id));*/
        }
        
    }
    
});


