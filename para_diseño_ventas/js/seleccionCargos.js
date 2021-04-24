const d=document;
d.addEventListener("DOMContentLoaded",e=>
{
   const seleccionarDeCargo=()=>{
    const $cargo=d.getElementById("id_cargo");
    let xhr=new XMLHttpRequest();
    const $fragment=d.createDocumentFragment();
    xhr.open('GET','../php/procesar.php?numero=cargo');
    xhr.onload=function(){

       if(xhr.readyState!==4)return;
        if(xhr.status>=200 && xhr.status<300)
        {
            let json=JSON.parse(xhr.responseText);
            
            json.forEach(el=>{
                let opt=d.createElement("option");
                opt.textContent=el.cargo;
                opt.value=el.id_cargo;
                
                $fragment.appendChild(opt);
            });

            $cargo.appendChild($fragment);
        }
        else{
            console.log('existe un error');
        }
    }
    xhr.send();
};
seleccionarDeCargo();
});

