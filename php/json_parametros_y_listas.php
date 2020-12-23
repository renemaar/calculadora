<?php
require 'vendor/autoload.php';
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
          $key = 'uso_de_computadora'; 
          break;
        case '2':
          $key = 'uso_de_internet';
          break;
        case '3':
          $key = 'uso_de_telefono_celular';
        break;

        case '4':
          $key = 'uso_de_internet_mediante_smartphone';
          break;

        case '5':
          $key = 'compras_por_internet';
          break;
          
        case '6' :
          $key = 'pago_ por_internet';
          break;
          
        case '7' :
          $key = 'operaciones_bancarias_por_internet';
          break;
        case '8' :
          $key = 'interaccion_con_el_gobierno_por_Internet';
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

$data = json_encode($data);

echo $data;
