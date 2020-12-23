<?php
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
/*Recibe datos de Ajax*/
$datosPerfil = $_GET["datosPerfil"];
$datosDemograficos = $_GET["datosDemograficos"];
$datosTeledensidad = $_GET["datosTeledensidad"];
$datosPoblacion = $_GET["datosPoblacion"];
$datosIngreso = $_GET["datosIngreso"];
$datosEducacion = $_GET["datosEducacion"];
$datosOcupacion = $_GET["datosOcupacion"];
$datosEdad = $_GET["datosEdad"];
$datoEDO = $_GET['datoEdo'];
$datoEDO = strtolower($datoEDO);
$perImg = $_GET['perImg'];
/*

*/
$datosPerfil = explode(',',$datosPerfil);
$datosDemograficos = explode(',',$datosDemograficos);
$datosTeledensidad = explode(',',$datosTeledensidad);
$datosPoblacion = explode(',',$datosPoblacion);
$datosIngreso = explode(',',$datosIngreso);
$datosEducacion = explode(',',$datosEducacion);
$datosOcupacion = explode(',',$datosOcupacion);
$datosEdad = explode(',',$datosEdad);
$NivelGeo=trim($datosPoblacion[0]);
if($NivelGeo=='Nacional'){
	$txtNgeo='a nivel Nacional';
}elseif($NivelGeo=='Estatal'){
	$txtNgeo='en '.utf8_decode($datosPerfil[1]);
}elseif($NivelGeo=='Resto de la entidad'){
	$txtNgeo='en '.utf8_decode($datosPerfil[1]).' resto de la entidad';
}else{
	$txtNgeo='en '.utf8_decode($NivelGeo).', '.utf8_decode($datosPerfil[1]);
}
$NivelSex=$datosPoblacion[1];

if($NivelSex=="Mujer"){
	$txtNsex="del total de mujeres";
}elseif($NivelSex=="Hombre"){
	$txtNsex="del total de hombres";
}else{
	$txtNsex="de la población";
}
$ingresoFinal=$datosPerfil[7];
$ingresoFinal=str_replace(":",",",$ingresoFinal);
$ingresoFinal=utf8_decode($ingresoFinal);
$ticPerifil=clean($datosPerfil[0]);
if($ticPerifil=='uso-de-computadora'){
	$txtPperfil="de utilizar computadora";
}elseif($ticPerifil=='uso-de-Internet'){
	$txtPperfil="de utilizar Internet";
}elseif($ticPerifil=='uso-de-tlefono-celular'){
	$txtPperfil=utf8_decode('de utilizar teléfono celular');
}elseif($ticPerifil=='uso-de-Intenet-mediante-smartphone'){
	$txtPperfil=utf8_decode('utilizar Internet mediante smartphone');
}elseif($ticPerifil=='compras-por-internet'){
	$txtPperfil=utf8_decode('realizar compras por Internet');
}elseif($ticPerifil=='compras-por-internet'){
	$txtPperfil=utf8_decode('realizar compras por Internet');
}elseif($ticPerifil=='pagos-por-Internet'){
	$txtPperfil=utf8_decode('realizar pagos por Internet');
}elseif($ticPerifil=='operaciones-bancarias-por-Internet'){
	$txtPperfil=utf8_decode('realizar operaciones bancarias por Internet');
}elseif($ticPerifil=='interaccin-con-el-gobierno-por-Internet'){
	$txtPperfil=utf8_decode('interactuar con el gobierno por Internet');
} elseif ($ticPerifil == 'uso-de-Internet-mediante-smartphone') {
	$txtPperfil=utf8_decode('de utilizar Internet mediante smartphone');
}
/*

*/
//var_dump($datosEdad);

//die();
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
public $titulo;
public $dateDownload;
// Cabecera de página
function Header()
{
  $this->SetFont('Arial','I',8);
  $this->Image('../images/IFT-Imagotipo-horizontal-01.png',2,0,90,18);
  $this->SetXY(105,10);
  $this->MultiCell(180,10,'Calculadora de probabilidades de adopcion de TIC y usos de Internet en '.utf8_decode('México'));
  $this->Image('../images/TablaPDF-03.png',0,20,320,1);
  $this->Ln(30);

}

// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->Image('../images/TablaPDF-03.png',0,285,320,15);
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->titulo = 'Calculadora de Probabilidades';
setlocale(LC_TIME, 'es_ES.UTF-8');
// En windows
setlocale(LC_TIME, 'spanish');
//$pdf->dateDownload = utf8_decode('Documento descargado el día ').utf8_decode($dia).' '.date('j').' de '.$mes.' '.$ano.' a las: '.date('h:i:s A');
$pdf->AliasNbPages();
$pdf->AddPage('P');
$pdf->SetFont('Times','',12);
$pdf->SetFont('Arial','',12);
$pdf->SetXY(5,25);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(55,93,129);
$pdf->Cell(110,10,'Probabilidad de '.utf8_decode($datosPerfil[0]).'',1,1,'L',true); // Varieble TIC
$pdf->SetXY(8,35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Image('../images/'.$perImg,10,38,25,40); // -> Variable
$pdf->SetXY(30,55);
$pdf->SetFont('Arial','',35);
$pdf->Cell(10,8,number_format($datosPerfil[8]*100,1).'%',0,0); // Variable Porcentaje
$pdf->SetXY(8,80);
$pdf->SetFont('Arial','',6);
$pdf->MultiCell(100,3,'Las personas que cubren este perfil tienen un '.round((float)$datosPerfil[8]*100).'%  '.$txtPperfil.'.');
$pdf->SetXY(70,37);
$pdf->Cell(10,8,'Estado: ',0,0);
$pdf->SetXY(80,37);
$pdf->Cell(10,8,utf8_decode($datosPerfil[1]),0,0); // -> Variable Estado

$pdf->SetXY(70,42);
$pdf->Cell(10,8,'Ciudad: ',0,0);
$pdf->SetXY(80,42);
$pdf->Cell(10,8,utf8_decode($datosPerfil[2]),0,0); // -> Variable Nivel Geografico

$pdf->SetXY(70,47);
$pdf->Cell(10,8,'Sexo: ',0,0);
$pdf->SetXY(80,47);
$pdf->Cell(10,8,$datosPerfil[3],0,0); // -> Variable Sexo

$pdf->SetXY(70,52);
$pdf->Cell(10,8,'Edad: ',0,0);
$pdf->SetXY(80,52);
$pdf->Cell(10,8,utf8_decode($datosPerfil[4]),0,0); // -> Variable Edad

$pdf->SetXY(70,57);
$pdf->Cell(10,8, utf8_decode('Educación').': ',0,0);
$pdf->SetXY(85,57);
$pdf->Cell(10,8,utf8_decode($datosPerfil[5]),0,0); // -> Variable Eduacacion

$pdf->SetXY(70,62);
$pdf->Cell(10,8, utf8_decode('Ocupación').': ',0,0);
$pdf->SetXY(85,62);
$pdf->Cell(10,8,utf8_decode($datosPerfil[6]),0,0); // -> Variable Ocupación

$pdf->SetXY(70,67);
$pdf->Cell(10,8,'Ingreso en el Hogar: ',0,0);
$pdf->SetXY(70,74);
$pdf->Cell(10,2,$ingresoFinal,0,0); // -> Variable Ingreso en el Hogar

$pdf->Rect(5,35,110,50,'D');
$pdf->SetXY(118,25);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','',12);
$pdf->Cell(88,10,utf8_decode('Datos demográficos'),1,1,'L',true);
$pdf->Image('../images/'.$datoEDO.'.png',125,42,10,10);
$pdf->Image('../images/habitantes0.png',155,42,10,10);
$pdf->Image('../images/hogares0.png',185,42,10,10);
$pdf->SetXY(118,51);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(25,3,utf8_decode($datosPerfil[1]),0,'C',false); // Variable de Estado
$pdf->SetXY(145,50);
$pdf->Cell(30,8,number_format($datosDemograficos[0]),0,0,'C'); // Variables Habitantes
$pdf->SetXY(180,50);
$pdf->Cell(20,8,number_format($datosDemograficos[1]),0,0,'C');
$pdf->Image('../images/nacional.png',125,60,10,10);
$pdf->Image('../images/habitantes1.png',155,60,10,10);
$pdf->Image('../images/hogares1.png',185,60,10,10);
$pdf->SetXY(125,70);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,8,'Nacional ',0,0);
$pdf->SetXY(152,70);
$pdf->Cell(20,8,number_format($datosDemograficos[2]),0,0,'C');
$pdf->SetXY(182,70);
$pdf->Cell(20,8,number_format($datosDemograficos[3]),0,0,'C');
$pdf->Rect(118,25,88,60,'D');
$pdf->SetXY(5,88);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','',12);
$pdf->Cell(201,10, utf8_decode('Distribución '.$txtNsex.' de 6 años o más').' '.$txtNgeo.'',1,1,'L',true);
$pdf->Rect(5,98,201,80,'D');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',12);
$pdf->SetXY(8,100);
$pdf->Cell(15,8,utf8_decode('Población por interés'));
$pdf->SetFont('Arial','',10);
$pdf->SetXY(8,107);
$pdf->Cell(20,8,utf8_decode('Nivel geográfico:'));
$pdf->SetXY(35,107);
$pdf->Cell(20,8,utf8_decode($datosPoblacion[0]));
$pdf->SetXY(8,112);
$pdf->Cell(20,8,utf8_decode('Sexo:'));
$pdf->SetXY(18,112);
$pdf->Cell(20,8,utf8_decode($NivelSex));

if($NivelSex=="Mujer"){
	$pdf->Image('../images/mujer.png',12,126,42,52);
}elseif($NivelSex=="Hombre"){
	$pdf->Image('../images/hombre.png',12,126,42,52);
}else{
	$pdf->Image('../images/mujer.png',8,122,20,25);
	$pdf->SetXY(35,130);
	$pdf->SetFont('Arial','',35);
	$pdf->Cell(10,8,round((float)$datosPoblacion[3]*100).'%',0,0);
	$pdf->Image('../images/hombre.png',8,150,20,25);
	$pdf->SetXY(35,160);
	$pdf->SetFont('Arial','',35);
	$pdf->Cell(10,8,round((float)$datosPoblacion[2]*100).'%',0,0);
}

$pdf->Rect(65,98,70,80,'D');
$pdf->SetXY(68,100);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,8,utf8_decode('Ingreso Mensual en el hogar'));
$pdf->Image('../images/icons/icono-ingresomedio-verde-obscuro.png',68,110,10,10);
$pdf->SetXY(78,112);
$pdf->SetFont('Arial','',8);
$pdf->Cell(15,8,utf8_decode('Entre $12,063.00 y $23,140.00'));
$pdf->SetXY(125,112);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosIngreso[1]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/icons/icono-ingresosmayor-azul-obscuro.png',68,120,10,10);
$pdf->SetXY(78,122);
$pdf->Cell(15,8,utf8_decode('Más de $23,140.00'));
$pdf->SetXY(125,122);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosIngreso[2]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/icons/icono-ingresomenor-verde-claro.png',68,130,10,10);
$pdf->SetXY(78,132);
$pdf->Cell(15,8,utf8_decode('Menos de $12,063.00'));
$pdf->SetXY(125,132);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosIngreso[0]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(68,140);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,8,utf8_decode('Ocupación'));
$pdf->Image('../images/icons/icono-trabaja-verde-obscuro.png',68,150,10,10);
$pdf->SetXY(78,152);
$pdf->SetFont('Arial','',8);
$pdf->Cell(15,8,utf8_decode('Trabaja'));
$pdf->SetXY(90,152);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosOcupacion[2]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/icons/icono-hogar-azul-claro.png',70,165,10,10);
$pdf->SetXY(80,167);
$pdf->Cell(15,8,utf8_decode('Hogar'));
$pdf->SetXY(90,167);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosOcupacion[0]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/icons/icono-estudiante-verde-claro.png',100,150,10,10);
$pdf->SetXY(110,152);
$pdf->Cell(15,8,utf8_decode('Estudia'));
$pdf->SetXY(125,152);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosOcupacion[1]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/icons/icono-no-trabaja-azul-obscuro.png',100,165,10,10);
$pdf->SetXY(110,167);
$pdf->Cell(15,8,utf8_decode('No Trabaja'));
$pdf->SetXY(125,167);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosOcupacion[3]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
// Sección Nivel Educativo
$pdf->SetXY(138,100);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,8,utf8_decode('Nivel Educativo'));
$pdf->Image('../images/icons/icono-educacion-basica-verde-obscuro.png',138,110,10,10);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(148,112);
$pdf->Cell(10,8,utf8_decode('Básico'));
$pdf->SetXY(158,112);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEducacion[1]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/icons/icono-educacion-media-superior-azul-obscuro.png',168,110,10,10);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(175,112);
$pdf->Cell(10,8,utf8_decode('Media superior'));
$pdf->SetXY(195,112);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEducacion[2]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/icons/icono-educacion-superior-azul-claro.png',138,125,10,10);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(146,127);
$pdf->Cell(10,8,utf8_decode('Superior'));
$pdf->SetXY(158,127);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEducacion[3]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/icons/icono-educacion-ninguna-verde-claro.png',168,125,10,10);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(178,127);
$pdf->Cell(10,8,utf8_decode('Ninguno'));
$pdf->SetXY(195,127);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEducacion[0]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
// Seccion Edad
$pdf->SetXY(138,135);
$pdf->SetFont('Arial','',12);
$pdf->Cell(15,8,utf8_decode('Edad'));
$pdf->SetXY(138,140);
$pdf->SetFont('Arial','',8);
$pdf->Cell(8,8,utf8_decode('6-12'));
$pdf->SetXY(160,140);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEdad[0]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(138,145);
$pdf->Cell(8,8,utf8_decode('13-17'));
$pdf->SetXY(160,145);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEdad[1]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(138,150);
$pdf->Cell(8,8,utf8_decode('18-24'));
$pdf->SetXY(160,150);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEdad[2]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(138,155);
$pdf->Cell(8,8,utf8_decode('25-34'));
$pdf->SetXY(160,155);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEdad[3]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(138,160);
$pdf->Cell(8,8,utf8_decode('35-44'));
$pdf->SetXY(160,160);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEdad[4]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(138,165);
$pdf->Cell(8,8,utf8_decode('45-54'));
$pdf->SetXY(160,165);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEdad[5]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(138,170);
$pdf->Cell(8,8,utf8_decode('55-64'));
$pdf->SetXY(160,170);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEdad[6]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(170,140);
$pdf->Cell(8,8,utf8_decode('65 o más'));
$pdf->SetXY(195,140);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,5,round((float)$datosEdad[7]*100).'%',0,0,'C',true);
$pdf->SetTextColor(0,0,0);
// Seccion Penetraciones y Teledensidades
$pdf->SetXY(5,182);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','',12);
$pdf->Cell(201,10,'Penetraciones y Teledensidades',1,1,'L',true);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Image('../images/p_equipos_computo.png',45,195,20,20);
$pdf->SetXY(40,215);
$pdf->MultiCell(30,3,utf8_decode('Penetración equipos de cómputo'),0,'C');
$pdf->Image('../images/p_banda_ancha_fija.png',80,195,20,20);
$pdf->SetXY(75,215);
$pdf->MultiCell(30,3,utf8_decode('Penetración de Banda Ancha Fija'),0,'C');
$pdf->Image('../images/p_telefonia_fija.png',115,195,20,20);
$pdf->SetXY(110,215);
$pdf->MultiCell(30,3,utf8_decode('Penetración de Telefonía Fija'),0,'C');
$pdf->Image('../images/p_banda_ancha_movil.png',145,195,20,20);
$pdf->SetXY(140,215);
$pdf->MultiCell(30,3,utf8_decode('Teledensidad de Banda Ancha Móvil'),0,'C');
$pdf->Image('../images/t_telefonia_movil.png',180,195,20,20);
$pdf->SetXY(175,215);
$pdf->MultiCell(30,3,utf8_decode('Teledensidad de Telefonía Móvil'),0,'C');
$pdf->Rect(5,192,201,90,'D');
$pdf->SetFillColor(230,230,230);
$pdf->Rect(8,230,195,10,'F');
$pdf->SetFillColor(222,226,230);
$pdf->Rect(8,245,195,10,'F');
$pdf->Image('../images/nacional.png',10,245,10,10);
$pdf->SetXY(20,246);
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,8,'Nacional');
$pdf->SetXY(50,246);
$pdf->Cell(10,8,$datosTeledensidad[5]);
$pdf->SetXY(85,246);
$pdf->Cell(10,8,$datosTeledensidad[6]);
$pdf->SetXY(120,246);
$pdf->Cell(10,8,$datosTeledensidad[7]);
$pdf->SetXY(150,246);
$pdf->Cell(10,8,$datosTeledensidad[8]);
$pdf->SetXY(185,246);
$pdf->Cell(10,8,$datosTeledensidad[9]);
$pdf->Image('../images/'.$datoEDO.'.png',10,230,10,10);
$pdf->SetXY(20,231);
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,8,utf8_decode($datosPerfil[1]));
$pdf->SetXY(50,231);
$pdf->Cell(10,8,$datosTeledensidad[0]);
$pdf->SetXY(85,231);
$pdf->Cell(10,8,$datosTeledensidad[1]);
$pdf->SetXY(120,231);
$pdf->Cell(10,8,$datosTeledensidad[2]);
$pdf->SetXY(150,231);
$pdf->Cell(10,8,$datosTeledensidad[3]);
$pdf->SetXY(185,231);
$pdf->Cell(10,8,$datosTeledensidad[4]);
$pdf->SetXY(8,260);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(170,3,utf8_decode('La penetración de los servicios se calcula por cada 100 hogares. El número de hogares corresponde a los datos publicados por la CONAPO.La teledensidad de los servicios se calcula por cada 100 habitantes. El número de habitantes corresponde a los datos publicados por CONAPO.Para mayor información visita la sección de Manuales y metodologías en el Banco de Información de Telecomunicaciones https://bit.ift.org.mx'));
$pdf->Output();
echo $url = '|||php/downloadpdf.php';

?>