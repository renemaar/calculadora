<?php
$datos = $_POST["data"];

$datos = explode(',',$datos);

$tic = $datos[0];
$edo = $datos[1];
$sexo = $datos[2];
$edad = $datos[3];
$estudios = $datos[4];
$ocupacion = $datos[5];
$grupo_economico = $datos[6];
$ciudad = $datos[7];


//echo $edo;


$grupo_entidad_federativa_1 = array('CHIS','GUE','HID','MICH','OAX','PUE','TAB','TLAX','VER','ZAC');
$grupo_entidad_federativa_2 = array('CAM','CHIH','DUR','GUA','MEX','MOR','NAY','SL','TAM','YU');
$grupo_entidad_federativa_3 = array('AGS','BC','BCS','COAH','COL','CDMX','JAL','NLE','QRO','QROO','SIN','SON');

if(in_array($edo,$grupo_entidad_federativa_1)){
	$grupo_entidad_federativa = "Grupo_Entidad_Federativa_1";
	//echo 'Grupo Entidad F 1';
} elseif(in_array($edo,$grupo_entidad_federativa_2)){
	$grupo_entidad_federativa = "Grupo_Entidad_Federativa_2";
	//echo 'Grupo Entidad F 2';
} elseif(in_array($edo,$grupo_entidad_federativa_3)){
	$grupo_entidad_federativa = "Grupo_Entidad_Federativa_3";
	//echo 'Grupo Entidad F 3';
}

$base = array('nivel_educativo' => 'Superior','ingreso_mensual' => 'Grupo_Economico_3','Ocupacion' => 'Hogar','Edad' => '65','Sexo' => 'hombres','grupo_entidad_federativa' => 'Grupo_Entidad_Federativa_3','ciudad' => '1');

//var_dump($datos);


$mnivel_educativo = array('Ninguna' => -1,'Basica' => -1 , 'Meida_superior' => -1 ,'Superior' => 0);
$mingreso_mensual = array('Grupo_Economico_1'=> -1,'Grupo_Economico_2' => -1,'Grupo_Economico_3' => 0);
$mocupacion = array('Trabaja' => -1,'No_trabaja' => -1,'Estudia' => -1,'Hogar' => 0);
$medad = array('13-17' => -1,'18-24' => -1,'25-34' => -1,'35-44' => -1,'45-54' => -1,'55-64' => -1,'6-12' => -1, '65' => 0);
$msexo = array('hombres' => 0, 'mujeres' => -1);
$mgrupo_entidad_federativa = array('Grupo_Entidad_Federativa_1' => -1,'Grupo_Entidad_Federativa_2' => -1,'Grupo_Entidad_Federativa_3' => 0);
$mciudad = array('1' => 0, '0' => -1);
$mintercepto = 1;


//Nivel Educativo
if($estudios == $base['nivel_educativo']){
	$mnivel_educativo['Superior'] = 0;
}
else{
	foreach ($mnivel_educativo as $key => $value) {
		$mnivel_educativo[$key] = 0;
	}
	$mnivel_educativo[$estudios] = 1;
}	


// Ingreso
if($grupo_economico == $base['ingreso_mensual']){
	$mingreso_mensual['Grupo_Economico_3'] = 0;
}
else{
	foreach ($mingreso_mensual as $key => $value) {
		$mingreso_mensual[$key] = 0;
	}
	$mingreso_mensual[$grupo_economico] = 1;
}	

//Ocupacion
if($ocupacion == $base['Ocupacion']){
	$mocupacion['Hogar'] = 0;
}
else{
	foreach ($mocupacion as $key => $value) {
		$mocupacion[$key] = 0;
	}
	$mocupacion[$ocupacion] = 1;
}	

// Edad
if($edad  == $base['Edad']){
	$medad['65'] = 0;
}
else{
	foreach ($medad as $key => $value) {
		$medad[$key] = 0;
	}
	$medad[$edad] = 1;
}	


// Sexo
if($sexo  == $base['Sexo']){
	$msexo['hombres'] = 0;
}
else{
	foreach ($msexo as $key => $value) {
		$msexo[$key] = 0;
	}
	$msexo[$sexo] = 1;
}	


// Entidad Federativa
if($grupo_entidad_federativa  == $base['grupo_entidad_federativa']){
	$mgrupo_entidad_federativa['Grupo_Entidad_Federativa_3'] = 0;
	//echo 'Es la Base';
}
else{
	//echo 'No es la Base';
	foreach ($mgrupo_entidad_federativa as $key => $value) {
		$mgrupo_entidad_federativa[$key] = 0;
	}
	$mgrupo_entidad_federativa[$grupo_entidad_federativa] = 1;
}	



// Ciudad
/*
1 = 49 Ciudades
0 = Resto de la Entidad

 */
if($ciudad == $base['ciudad']){
	$mciudad['1'] = 0;
}
else{
	foreach ($mciudad as $key => $value) {
		$mciudad[$key] = 0;
	}
	$mciudad[$ciudad] = 1;
}	


$data_array[] = array();

array_push($data_array, $mnivel_educativo,$mingreso_mensual,$mocupacion,$medad,$msexo,$mgrupo_entidad_federativa,$mciudad);

//var_dump($datos);
//var_dump($data_array);

require 'vendor/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("parametros_y_listas.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
$lastColumn = $worksheet->getHighestColumn();

$i = 0;
foreach($worksheet->getRowIterator() as $rowIndex => $row) {
    $array['e'.$i] = $worksheet->rangeToArray('A'.$rowIndex.':'.$lastColumn.$rowIndex);
    foreach ($array['e'.$i][0] as $key => $value) {
      switch ($key) {
        case '0':
          $key = 'variable'; 
          break;
        case '1':
          $key = 'uso_computadora'; 
          break;
        case '2':
          $key = 'uso_internet';
          break;
        case '3':
          $key = 'uso_celular';
        break;

        case '4':
          $key = 'internet_smartphone';
          break;

        case '5':
          $key = 'compras_internet';
          break;
          
        case '6' :
          $key = 'pagos_internet';
          break;
          
        case '7' :
          $key = 'banco_internet';
          break;
        case '8' :
          $key = 'gobierno_internet';
          break;
        default:
         
          break;
      }
      $array['e'.$i][$key] = $value;
      unset($array['e'.$i][0]);

    }
    $i++;
  
}

$data['data'] = $array;

//var_dump($data);

$datosexcel = array();
for ($i=0; $i < count($data['data']) ; $i++) { 
	array_push($datosexcel,$data['data']["e".$i][$tic]);
}

//var_dump($datosexcel);

$cmn = array();

//var_dump($datosexcel);
//echo count($datosexcel); - 28
//echo $datosexcel[23];
//echo $datosexcel[24];
//echo $datosexcel[25];
$dato = (float)$datosexcel[2]*(int)$data_array[1]["Ninguna"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[3]*(int)$data_array[1]["Basica"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[4]*(int)$data_array[1]["Meida_superior"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[5]*(int)$data_array[1]["Superior"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[6]*(int)$data_array[2]["Grupo_Economico_1"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[7]*(int)$data_array[2]["Grupo_Economico_2"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[8]*(int)$data_array[2]["Grupo_Economico_3"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[9]*(int)$data_array[3]["Trabaja"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[10]*(int)$data_array[3]["No_trabaja"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[11]*(int)$data_array[3]["Estudia"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[12]*(int)$data_array[3]["Hogar"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[13]*(int)$data_array[4]["13-17"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[14]*(int)$data_array[4]["18-24"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[15]*(int)$data_array[4]["25-34"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[16]*(int)$data_array[4]["35-44"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[17]*(int)$data_array[4]["45-54"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[18]*(int)$data_array[4]["55-64"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[19]*(int)$data_array[4]["6-12"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[20]*(int)$data_array[4]["65"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[21]*(int)$data_array[5]["hombres"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[22]*(int)$data_array[5]["mujeres"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[23]*(int)$data_array[6]["Grupo_Entidad_Federativa_1"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[24]*(int)$data_array[6]["Grupo_Entidad_Federativa_2"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[25]*(int)$data_array[6]["Grupo_Entidad_Federativa_3"];
array_push($cmn,$dato);

$dato = (float)$datosexcel[26]*(int)$data_array[7][1];
array_push($cmn,$dato);

$dato = (float)$datosexcel[27]*(int)$data_array[7][0];
array_push($cmn,$dato);


	


//echo (float)$datosexcel[23];
//echo (float)$datosexcel[24];
//echo (float)$datosexcel[25];


//echo (int)$data_array[6]["Grupo_Entidad_Federativa_1"];
//echo (int)$data_array[6]["Grupo_Entidad_Federativa_2"];
//echo (int)$data_array[6]["Grupo_Entidad_Federativa_3"];

//ar_dump($datosexcel);
//var_dump($data_array);


//var_dump($cmn);
$total = (float)array_sum($cmn);
$total = (float)$datosexcel[1] + (float)$total;

$porcentaje = 1/(1+exp(-$total));


//$porcentaje = round( $porcentaje * 100 ).'%';
//echo 'Indice: '.$total.'<br>';
echo $porcentaje;
