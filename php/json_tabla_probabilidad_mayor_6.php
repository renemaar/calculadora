<?php
require 'vendor/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);
$spreadsheet = $reader->load("tabla_probabilidad_mayor_6.xlsx");

$worksheet = $spreadsheet->getActiveSheet();
$value = [];
//echo '<table>' . PHP_EOL;
foreach ($worksheet->getRowIterator() as $row) {
   // echo '<tr>' . PHP_EOL;
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                                                       //    even if a cell value is not set.
                                                       // By default, only cells that have a value
                                                       //    set will be iterated.
    foreach ($cellIterator as $cell) {
       // echo '<td>' .
             //$cell->getValue();
             array_push($value,$cell->getValue());
             //'</td>' . PHP_EOL;
    }
    //echo '</tr>' . PHP_EOL;
}
//echo '</table>' . PHP_EOL;



$dataJson = json_encode($value,JSON_UNESCAPED_UNICODE);

echo $dataJson;


echo '<table>' . PHP_EOL;
foreach ($worksheet->getRowIterator() as $row) {
   echo '<tr>' . PHP_EOL;
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                                                       //    even if a cell value is not set.
                                                       // By default, only cells that have a value
                                                       //    set will be iterated.
    foreach ($cellIterator as $cell) {
      echo '<td>' .
             $cell->getValue();
             
             '</td>' . PHP_EOL;
    }
    echo '</tr>' . PHP_EOL;
}
'</table>' . PHP_EOL;




?>

