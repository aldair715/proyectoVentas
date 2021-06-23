//
let guardarDatos=Array();
const doc=document;
const mandarAlCarrito=async(id,stock)=>{
    let id1=id.id;
    let clase=id.getAttribute("class");
    if(!localStorage.getItem("data_compra") && clase.search("btn-primary")!=-1)
    {
        guardarDatos.push({id_producto:id1,cantidad:stock.value});
        localStorage.setItem('data_compra',JSON.stringify(guardarDatos));
    }
    else if(localStorage.getItem("data_compra") && clase.search("btn-primary")!=-1)
    {
        guardarDatos.pop();
        guardarDatos=JSON.parse(localStorage.getItem('data_compra'));
        guardarDatos.push({id_producto:id1,cantidad:stock.value});
        localStorage.setItem('data_compra',JSON.stringify(guardarDatos));
    }
    
    doc.getElementById(id1).classList.remove("btn-primary");
    doc.getElementById(id1).classList.remove("alCarrito");
    doc.getElementById(id1).classList.add("btn-success");
    doc.getElementById(id1).textContent=`AGREGADO`;
    
   
};
d.addEventListener("click",e=>{
    if(e.target.matches(".alCarrito"))
    {
        let stock=d.querySelector(`.stock-${e.target.dataset.id}`);
        
        mandarAlCarrito(e.target,stock);
        stock.setAttribute("disabled","true");
        
    }
});

doc.addEventListener("submit",e=>{
    e.preventDefault();
    let $fragment=doc.createDocumentFragment();
        let id=1;
        guardarDatos.pop();
            guardarDatos=JSON.parse(localStorage.getItem('data_compra'));
            guardarDatos.forEach(el => {
     
                let $input=doc.createElement("input"),
                $input1=doc.createElement("input");
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
        doc.getElementById("oculto").appendChild($fragment);
        doc.getElementById("oculto").submit();
});

