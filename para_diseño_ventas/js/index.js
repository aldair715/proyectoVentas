import botonMostrar from "./mostrar.js";
import validacionFormulario from "./validacionFormulario.js";
const d=document,
n=navigator,
w=window;

d.addEventListener("DOMContentLoaded",e=>{
    validacionFormulario();
});
d.addEventListener("click",(e)=>{
    if(e.target.matches("#boton"))
    {
        let boton1=d.getElementById("boton");
       botonMostrar(boton1.value);
    }
    
});

