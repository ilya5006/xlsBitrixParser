<?php
    if($_POST['accept'])
    {
        $log = 'admin';
        $pas = '123';

        if ($_POST['login'] == $log AND $_POST['password'] == $pas)
        {
            setcookie('isActive', true, time() + 2, '/');
            header("Location: interface.php");
            
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обновление данных в базе</title>
    <link rel="stylesheet" href="./css/main.css">
    <style>
        h1 { text-align: center; margin-bottom: 20px }
        input { align-self: center; text-align: center }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h1>Авторизация</h1>
        <input type="text" name="login" placeholder="Логин">
        <input type="password" name="password" placeholder="Пароль">
        <input type="submit" name="accept">
    </form>
</body>
</html>
