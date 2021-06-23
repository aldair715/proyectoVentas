<?php
    require("./fpdf/fpdf.php");
    require("../../db/conexion.php");
    $nFormulario=$_GET["nFormulario"];
   
    //creamos la cabecera
    
    class PDF extends FPDF
    {
        function Header()
        {
            global $nFormulario;
            $this->Image('../../assets/logo.jpg',10,8,33);
            $this->SetFont('Arial','B',18);
            $this->Cell(50);
            $this->Cell(30,25,utf8_decode("Reporte de $nFormulario"),0,0,'C');
            $this->Ln(30);
        }
        function Footer()
        {   
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');

        }
        
    }
    //traemos las variables
    
    //traemos un archivo
    $consulta="";
    switch($nFormulario)
    {
        case 'clientes':
            $consulta="SELECT * from cliente";
        break;
        case "cargos":
            $consulta="SELECT * from cargo";
        break;
        case "proveedores":
            $consulta="SELECT * from proveedor";
        break;
        case "usuarios":
            $consulta="SELECT usuario,concat(paterno,' ',materno,' ',nombre) as nombreCompleto,nivel,estado FROM `usuario`inner join empleado on empleado.id_empleado=usuario.id_empleado";
        break;
        case "productos":
            $consulta="SELECT * from producto inner join proveedor on proveedor.id_proveedor=producto.id_proveedor";
        break;
        case "empleados":
            $consulta="SELECT ci,concat(paterno,' ',materno,' ',nombre) as nombreCompleto,cargo,direccion,telefono,fechanacimiento,genero,intereses
             FROM `empleado` inner join cargo on cargo.id_cargo=empleado.id_cargo  ";
        break;
        case "ventas":
            $consulta="SELECT ven.id_venta,concat(emp.paterno,' ',emp.materno,' ',emp.nombre) 
            as nombre, cli.razonsocial,fecha
            from venta as ven 
            inner join empleado as emp on emp.id_empleado=ven.id_empleado inner join cliente as 
            cli on cli.id_cliente=ven.id_cliente ";
        break;
        case "compras":
            $consulta="SELECT com.id_compra,concat(emp.paterno,' ',emp.materno,' ',emp.nombre) 
            as nombreCompleto,cargo.cargo,fecha from compra as com inner join empleado as emp on 
            emp.id_empleado=com.id_empleado inner join cargo on cargo.id_cargo=emp.id_cargo";
        break;
    }
    $resultado=$conexion->query($consulta);
    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    //recorremos el pdf segun el switch
    switch($nFormulario)
    {
        case 'clientes':

            $pdf->Cell(10,10,utf8_decode("Nº"),1,0,'C',0);
            $pdf->Cell(100,10,utf8_decode("Razón Social"),1,0,'C',0);
            $pdf->Cell(40,10,utf8_decode("NIT"),1,1,'C',0);
            $i=0;
            while($row=$resultado->fetch_assoc())
            {
                $pdf->SetFont('Arial','',16);
                $i=$i+1;
                $pdf->Cell(10,10,$i,1,0,'C',0);
                $pdf->Cell(100,10,utf8_decode($row["razonsocial"]),1,0,'C',0);
                $pdf->Cell(40,10,utf8_decode($row["nit"]),1,1,'C',0);
            }
        break;
        case "cargos":
            $pdf->Cell(10,10,utf8_decode("Nº"),1,0,'C',0);
            $pdf->Cell(100,10,utf8_decode("CARGO"),1,1,'C',0);

            $i=0;
            while($row=$resultado->fetch_assoc())
            {
                $pdf->SetFont('Arial','',16);
                $i=$i+1;
                $pdf->Cell(10,10,$i,1,0,'C',0);
                $pdf->Cell(100,10,utf8_decode($row["cargo"]),1,1,'C',0);
            }
        break;
        case "proveedores":
            $pdf->Cell(10,10,utf8_decode("Nº"),1,0,'C',0);
            $pdf->Cell(40,10,utf8_decode("empresa"),1,0,'C',0);
            $pdf->Cell(30,10,utf8_decode("contacto"),1,0,'C',0);
            $pdf->Cell(50,10,utf8_decode("email"),1,0,'C',0);
            $pdf->Cell(30,10,utf8_decode("telefono"),1,0,'C',0);
            $pdf->Cell(30,10,utf8_decode("direccion"),1,1,'C',0);
            $i=0;
            while($row=$resultado->fetch_assoc())
            {
                $pdf->SetFont('Arial','',16);
                $i=$i+1;
                $pdf->Cell(10,10,utf8_decode($i),1,0,'C',0);
                $pdf->Cell(40,10,utf8_decode($row["empresa"]),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["contacto"]),1,0,'C',0);
                $pdf->Cell(50,10,utf8_decode($row["email"]),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["telefono"]),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["direccion"]),1,1,'C',0);
            }
        break;
        case "usuarios":
            $pdf->Cell(10,10,utf8_decode("Nº"),1,0,'C',0);
            $pdf->Cell(50,10,utf8_decode("USUARIO"),1,0,'C',0);
            $pdf->Cell(70,10,utf8_decode("EMPLEADO"),1,0,'C',0);
            $pdf->Cell(15,10,utf8_decode("NIVEL"),1,0,'C',0);
            $pdf->Cell(30,10,utf8_decode("ESTADO"),1,1,'C',0);
            $i=0;
            while($row=$resultado->fetch_assoc())
            {
                $pdf->SetFont('Arial','',16);
                $i=$i+1;
                $pdf->Cell(10,10,utf8_decode($i),1,0,'C',0);
                $pdf->Cell(50,10,utf8_decode($row["usuario"]),1,0,'C',0);
                $pdf->Cell(70,10,utf8_decode($row["nombreCompleto"]),1,0,'C',0);
                $pdf->Cell(15,10,utf8_decode($row["nivel"]),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["estado"]),1,1,'C',0);
            }
        break;
        case "productos":
            $pdf->Cell(10,10,utf8_decode("Nº"),1,0,'C',0);
            $pdf->Cell(40,10,utf8_decode("Empresa"),1,0,'C',0);
            $pdf->Cell(30,10,utf8_decode("producto"),1,0,'C',0);
           
            $pdf->Cell(18,10,utf8_decode("costo"),1,0,'C',0);
            $pdf->Cell(18,10,utf8_decode("precio"),1,0,'C',0);
            $pdf->Cell(18,10,utf8_decode("Stock"),1,0,'C',0);
            $pdf->Cell(30,10,utf8_decode("fecha "),1,1,'C',0);
            $i=0;
            while($row=$resultado->fetch_assoc())
            {
                $pdf->SetFont('Arial','',16);
                $i=$i+1;
                $pdf->Cell(10,10,$i,1,0,'C',0);
                $pdf->Cell(40,10,utf8_decode($row["empresa"]),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["nombreProducto"]),1,0,'C',0);
     
                $pdf->Cell(18,10,utf8_decode($row["costoCompra"]),1,0,'C',0);
                $pdf->Cell(18,10,utf8_decode($row["costoVenta"]),1,0,'C',0);
                $pdf->Cell(18,10,utf8_decode($row["stock"]),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["fecha"]),1,1,'C',0);
            }
        break;
        case "empleados":
            
            $i=0;
            while($row=$resultado->fetch_assoc())
            {
                $pdf->SetFont('Arial','',16);
                $i=$i+1;
                $pdf->Cell(70,10,utf8_decode("Nº"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($i),1,1,'C',0);
                $pdf->Cell(70,10,utf8_decode("CI"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($row["ci"]),1,1,'C',0);
                $pdf->Cell(70,10,utf8_decode("NOMBRE COMPLETO"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($row["nombreCompleto"]),1,1,'C',0);
                $pdf->Cell(70,10,utf8_decode("CARGO"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($row["cargo"]),1,1,'C',0);
                $pdf->Cell(70,10,utf8_decode("NIVEL"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($row["direccion"]),1,1,'C',0);
                $pdf->Cell(70,10,utf8_decode("DIRECCION"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($row["telefono"]),1,1,'C',0);
                $pdf->Cell(70,10,utf8_decode("TELEFONO"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($row["fechanacimiento"]),1,1,'C',0);
                $pdf->Cell(70,10,utf8_decode("FECHA DE NACIMIENTO"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($row["genero"]),1,1,'C',0);
                $pdf->Cell(70,10,utf8_decode("INTERESES"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($row["intereses"]),1,1,'C',0);  
            }
        break;
        case "ventas":
            $i=0;
            $suma=0;
            while($row=$resultado->fetch_assoc())
            {   
                $id=$row["id_venta"];
                $pdf->SetFont('Arial','',16);
                $i=$i+1;
                $pdf->Cell(10,10,utf8_decode("Nº"),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode("ID VENTA"),1,0,'C',0);
                $pdf->Cell(90,10,utf8_decode("EMPLEADO QUE VENDIO"),1,0,'C',0);
                $pdf->Cell(20,10,utf8_decode("FECHA"),1,0,'C',0);
                $pdf->Cell(40,10,utf8_decode("CLIENTE"),1,1,'C',0);
                $pdf->Cell(10,10,utf8_decode("$i"),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["id_venta"]),1,0,'C',0);
                $pdf->Cell(90,10,utf8_decode($row["nombre"]),1,0,'C',0);
                $pdf->Cell(20,10,utf8_decode($row["fecha"]),1,0,'C',0);
                $pdf->Cell(40,10,utf8_decode($row["razonsocial"]),1,1,'C',0);
                $consulta=" SELECT nombreProducto,descripcion,costoVenta,cantidad 
                from venta as ven inner join detalle_venta as det on det.id_venta=ven.id_venta
                 inner join producto as prod on prod.id_producto=det.id_producto where ven.id_venta=$id";
                $resu=$conexion->query($consulta);
                while($fila=$resu->fetch_assoc())
                {
                    $pdf->Cell(70,10,utf8_decode("NOMBRE DEL PRODUCTO"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["nombreProducto"]),1,1,'C',0);
                    $pdf->Cell(70,10,utf8_decode("DESCRIPCION"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["descripcion"]),1,1,'C',0);
                    $pdf->Cell(70,10,utf8_decode("COSTO DE VENTA"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["costoVenta"]),1,1,'C',0);
                    $pdf->Cell(70,10,utf8_decode("CANTIDAD"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["cantidad"]),1,1,'C',0);
                    $suma=$suma+$fila["costoVenta"]*$fila["cantidad"];
                }
                $pdf->Cell(70,10,utf8_decode("TOTAL VENTA"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($suma),1,1,'C',0);
            }
        break;
        case "compras":
            $i=0;
            $suma=0;
            while($row=$resultado->fetch_assoc())
            {   
                $id=$row["id_compra"];
                $pdf->SetFont('Arial','',16);
                $i=$i+1;
                $pdf->Cell(10,10,utf8_decode("Nº"),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode("ID COMPRA"),1,0,'C',0);
                $pdf->Cell(80,10,utf8_decode("EMPLEADO QUE COMPRO"),1,0,'C',0);
                $pdf->Cell(40,10,utf8_decode("CARGO"),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode("FECHA"),1,1,'C',0);
                $pdf->Cell(10,10,utf8_decode("$i"),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["id_compra"]),1,0,'C',0);
                $pdf->Cell(80,10,utf8_decode($row["nombreCompleto"]),1,0,'C',0);
                $pdf->Cell(40,10,utf8_decode($row["cargo"]),1,0,'C',0);
                $pdf->Cell(30,10,utf8_decode($row["fecha"]),1,1,'C',0);
                $consulta=" SELECT prod.nombreProducto,prod.descripcion,det.costoCompra,det.cantidadCompra,prov.empresa
                 FROM compra as comp inner join detalle_compra as det on det.id_compra=comp.id_compra inner join producto as
                  prod on prod.id_producto=det.id_producto inner join proveedor prov on prov.id_proveedor=prod.id_proveedor where comp.id_compra=$id";
                $resu=$conexion->query($consulta);
                while($fila=$resu->fetch_assoc())
                {
                    $pdf->Cell(70,10,utf8_decode("NOMBRE DEL PRODUCTO"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["nombreProducto"]),1,1,'C',0);
                    $pdf->Cell(70,10,utf8_decode("DESCRIPCION"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["descripcion"]),1,1,'C',0);
                    $pdf->Cell(70,10,utf8_decode("PROVEEDOR"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["empresa"]),1,1,'C',0);
                    $pdf->Cell(70,10,utf8_decode("COSTO DE COMPRA"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["costoCompra"]),1,1,'C',0);
                    
                    $pdf->Cell(70,10,utf8_decode("CANTIDAD"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($fila["cantidadCompra"]),1,1,'C',0);
                    $suma=$suma+$fila["costoCompra"]*$fila["cantidadCompra"];
                }
                $pdf->Cell(70,10,utf8_decode("TOTAL COMPRA"),1,0,'C',0);$pdf->Cell(120,10,utf8_decode($suma),1,1,'C',0);
            }
        break;
    }
    
    $pdf->Output();
?>