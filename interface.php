<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обновление данных в базе</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    
    <form method="POST" action="./load.php" enctype="multipart/form-data">
        <h1>Обновленные данных</h1>
        <P> Выберите .xlsx</P>
        <input type="file" name="file" accept=".xls, .csv, .xlsx" id="file" required>
        <label for="file">Выберите файл</label>
        <input type="submit" name="accept">
    </form>

    <script>
        var input = document.querySelector("input[type='file']");
        var label = document.querySelector("label");
        var labelVal = label.innerText;

        input.addEventListener('change', function(e)
        {
            console.log('ыыы');
            var fileName = '';
            if ( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else
                fileName = e.target.value.split( '\\' ).pop();
            if ( fileName )
                label.innerText  = fileName;
            else
                label.innerText  = labelVal;
        });
    </script>
</body>
</html>
