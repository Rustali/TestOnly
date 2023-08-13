<?php
session_start();
require_once 'validation.php';
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Получаем данные из формы
    $login = trim($_POST['login']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    // создаем массив данных, чтобы в дальнейшем передавать его в функцию
    $data = [
        'login' => $login,
        'phone' => $phone,
        'email' => $email
    ];

    // если какое-то из полей не заполнено, то выдаем сообщение об ошибке
    if (empty($login) || empty($phone) || empty($email) || empty($password)) {
        $message = 'Пожалуйста, отметьте все поля отмеченые <span style="color: red">*</span>';
        validationError('messageEmpty', $message, $data);
        die();
    } elseif ($password !== $confirmPassword) {
        $message = "Пароли не совпадают!";
        validationError('messageConfirmPassword', $message, $data);
        die();
    }

    // проверяем логин, пароль и почту
    validationLogin($login, $data);
    validationPassword($password, $data);
    validationEmail($email, $data);


    // Подключение к базе данных
    $connection = connectToDatabase();

    // защищаем пароль
    $password = password_hash($password, PASSWORD_DEFAULT);

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

    // print_r($logins);
    // print_r($phones);
    // print_r($emails);

    // проверяем, есть ли введенные в поле регистрации логин, почта и телефон в базе данных
    if (in_array($login, $logins)) {
        $message = "Пользователь с таким логином уже существует. Пожалуйста придумайте другой логин или авторизуйтесь";
        validationError('messageError', $message, $data);
        die();
    } elseif (in_array($phone, $phones)) {
        $message = "Пользователь с таким номером телефона уже существует. Пожалуйста введите другой номер телефона или авторизуйтесь";
        validationError('messageError', $message, $data);
        die();
    }  elseif (in_array($email, $emails)) {
        $message = "Пользователь с такой эл. почтой уже существует. Пожалуйста введите другую эл. почту или авторизуйтесь";
        validationError('messageError', $message, $data);
        die();
    }
    
    // добавляем нового пользователя в БД
    $query = "INSERT INTO `users` (`id`, `login`, `phone`, `email`, `password`) VALUES (NULL, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param( 'ssss', $login, $phone, $email, $password );
    // $stmt->execute();

    // при успешном добавлении закрываем соединение с БД и перенаправляем на страницу авторизации
    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        $_SESSION['messageRegistr'] = "Регистрация успешна";
        header('Location: ../login.php');

    } else {
        echo "Ошибка при добавлении записи: " . $stmt->error;
    }

    // Закрываем соединение с базой данных
    $stmt->close();
    $connection->close();

} else {
    // если пользователь зашёл на страницу register.php, то перенаправляем его на главную страницу
    header('Location: ../main.php');
}

?>