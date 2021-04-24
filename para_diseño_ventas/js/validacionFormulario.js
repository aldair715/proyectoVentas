const d=document;
export default function validacionFormulario(){
    const $formulario=d.querySelector(".form-contact"),
    $inputs=d.querySelectorAll(".form-contact [required]");
    $inputs.forEach(input=>{
        const $input=d.createElement("span");
        $input.id=input.name;
        $input.textContent=input.title;
        $input.classList.add("form-contact-error","none");
        input.insertAdjacentElement("afterend",$input);
    });
    d.addEventListener("keyup",e=>{
        if(e.target.matches(".form-contact [required]"))
        {
            let input=e.target;
            let pattern=input.pattern || input.dataset.pattern;
            if(pattern && input.value!=="")
            {
                let regExp=new RegExp(pattern);console.log(input.value);
                return !regExp.exec(input.value)
                ? d.getElementById(input.name).classList.add("is-active")
                : d.getElementById(input.name).classList.remove("is-active") ;
            }
            if(!pattern)
            {
                return $input.value===""
                ? d.getElementById($input.name).classList.add("is-active")
                : d.getElementById($input.name).classList.remove("is-active");
            }
            
        }

    });
    d.addEventListener("submit",e=>{
        const boton=d.getElementById("enviar");
        let verificar=false;
        if(e.target.matches(boton))
        {
            e.preventDefault();
            $inputs.forEach(input=>{
                if(!input.value)
                {
                    verificar=true;
                }
            });
            if(verificar===true)
            {alert("uno o varias entradas estan vacias");
            }
            else{
                const $loader=d.querySelector(".form-contact-loader"),
                $response=d.querySelector(".form-contact-response");
                $loader.classList.remove("none");
                setTimeout(()=>{
                    $loader.classList.add("none");
                    $response.classList.remove("none");
                    $formulario.reset();
                    setTimeout(()=>$response.classList.add("none"),3000);
                    },5000);
                }
                
                d.validar_datos_fm.submit()
                ;
                
        }

    });
   
}