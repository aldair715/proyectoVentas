const d=document;
const seleccionCargo=()=>{
    const $empleado=d.getElementById("id_empleado");
    const xhr=new XMLHttpRequest(),
    $fragment=d.createDocumentFragment();
    xhr.open('GET','../php/procesar.php?numero=empleado');
    xhr.onload=function()
    {
        if(xhr.readyState!=4)return;
        if(xhr.status>=200 && xhr.status<300)
        {
            
            let json=JSON.parse(xhr.responseText);
            json.forEach(el=>{
                let option=d.createElement("option");
                option.value=el.id_empleado;
                option.textContent=el.nombre+" "+el.paterno+" "+el.materno;
                $fragment.appendChild(option);
            });
            $empleado.appendChild($fragment);
        }
        else
        {
            console.log('existio un error');
        }
     
    }
    xhr.send();
};
d.addEventListener("DOMContentLoaded",seleccionCargo());
