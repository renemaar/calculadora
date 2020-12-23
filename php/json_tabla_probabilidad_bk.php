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
$j = 0;
/*foreach($worksheet->getRowIterator() as $rowIndex => $row) {
    $array['dato'.$i] = $worksheet->rangeToArray('A'.$rowIndex.':'.$lastColumn.$rowIndex);
    foreach ($array['dato'.$i][0] as $key => $value) {
      switch ($key) {
        case '0':
          $key = 'llave'; 
          break;
        case '1':
          $key = 'Estado'; 
          break;
        case '2':
          $key = 'Sexo';
          break;
        case '3':
          $key = 'Ciudad';
        break;
        case '4':
          $key = 'NE_ninguno';
          break;
        case '5':
          $key = 'NE_ninguno';
          break;
        case '6' :
          $key = 'NE_básico';
          break;
        case '7' :
          $key = 'NE_medio_superior';
          break;
		case '8' :
          $key = 'NE_superior';
          break;
      }
      $array['dato'.$i][$key] = $value;
      unset($array['dato'.$i][0]);

    }
    $i++;
  
}

$data['dataGraphic'] = $array;

$data = json_encode($data,JSON_UNESCAPED_UNICODE);

echo $data;*/
foreach($worksheet->getRowIterator() as $rowIndex => $row) {
    $dato[$j] = $worksheet->rangeToArray('A'.$rowIndex.':'.$lastColumn.$rowIndex);
    foreach ($dato[$j][0] as $key => $value) {
      switch ($key) {
        case '0':
          $key = 'Estado'; 
          break;
        case '1':
          $key = 'Sexo'; 
          break;
        case '2':
          $key = 'Ciudad';
          break;
        case '3':
          $key = 'Ciudad';
        break;
        case '4':
          $key = 'NE_ninguno';
          break;
        case '5':
          $key = 'NE_báscio';
          break;
        case '6' :
          $key = 'NE_bedio_superior';
          break;
        case '7' :
          $key = 'NE_superior';
          break;
		case '8' :
          $key = 'GE_menor';
          break;
      }
      $dato[$j][$key] = $value;
      unset($dato[$j][0]);
    }
    $j++;
  
}

/*foreach($worksheet->getRowIterator() as $rowIndex => $row) {
    $dato[$j] = $worksheet->rangeToArray('B'.$rowIndex.':'.$lastColumn.$rowIndex);
    foreach ($dato[$j][0] as $key => $value) {
      switch ($key) {
        case '0':
          $key = 'Estado'; 
          break;
        case '1':
          $key = 'Sexo'; 
          break;
        case '2':
          $key = 'Ciudad';
          break;
        case '3':
          $key = 'Ciudad';
        break;
        case '4':
          $key = 'NE_ninguno';
          break;
        case '5':
          $key = 'NE_báscio';
          break;
        case '6' :
          $key = 'NE_bedio_superior';
          break;
        case '7' :
          $key = 'NE_superior';
          break;
		case '8' :
          $key = 'GE_menor';
          break;
      }
      $dato[$j][$key] = $value;
      unset($dato[$j][0]);
    }
    $j++;
  
}*/

$data['dataGraphic'] = $dato;

$data = json_encode($data,JSON_UNESCAPED_UNICODE);

echo $data;
?>