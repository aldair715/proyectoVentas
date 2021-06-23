const doc=document;
doc.addEventListener("DOMContentLoaded",e=>
{
   const seleccionarDeCargo=()=>{
    const $proveedor=doc.getElementById("id_proveedor");
    let xhr=new XMLHttpRequest();
    const $fragment=doc.createDocumentFragment();
    xhr.open('GET','../php/procesar.php?numero=proveedor');
    xhr.onload=function(){

       if(xhr.readyState!==4)return;
        if(xhr.status>=200 && xhr.status<300)
        {
            
            let json=JSON.parse(xhr.responseText);
            
            json.forEach(el=>{
                let opt=doc.createElement("option");
                opt.textContent=el.empresa;
                opt.value=el.id_proveedor;
                
                $fragment.appendChild(opt);
            });

            $proveedor.appendChild($fragment);
        }
        else{
            console.log('existe un error');
        }
    }
    xhr.send();
};
seleccionarDeCargo();
});

