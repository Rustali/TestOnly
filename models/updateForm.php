<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Получаем данные из формы
    $id = $_POST['id'];
    $login = $_POST['login'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Подключение к базе данных и сохранение данных
    $connection = connectToDatabase();

    // получаем все логины, телефоны и почты из БД и добавляем их в отдельные массивы
    $queryEmail = "SELECT `login`, `phone`, `email` FROM `users`";
    $resultEmail = mysqli_query($connection, $queryEmail);

    $emails = [];
    $phones = [];
    $logins = [];

    while ($row = mysqli_fetch_row($resultEmail)) {
        $logins[] = $row[0];
        $emails[] = $row[2];
        $phones[] = $row[1];
        
    }

    // проверяем, какое значение нужно изменить, проводим валидацию, сверяем значение с БД и отправляем в БД запрос на изменение данных
    if (isset($login)) {
        $login = trim($_POST['login']);
        $len = strlen($login);
        if ($len < 2 || $len > 100) {
            die ("Длина логина должна быть от 2 до 100 символов. Логин должен быть без пробелов");
        } elseif (in_array($login, $logins)) {
            die ("Пользователь с таким логином уже существует. Пожалуйста придумайте другой логин");
        }
        $query = "UPDATE `users` SET `login` = ? WHERE `users`.`id` = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param( 'ss', $login, $id );
        $stmt->execute();
        header('Location: ../main.php');
        
    } elseif (isset($phone)) {
        if (in_array($phone, $phones)) {
            die ("Пользователь с таким номером телефона уже существует. Пожалуйста введите другой номер телефона");
        } elseif (empty($phone)) {
            die ("Поле не должно быть пустым");
        }

        $phone = trim($_POST['phone']);
        $query = "UPDATE `users` SET `phone` = ? WHERE `users`.`id` = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param( 'ss', $phone, $id );
        $stmt->execute();
        header('Location: ../main.php');
    } elseif (isset($email)) {
        if (in_array($email, $emails)) {
            die ("Пользователь с такой эл. почтой уже существует. Пожалуйста введите другую эл. почту");
        } elseif (empty($email)) {
            die ("Поле не должно быть пустым");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die ("Некорректная эл. почта");
        }
        $email = trim($_POST['email']);
        $query = "UPDATE `users` SET `email` = ? WHERE `users`.`id` = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param( 'ss', $email, $id );
        $stmt->execute();
        header('Location: ../main.php');
    } elseif (isset($password)) {
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirmPassword']);
        if ($password === $confirmPassword) {
            $len = strlen($password);
            if ($len < 8 || $len > 100) {
                die ("Длина пароля должна быть от 8 до 100 символов. Пароль должен быть без пробелов");
            } 
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE `users` SET `password` = ? WHERE `users`.`id` = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param( 'ss', $password, $id );
            $stmt->execute();
            header('Location: ../main.php');
            
        } else {
            die ("Пароли не совпадают");
        }
    }
    

    // Закрываем соединение с базой данных
    $stmt->close();
    $connection->close();

} else {
    header('Location: ../main.php');
}

?>