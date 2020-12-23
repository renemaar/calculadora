<?php
require 'vendor/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("tabla_probabilidad.xlsx");
$worksheet = $spreadsheet->getActiveSheet();
$lastColumn = $worksheet->getHighestColumn();
$i = 0;
foreach($worksheet->getRowIterator() as $rowIndex => $row) {
    $dato['dato'.$i] = $worksheet->rangeToArray('A'.$rowIndex.':'.$lastColumn.$rowIndex);
    foreach ($dato['dato'.$i][0] as $key => $value) {
      switch ($key) {
        case '0':
          $key = 'Llave'; 
          break;
        case '1':
          $key = 'Estado'; 
          break;
        case '2':
          $key = 'Sexo';
          break;
        case '3':
          $key = 'Nivel_geo';
        break;
        case '4':
          $key = 'edu_Ninguno';
          break;
        case '5':
          $key = 'edu_Basico';
          break;
        case '6' :
          $key = 'edu_Medio_Superior';
          break;
        case '7' :
          $key = 'edu_Superior';
          break;
		case '8' :
          $key = 'Ingr_Menor';
          break;
		case '9' :
          $key = 'Ingr_Medio';
          break;
		case '10' :
          $key = 'Ingr_Superior';
          break;
		case '11' :
          $key = 'Trabaja';
          break;
		case '12' :
          $key = 'No_Trabaja';
          break;
		case '13' :
          $key = 'Estudiante';
          break;
		case '14' :
          $key = 'Hogar';
          break;
		case '15' :
          $key = 're13-17';
          break;
		case '16' :
          $key = 're18-24';
          break;
		case '17' :
          $key = 're25-34';
          break;
		case '18' :
          $key = 're35-44';
          break;
		case '19' :
          $key = 're45-54';
          break;
		case '20' :
          $key = 're55-64';
          break;
		case '21' :
          $key = 're6-12';
          break;
		case '22' :
          $key = 're65+';
          break;
		case '23' :
          $key = 'Hombre';
          break;
		case '24' :
          $key = 'Mujer';
          break;
      }
      $dato['dato'.$i][$key] = $value;
      unset($dato['dato'.$i][0]);
    }
    $i++;
}

$data['dataGrph'] = $dato;

$data = json_encode($data,JSON_UNESCAPED_UNICODE);

echo $data;
?>