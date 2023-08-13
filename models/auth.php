<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // определяем значения для ЯндексКапчи, $serverKey получаем в личном кабинете ЯндексОблака
    $serverKey = '<ключ_сервера>';
    define('SMARTCAPTCHA_SERVER_KEY', $serverKey);

    // Получаем данные из формы
    $phoneEmail = trim($_POST['phoneEmail']);
    $password = trim($_POST['password']);
    $token = $_POST['smart-token'];

    // если какое-то поле пустое или если не проставили галочку на "Я не робот", то показываем сообщение об ошибке
    if (empty($phoneEmail) || empty($password)) {
        $_SESSION['messageEmpty'] = 'Пожалуйста, отметьте все поля отмеченые <span style="color: red">*</span>';
        $_SESSION['phoneEmail'] = $phoneEmail;
        header('Location: /login.php');
        die();
    } elseif (empty($token)) {
        $_SESSION['phoneEmail'] = $phoneEmail;
        $_SESSION['messageToken'] = "Нажмите 'Я не робот'";
        header('Location: ../login.php');
    }

    // функция для проверки токена при авторизации
    function check_captcha($token) {
        $ch = curl_init();
        $args = http_build_query([
            "secret" => SMARTCAPTCHA_SERVER_KEY,
            "token" => $token,
            "ip" => $_SERVER['REMOTE_ADDR'], // Нужно передать IP-адрес пользователя.
                                             // Способ получения IP-адреса пользователя зависит от вашего прокси.
        ]);
        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($httpcode !== 200) {
            echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
            return true;
        }
        $resp = json_decode($server_output);
        return $resp->status === "ok";
    }

    // Подключение к базе данных
    $connection = connectToDatabase();
    
    // запрашиваем телефоны и почты из БД, чтобы проверить наличие введенных при авторизации данных в БД
    $queryEmail = "SELECT `phone`, `email` FROM `users`";
    $resultEmail = mysqli_query($connection, $queryEmail);

    $emails = [];
    $phones = [];
    while ($row = mysqli_fetch_row($resultEmail)) {
        $emails[] = $row[1];
        $phones[] = $row[0];
        
    }

    // если введенные почта/телефон в базе данных есть, то сверяем пароль и полученный токен
    if (in_array($phoneEmail, $emails) || in_array($phoneEmail, $phones)) {
        $query = "SELECT password, id FROM users WHERE email = ? OR phone = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param( 'ss', $phoneEmail, $phoneEmail );
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_row();

        if (password_verify($password, $row[0]) && check_captcha($token)) {
            echo "Авторизация успешна!";
            $_SESSION['user_id'] = $row[1];
            $stmt->close();
            $connection->close();
            header('Location: ../main.php');
        } elseif (!password_verify($password, $row[0])) {
            $_SESSION['wrongPassword'] = "Неверный пароль";
            // echo "Неверный пароль";
            header('Location: ../login.php');
        }

    } else {
        $_SESSION['wrongEmailPhone'] = "Нет пользователя с таким номером телефона / эл. почтой";
        header('Location: ../login.php');
        // echo "Нет пользователя с таким номером телефона / эл. почтой";
    }


    // Закрываем соединение с базой данных
    $stmt->close();
    $connection->close();

} else {
    // если пользователь зашёл на страницу auth.php, то перенаправляем его на главную страницу
    header('Location: ../main.php');
}


?>