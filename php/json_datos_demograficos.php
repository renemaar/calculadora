<?php
require 'vendor/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("datos_demograficos.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
$lastColumn = $worksheet->getHighestColumn();

$i = 0;
foreach($worksheet->getRowIterator() as $rowIndex => $row) {
    $array['e'.$i] = $worksheet->rangeToArray('A'.$rowIndex.':'.$lastColumn.$rowIndex);
    foreach ($array['e'.$i][0] as $key => $value) {
      switch ($key) {
        case '0':
          $key = 'estado'; 
          break;
        case '1':
          $key = 'hogares'; 
          break;
        case '2':
          $key = 'habitantes';
          break;
        case '3':
          $key = 'T_telefonia_movil';
        break;

        case '4':
          $key = 'T_banda_ancha_movil';
          break;

        case '5':
          $key = 'P_telefonia_fija';
          break;
          
        case '6' :
          $key = 'P_banda_ancha_fija';
          break;
          
        case '7' :
          $key = 'P_equipos_computo';
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

$data = json_encode($data,JSON_UNESCAPED_UNICODE);

echo $data;
