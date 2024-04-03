<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<body class="w3-container">

<?php
    $nombrefichero = 'DiagnosticoEnfermedades.xlsx';
    $ruta="./";
    $nombrehoja="BDD";
    
    require_once('Classes/PHPExcel.php');
    require_once('Classes/PHPExcel/IOFactory.php');
    include "faux.php";

    $excelReader = PHPExcel_IOFactory::createReader('Excel2007');
    $excelReader->setLoadSheetsOnly($nombrehoja); 
    $excel = $excelReader->load($ruta.$nombrefichero);
    $hoja= $excel->getSheetByName($nombrehoja);
    echo "nombrehoja $ruta$nombrefichero<br>";
    echo $hoja->getCell('A1')->getValue()."<br>";
    echo $hoja->getHighestRow()."<br>";
    echo $hoja->getHighestColumn()."<br>";
    
    
    echo '<table class="w3-table">';
    $enfermedad="";
    
    $lpreguntas=array();
    $lenfermedades=array();
    $nfila=1;
    $ncol=1;
    $k=0;
    foreach ($hoja->getRowIterator() as $row) {
        $ncol=1;
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        if($nfila==1){
            foreach ($cellIterator as $cell) {
                if (!is_null($cell) && $ncol>1 ) {
                    $value = $cell->getCalculatedValue();
                    if($value!="Enlace" && $value!=NULL){
                        $lpreguntas[$ncol-1]=$value;
                        //echo "$value<br>";
                    }
                }
                $ncol++;
            }
        }
        else
        {
            foreach ($cellIterator as $cell) {
                if (!is_null($cell)) {
                    $value = $cell->getCalculatedValue();
                    if($ncol==1){
                        $lenfermedades[$nfila-1]=$value;
                        //echo "> $value<br>";
                    }
                    else{
                        if($ncol<=sizeof($lpreguntas)+1){
                            $e=$lenfermedades[$nfila-1];
                            $p=$lpreguntas[$ncol-1];
                            $q="insert into enfermedades values('$e','$p','$value')";
                            insertBDD($q,"vinamecum");
                            echo "$q<br>";
                            $k++;
                        }
                    }
                }
                $ncol++;
            }
        }
        $nfila++;
    }
    //var_dump($lpreguntas);
    //var_dump($lenfermedades);
    echo "</table>$k<br>";
    echo sizeof($lenfermedades)." * ".sizeof($lpreguntas)." = ".(sizeof($lenfermedades)*sizeof($lpreguntas));
?>
...
</body>