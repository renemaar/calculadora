<?php
date_default_timezone_set('America/Mexico_City');
require 'vendor/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/*Recibe datos de Ajax*/
$datosPerfil = $_POST["datosPerfil"];
$datosPoblacion = $_POST["datosPoblacion"];
$datosIngreso = $_POST["datosIngreso"];
$datosEducacion = $_POST["datosEducacion"];
$datosOcupacion = $_POST["datosOcupacion"];
$datosEdad = $_POST["datosEdad"];
$datosDemograficos = $_POST["datosDemograficos"];
$datosTeledensidad = $_POST["datosTeledensidad"];

$datosPerfil = explode(',',$datosPerfil);
$datosPoblacion = explode(',',$datosPoblacion);
$datosIngreso = explode(',',$datosIngreso);
$datosEducacion = explode(',',$datosEducacion);
$datosOcupacion = explode(',',$datosOcupacion);
$datosEdad = explode(',',$datosEdad);
$datosDemograficos = explode(',',$datosDemograficos);
$datosTeledensidad = explode(',',$datosTeledensidad);

/*Archvio excel*/
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
// Set document properties
$spreadsheet->getProperties()->setCreator('Instituto Federal de Telecomunicaciones')
        ->setLastModifiedBy('Instituto Federal de Telecomunicaciones')
        ->setTitle('Calculadora de Probabilidades TIC')
        ->setDescription('Calculadora de Probabilidades TIC')
        ->setKeywords('Calcualdora, Probabilidades')
        ->setCategory('Tecnología y ususo de Internet');
// END  Set document properties

// Arreglos de estilos
$TitleStyleArray = array(
    'font'  => array(
        'color' => array('rgb' => 'ffffff'),
        'size'  => 12,
        'name'  => 'Verdana'
    ),
	'fill'  => array(
		'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
		'color'    => ['rgb' => '375d81'],
    ),
	'alignment' => array(
		'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		'wrapText' => TRUE
     )
);
$SubTitleStyleArray = array(
    'font'  => array(
        'color' => array('rgb' => 'ffffff'),
        'size'  => 12,
        'name'  => 'Verdana'
    ),
	'fill'  => array(
		'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
		'color'    => ['rgb' => '538DD5'],
    ),
	'alignment' => array(
		'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		'wrapText' => TRUE
     )
);

$TextBoldStyleArray = array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Verdana',
		'bold' => true
    ),
	'alignment' => array(
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		'wrapText' => TRUE
     )
);
$TextStyleArray = array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Verdana'
    ),
	'alignment' => array(
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		'wrapText' => TRUE
     )
);
$TextCenterStyleArray = array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Verdana'
    ),
	'alignment' => array(
		'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
		'wrapText' => TRUE
     )
);
// END Arreglos de estilos

// Add  data Hoja Uno Datos del Perfil del Usuario
$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:F1')
        ->setCellValue('A1', 'Probabilidad de '.$datosPerfil[0])
	->getStyle('A1:E1')->applyFromArray($TitleStyleArray);

for($i=2;$i<=9;$i++){
	$spreadsheet->setActiveSheetIndex(0)->mergeCells('A'.$i.':C'.$i);
	$spreadsheet->setActiveSheetIndex(0)->mergeCells('D'.$i.':F'.$i);
}

$rowArray = ['Estado', 'Ciudad', 'Sexo', 'Edad', 'Educacion', 'Ocupación','Ingreso mensual en el hogar','Probabilidad de uso'];

$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(0)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'A2'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );
$spreadsheet->getActiveSheet(0)->getStyle('A2:A9')->applyFromArray($TextBoldStyleArray);
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D2', ucfirst($datosPerfil[1]));
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D3', ucfirst(str_replace(":",",",$datosPerfil[2])));
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D4', ucfirst($datosPerfil[3]));
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D5', ucfirst($datosPerfil[4]));
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D6', ucfirst($datosPerfil[5]));
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D7', ucfirst($datosPerfil[6]));
$spreadsheet->setActiveSheetIndex(0)->setCellValue('D8', str_replace(":",",",$datosPerfil[7]));

$spreadsheet->setActiveSheetIndex(0)->setCellValue('D9',$datosPerfil[8])->getStyle('D9')
    ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);

$spreadsheet->getActiveSheet(0)->getStyle('D2:D9')->applyFromArray($TextStyleArray);


// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Perfil de usuario');
// END Add data Hoja Uno Datos del Perfil del Usuario

// Add data Hoja Dos Datos Distribución de la población
if($datosPoblacion[0]=='Nacional'){
	$txtNegeo='a nivel Nacional';
}elseif($datosPoblacion[0]=='Estatal'){
	$txtNegeo='en '.ucfirst($datosPerfil[1]);
}elseif($datosPoblacion[0]=='Resto de la entidad'){
	$txtNegeo='en '.ucfirst($datosPerfil[1]).' resto de la entidad';
}else{
	$txtNegeo='en '.$datosPoblacion[0].', '.ucfirst($datosPerfil[1]);
}
if($datosPoblacion[1]=='Mujer'){
	$txtNsex='del total de mujeres';
}elseif($datosPoblacion[1]=='Hombre'){
	$txtNsex='del total de hombres';
}else{
	$txtNsex='de la población';
}
$spreadsheet->createSheet();
$spreadsheet->setActiveSheetIndex(1)->mergeCells('A1:N1')
        ->setCellValue('A1', 'Distribución '.$txtNsex.' de 6 años o más '.$txtNegeo)->getStyle('A1:N1')->applyFromArray($TitleStyleArray);

/*Poblacion*/
$spreadsheet->setActiveSheetIndex(1)->mergeCells('A2:D2')
        ->setCellValue('A2', 'Población por interés')->getStyle('A2:D2')->applyFromArray($SubTitleStyleArray);

for($i=3;$i<=6;$i++){
	$spreadsheet->setActiveSheetIndex(1)->mergeCells('A'.$i.':B'.$i);
	$spreadsheet->setActiveSheetIndex(1)->mergeCells('C'.$i.':D'.$i);
}
$rowArray = ['Nivel geográfico', 'Sexo', 'Hombres', 'Mujeres'];

$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'A3'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );

$columnArray = array_chunk($datosPoblacion, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'C3'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );
$spreadsheet->getActiveSheet(1)->getStyle('A3:A6')->applyFromArray($TextBoldStyleArray);
$spreadsheet->getActiveSheet(1)->getStyle('C3:C6')->applyFromArray($TextStyleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('C5:C6') ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);

/*Ingreso Mensual*/
$spreadsheet->setActiveSheetIndex(1)->mergeCells('E2:I2')->setCellValue('E2', 'Ingreso mensual en el hogar')->getStyle('E2:I2')->applyFromArray($SubTitleStyleArray);

for($i=3;$i<=5;$i++){
	$spreadsheet->setActiveSheetIndex(1)->mergeCells('E'.$i.':H'.$i);
}

$rowArray = ['Menos de $12,063.00', 'Entre $12,063,00 y $23,140.00', 'Más de $23,140.00'];

$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'E3'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );
$spreadsheet->getActiveSheet(1)->getStyle('E3:E5')->applyFromArray($TextBoldStyleArray);

$columnArray = array_chunk($datosIngreso, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'I3'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );

$spreadsheet->getActiveSheet(1)->getStyle('I3:I5')->applyFromArray($TextStyleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('I3:I5') ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);


/*Nivel educativo*/
$spreadsheet->setActiveSheetIndex(1)->mergeCells('J2:N2')->setCellValue('J2', 'Nivel educativo')->getStyle('J2:N2')->applyFromArray($SubTitleStyleArray);

for($i=3;$i<=6;$i++){
	$spreadsheet->setActiveSheetIndex(1)->mergeCells('J'.$i.':L'.$i);
	$spreadsheet->setActiveSheetIndex(1)->mergeCells('M'.$i.':N'.$i);
}
$rowArray = ['Ninguno', 'Básico', 'Media superior', 'Superior'];

$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'J3'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );
$spreadsheet->getActiveSheet(1)->getStyle('J3:J6')->applyFromArray($TextBoldStyleArray);

$columnArray = array_chunk($datosEducacion, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'M3'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );

$spreadsheet->getActiveSheet(1)->getStyle('M3:M6')->applyFromArray($TextStyleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('M3:M6') ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);

/* Ocupacion */
$spreadsheet->setActiveSheetIndex(1)->mergeCells('A8:E8')->setCellValue('A8', 'Ocuapción')->getStyle('A8:E8')->applyFromArray($SubTitleStyleArray);

for($i=9;$i<=12;$i++){
	$spreadsheet->setActiveSheetIndex(1)->mergeCells('A'.$i.':D'.$i);
}
$rowArray = ['Hogar', 'Estudia', 'Trabaja', 'No trabaja'];

$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'A9'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );
$spreadsheet->getActiveSheet(1)->getStyle('A9:A12')->applyFromArray($TextBoldStyleArray);

$columnArray = array_chunk($datosOcupacion, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'E9'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );

$spreadsheet->getActiveSheet(1)->getStyle('E9:E12')->applyFromArray($TextStyleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('E9:E12') ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);

/* Edades */
$spreadsheet->setActiveSheetIndex(1)->mergeCells('F8:J8')->setCellValue('F8', 'Edad')->getStyle('F8:J8')->applyFromArray($SubTitleStyleArray);

for($i=9;$i<=16;$i++){
	$spreadsheet->setActiveSheetIndex(1)->mergeCells('F'.$i.':I'.$i);
}
$rowArray = ['6-12 años', '13-17 años', '18-24 años', '25-34 años', '35-44 años', '45-54 años', '55-64 años', '65 años o más'];

$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'F9'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );
$spreadsheet->getActiveSheet(1)->getStyle('F9:F16')->applyFromArray($TextBoldStyleArray);

$columnArray = array_chunk($datosEdad, 1);
$spreadsheet->getActiveSheet(1)
    ->fromArray(
        $columnArray,   // The data to set
        NULL,           // Array values with this value will not be set
        'J9'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );

$spreadsheet->getActiveSheet(1)->getStyle('J9:J16')->applyFromArray($TextStyleArray);
$spreadsheet->setActiveSheetIndex(1)->getStyle('J9:J16') ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Distribución de la población');


// Add some data
/*Datos Demográficos*/
$spreadsheet->createSheet();
$spreadsheet->setActiveSheetIndex(2)->mergeCells('A1:F1')->setCellValue('A1', 'Datos demográficos')->getStyle('A1:E1')->applyFromArray($TitleStyleArray);

$spreadsheet->setActiveSheetIndex(2)->mergeCells('C2:D2')->setCellValue('C2', 'Habitantes')->getStyle('C2:D2')->applyFromArray($SubTitleStyleArray);

$spreadsheet->setActiveSheetIndex(2)->mergeCells('E2:F2')->setCellValue('E2', 'Hogares')->getStyle('E2:F2')->applyFromArray($SubTitleStyleArray);

$spreadsheet->setActiveSheetIndex(2)->mergeCells('A4:B4')->setCellValue('A4', $datosPerfil[1])->getStyle('A4:B4')->applyFromArray($TextBoldStyleArray);

$spreadsheet->setActiveSheetIndex(2)->mergeCells('C4:D4')->setCellValue('C4', $datosDemograficos[0])->getStyle('C4:D4')->applyFromArray($TextStyleArray)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED0);

$spreadsheet->setActiveSheetIndex(2)->mergeCells('E4:F4')->setCellValue('E4', $datosDemograficos[1])->getStyle('E4:F4')->applyFromArray($TextStyleArray)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED0);


$spreadsheet->setActiveSheetIndex(2)->mergeCells('A6:B6')->setCellValue('A6', 'Nacional')->getStyle('A6:B6')->applyFromArray($TextBoldStyleArray);

$spreadsheet->setActiveSheetIndex(2)->mergeCells('C6:D6')->setCellValue('C6', $datosDemograficos[2])->getStyle('C6:D6')->applyFromArray($TextStyleArray)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED0);

$spreadsheet->setActiveSheetIndex(2)->mergeCells('E6:F6')->setCellValue('E6', $datosDemograficos[3])->getStyle('E6:F6')->applyFromArray($TextStyleArray)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED0);

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Datos demográficos');


// Add some data
/*Penetraciones y teledensidades*/
$spreadsheet->createSheet();
$spreadsheet->setActiveSheetIndex(3)->mergeCells('A1:X1')->setCellValue('A1', 'Penetraciones y teledensidades')->getStyle('A1:W1')->applyFromArray($TitleStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('D2:G2')->setCellValue('D2', 'Penetración equipos de cómputo')->getStyle('D2:G2')->applyFromArray($SubTitleStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('H2:K2')->setCellValue('H2', 'Penetración de banda ancha fija')->getStyle('H2:K2')->applyFromArray($SubTitleStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('L2:O2')->setCellValue('L2', 'Penetración de telefonía fija')->getStyle('L2:O2')->applyFromArray($SubTitleStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('P2:S2')->setCellValue('P2', 'Teledensidad de banda ancha móvil')->getStyle('P2:S2')->applyFromArray($SubTitleStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('T2:X2')->setCellValue('T2', 'Teledensidad de telefonía móvil')->getStyle('T2:X2')->applyFromArray($SubTitleStyleArray);


$spreadsheet->setActiveSheetIndex(3)->mergeCells('A4:B4')->setCellValue('A4', $datosPerfil[1])->getStyle('A4:B4')->applyFromArray($TextBoldStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('D4:G4')->setCellValue('D4',$datosTeledensidad[0])->getStyle('D4:G4')->applyFromArray($TextCenterStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('H4:K4')->setCellValue('H4',$datosTeledensidad[1])->getStyle('H4:K4')->applyFromArray($TextCenterStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('L4:O4')->setCellValue('L4',$datosTeledensidad[2])->getStyle('L4:O4')->applyFromArray($TextCenterStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('P4:S4')->setCellValue('P4',$datosTeledensidad[3])->getStyle('P4:S4')->applyFromArray($TextCenterStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('T4:X4')->setCellValue('T4',$datosTeledensidad[4])->getStyle('T4:X4')->applyFromArray($TextCenterStyleArray);



$spreadsheet->setActiveSheetIndex(3)->mergeCells('A6:B6')->setCellValue('A6', 'Nacional')->getStyle('A6:B6')->applyFromArray($TextBoldStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('D6:G6')->setCellValue('D6',$datosTeledensidad[5])->getStyle('D6:G6')->applyFromArray($TextCenterStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('H6:K6')->setCellValue('H6',$datosTeledensidad[6])->getStyle('H6:K6')->applyFromArray($TextCenterStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('L6:O6')->setCellValue('L6',$datosTeledensidad[7])->getStyle('L6:O6')->applyFromArray($TextCenterStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('P6:S6')->setCellValue('P6',$datosTeledensidad[8])->getStyle('P6:S6')->applyFromArray($TextCenterStyleArray);

$spreadsheet->setActiveSheetIndex(3)->mergeCells('T6:X6')->setCellValue('T6',$datosTeledensidad[9])->getStyle('T6:X6')->applyFromArray($TextCenterStyleArray);

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Penetraciones y teledensidades');



// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Xlsx)
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('../filesdownload/Calculadora_de_probabilidades_TIC.xlsx');
echo ('filesdownload/Calculadora_de_probabilidades_TIC.xlsx');
exit;
?>