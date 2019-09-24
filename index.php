<?php
    require_once './lib/PHPExcel/Classes/PHPExcel/IOFactory.php';

    // Файл xlsx
    $xls = PHPExcel_IOFactory::load(__DIR__ . '/importExample.xlsx');

    // Первый лист
    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();
    
    foreach ($sheet->toArray() as $row) {
        echo '<pre>' . $row[0] . ' : ' . $row[1] . ' : ' . $row[2] . '</pre>';
    }
?>