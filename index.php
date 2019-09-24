<?php
    require_once './lib/PHPExcel/Classes/PHPExcel/IOFactory.php';
    require_once './connection.php';

    function isChanged($article, $quantity, $price)
    {
        global $link;

        $queryResult = mysqli_query($link, "SELECT quantity, price FROM shop WHERE article = '$article'") or die('Произошла какая-то ошибка. Невозможно проверить данные');
        $queryResult = mysqli_fetch_assoc($queryResult);
        
        if ($queryResult['quantity'] != $quantity || $queryResult['price'] != $price)
            return true;
        else
            return false;
    }

    function changeValue($article, $quantity, $price)
    {
        global $link;
        mysqli_query($link, "UPDATE shop SET quantity = '$quantity', price = '$price' WHERE article = '$article'") or die('Произогла какая-то ошибка. Обновить данные не удалось');
    }

    // Файл xlsx
    $xls = PHPExcel_IOFactory::load(__DIR__ . '/importExample.xlsx');

    // Первый лист
    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();

    // foreach ($sheet->toArray() as $row) {
    //     list($article, $quantity, $price) = $row;
    //     echo '<pre>' . $article . ' : ' . $quantity . ' : ' . $price . '</pre>';

    //     if (isChanged($article, $quantity, $price))
    //     {
    //         changeValue($article, $quantity, $price);
    //     }
    //     //mysqli_query($link, "INSERT INTO shop VALUES ('$article', '$quantity', '$price')");
    // }

    $row = $sheet->toArray();

    for ($i = 1; $i < count($row); $i++)
    {
        list($article, $quantity, $price) = $row[$i];

        echo '<pre>' . $article . ' : ' . $quantity . ' : ' . $price . '</pre>';

        if (isChanged($article, $quantity, $price))
        {
            changeValue($article, $quantity, $price);
        }
    }
?>