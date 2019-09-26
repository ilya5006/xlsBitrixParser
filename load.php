<?php
    require_once './lib/PHPExcel/Classes/PHPExcel/IOFactory.php';
    require_once './connection.php';

    if (count($_FILES) == 1)
    {
        $file = $_FILES['file']['tmp_name'];
    }

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
    $xls = PHPExcel_IOFactory::load($file);

    // Первый лист
    $xls->setActiveSheetIndex(0);
    $sheet = $xls->getActiveSheet();
    
    $row = $sheet->toArray();
    
    for ($i = 1; $i < count($row); $i++)
    {
        list($article, $quantity, $price) = $row[$i];

        if (isChanged($article, $quantity, $price))
        {
            changeValue($article, $quantity, $price);
            echo '<pre>Товар с параметрами' . $article . ' : ' . $quantity . ' : ' . $price . ' был обновлён в базе данных</pre>';
        }
    }

    $countOfRowsInDBQuery = 'SELECT COUNT(*) FROM shop';
    $countOfRowsInDBQueryResult = mysqli_query($link, $countOfRowsInDBQuery);
    $countOfRowsInDBQueryResult = mysqli_fetch_row($countOfRowsInDBQueryResult);
    $countOfRowsInDB = (int)$countOfRowsQueryResult[0];

    $countOfRowsInExcel = count($row) - 1;

    if ($countOfRowsInExcel > $countOfRowsInDB)
    {
        $logFile = fopen('logs.log', 'a') or die ('Не удалось открыть файл с логами');
        $date = Date('y-m-d H:i:s');
        $logMessage = '[' . $date . '] добавился новый товар. Вот его параметры: ' . $row[$countOfRowsInExcel][0] . ' : ' . $row[$countOfRowsInExcel][1] . ' : ' . $row[$countOfRowsInExcel][2] . "\n";
        fwrite($logFile, $logMessage);
    }

    fclose($logFile);
?>