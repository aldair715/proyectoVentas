const d=document,
w=window,
n=navigator;
export default function botonMostrar(id)
{
    switch(id)
    {
        case "MOSTRAR CLIENTE":
            w.location.href="../php/mostrar.php?estado=1";
        break;
        case "MOSTRAR CARGO":
            w.location.href="../php/mostrar.php?estado=2";
        break;
        case "MOSTRAR PROVEEDOR":
            w.location.href="../php/mostrar.php?estado=3";
        break;
        case "MOSTRAR EMPLEADOS":
            w.location.href="../php/mostrar.php?estado=4";
        break;
        case "MOSTRAR PRODUCTOS":
            w.location.href="../php/mostrar.php?estado=5";
        break;
        case "MOSTRAR USUARIOS":
            w.location.href="../php/mostrar.php?estado=6";
        break;
    }
}