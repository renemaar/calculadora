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

// Inicia el CSV
$spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Probabilidad de '.$datosPerfil[0]);

$rowArray = ['Estado', 'Ciudad', 'Sexo', 'Edad', 'Educacion', 'Ocupación','Ingreso mensual en el hogar','Probabilidad de uso'];

$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(0)
    ->fromArray(
        $columnArray,  
        NULL,          
        'A2'           
        );
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B2', ucfirst($datosPerfil[1]));
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B3', ucfirst(str_replace(":",",",$datosPerfil[2])));
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B4', ucfirst($datosPerfil[3]));
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B5', ucfirst($datosPerfil[4]));
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B6', ucfirst($datosPerfil[5]));
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B7', ucfirst($datosPerfil[6]));
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B8', str_replace(":",",",$datosPerfil[7]));
$spreadsheet->setActiveSheetIndex(0)->setCellValue('B9',$datosPerfil[8])
            ->getStyle('B9')
            ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);

$spreadsheet->getActiveSheet(0)->getStyle('D2:D9')->applyFromArray($TextStyleArray);

//Datos de la poblacion
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

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A11','Distribución '.$txtNsex.' de 6 años o más '.$txtNegeo);
// Datos de poblacion por interes
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A12','Poblacion por interés');
$rowArray = ['Nivel geográfico', 'Sexo', 'Hombres', 'Mujeres'];
$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(1)
            ->fromArray(
                $columnArray,  
                NULL,          
                'A13'            
                );
$columnArray = array_chunk($datosPoblacion, 1);
$spreadsheet->getActiveSheet(1)
            ->fromArray(
                $columnArray,
                NULL,          
                'B13'                       
            );
$spreadsheet->setActiveSheetIndex(0)->getStyle('B15:B16')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
//Ingreso Mensual
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C12','Ingreso mensual en el hogar');
$rowArray = ['Menos de $12,063.00', 'Entre $12,063,00 y $23,140.00', 'Más de $23,140.00'];
$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(0)
            ->fromArray(
                $columnArray,  
                NULL,          
                'C13'          
                );
$columnArray = array_chunk($datosIngreso, 1);
$spreadsheet->getActiveSheet(0)
            ->fromArray(
                $columnArray,
                NULL,          
                'D13'          
            );
$spreadsheet->setActiveSheetIndex(0)
            ->getStyle('D13:D15')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
//Nivel Educativo
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('E12','Nivel educativo');
$rowArray = ['Ninguno', 'Básico', 'Media superior', 'Superior'];
$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(0)
            ->fromArray(
                $columnArray,   
                NULL,         
                'E13'            
                );
$columnArray = array_chunk($datosEducacion, 1);
$spreadsheet->getActiveSheet(0)
            ->fromArray(
                $columnArray,   
                NULL,          
                'F13'           
                );
$spreadsheet->getActiveSheet(0)
            ->getStyle('F13:F16')
            ->applyFromArray($TextStyleArray);
$spreadsheet->setActiveSheetIndex(0)->getStyle('F13:F16')
            ->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A18', 'Ocupación')
            ->getStyle('A18')
            ->applyFromArray($SubTitleStyleArray);
$rowArray = ['Hogar', 'Estudia', 'Trabaja', 'No trabaja'];
$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(0)
            ->fromArray(
                $columnArray,   
                NULL,          
                'A19'            
            );
$spreadsheet->getActiveSheet(0)
            ->getStyle('A19:A22')
            ->applyFromArray($TextBoldStyleArray);

$columnArray = array_chunk($datosOcupacion, 1);
$spreadsheet->getActiveSheet(0)
            ->fromArray(
                $columnArray,   
                 NULL,           
                'B19'            
                );
$spreadsheet->getActiveSheet(0)
            ->getStyle('B19:B22')
            ->applyFromArray($TextStyleArray);
$spreadsheet->setActiveSheetIndex(0)
            ->getStyle('B19:B22') 
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C18', 'Edad')
            ->getStyle('C18')
            ->applyFromArray($SubTitleStyleArray);
$rowArray = ['6-12 años', '13-17 años', '18-24 años', '25-34 años', '35-44 años', '45-54 años', '55-64 años', '65 años o más'];
$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet(0)
           ->fromArray(
                $columnArray,  
                 NULL,          
                'C19'        
            );

$spreadsheet->getActiveSheet(0)->getStyle('C19:C26')->applyFromArray($TextBoldStyleArray);
$columnArray = array_chunk($datosEdad, 1);
$spreadsheet->getActiveSheet(0)
            ->fromArray(
            $columnArray,   
            NULL,           
            'D19'           
            );
$spreadsheet->getActiveSheet(0)
            ->getStyle('D19:D26')
            ->applyFromArray($TextStyleArray);

$spreadsheet->setActiveSheetIndex(0)
            ->getStyle('D19:D26')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A28', 'Datos Demográficos')
            ->getStyle('A28')
            ->applyFromArray($SubTitleStyleArray);

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B29', 'Habitantes')
            ->getStyle('B29')
            ->applyFromArray($SubTitleStyleArray);

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C29', 'Hogares')
            ->getStyle('C29')
            ->applyFromArray($SubTitleStyleArray);

// Estado de Datos Demograficos
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A30', $datosPerfil[1])
            ->getStyle('A30')
            ->applyFromArray($TextBoldStyleArray);

// Variable de Habitantes del Edo.
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B30', $datosDemograficos[0])
            ->getStyle('B30')
            ->applyFromArray($TextStyleArray)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED0);

//Variable de Hogares del Edo
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C30', $datosDemograficos[1])
            ->getStyle('C30')
            ->applyFromArray($TextStyleArray)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED0);

// Datos Nacionales de Datos Demograficos
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A31', 'Nacional')
            ->getStyle('A31')
            ->applyFromArray($TextBoldStyleArray);

// Datos Variables de Habitantes Nacionales

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B31', $datosDemograficos[2])
            ->getStyle('B31')
            ->applyFromArray($TextStyleArray)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED0);

//Datos Variables de Hogares de Nacionales
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C31', $datosDemograficos[3])
            ->getStyle('C31')
            ->applyFromArray($TextStyleArray)
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED0);


// Datos de Penetraciones y teledensidades

// Titulo
$spreadsheet->setActiveSheetIndex(0)
             ->setCellValue('A33', 'Penetraciones y teledensidades')
             ->getStyle('A33')
             ->applyFromArray($TitleStyleArray);

// Datos de Penetracion eqipos de computo

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B34', 'Penetración equipos de cómputo')
            ->getStyle('B34')
            ->applyFromArray($SubTitleStyleArray);

// Datos de Penetracion de banda ancha

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C34', 'Penetración de banda ancha fija')
            ->getStyle('C34')
            ->applyFromArray($SubTitleStyleArray);

//Datos Penetracion de telefonia fija

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D34', 'Penetración de telefonía fija')
            ->getStyle('D34')
            ->applyFromArray($SubTitleStyleArray);

// Datos Teledensidad de Banda Ancha Movil

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('E34', 'Teledensidad de banda ancha móvil')
            ->getStyle('E34')
            ->applyFromArray($SubTitleStyleArray);

// Datos Teledensidad de Telefonia Movil

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('F34', 'Teledensidad de telefonía móvil')
            ->getStyle('F34')
            ->applyFromArray($SubTitleStyleArray);

//Dato del Edo Variable

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A35', $datosPerfil[1])
            ->getStyle('A35')
            ->applyFromArray($TextBoldStyleArray);

// Var 1 Edo
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B35',$datosTeledensidad[0])
            ->getStyle('B35')
            ->applyFromArray($TextCenterStyleArray);

// Var 2 Edo
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C35',$datosTeledensidad[1])
            ->getStyle('C35')
            ->applyFromArray($TextCenterStyleArray);

//Var 3 Edo
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D35',$datosTeledensidad[2])
            ->getStyle('D35')
            ->applyFromArray($TextCenterStyleArray);

//Var 4 Edo
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('E35',$datosTeledensidad[3])
            ->getStyle('E35')
            ->applyFromArray($TextCenterStyleArray);

//Var 5 Edo
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('F35',$datosTeledensidad[4])
            ->getStyle('F35')
            ->applyFromArray($TextCenterStyleArray);

// Nacional Penetraciones y Teledensidades

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A36', 'Nacional')
            ->getStyle('A36')
            ->applyFromArray($TextBoldStyleArray);

// Var 1 Nacional

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B36',$datosTeledensidad[5])
            ->getStyle('B36')
            ->applyFromArray($TextCenterStyleArray);

//Var 2 Nacional

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C36',$datosTeledensidad[6])
            ->getStyle('C36')
            ->applyFromArray($TextCenterStyleArray);

// Var 3 Nacional

$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D36',$datosTeledensidad[7])
            ->getStyle('D36')
            ->applyFromArray($TextCenterStyleArray);

// Var 4 Nacional
$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('E36',$datosTeledensidad[8])
            ->getStyle('E36')
            ->applyFromArray($TextCenterStyleArray);

// Var 5 Nacional


$spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('F36',$datosTeledensidad[9])
            ->getStyle('F36')
            ->applyFromArray($TextCenterStyleArray);

// Rename worksheet
$spreadsheet->getActiveSheet(0)
            ->setTitle('Calcualdora de Probabilidades');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Xlsx)
$writer = IOFactory::createWriter($spreadsheet, 'Csv');
$writer->setUseBOM(true);
$writer->save('../filesdownload/Calculadora_de_probabilidades_TIC.csv');
echo ('filesdownload/Calculadora_de_probabilidades_TIC.csv');
exit;
?>