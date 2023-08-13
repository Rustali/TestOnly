<?php
session_start();

// функция для проверки длины пароля
function validationPassword($password, $data){
    $len = strlen($password);
    if ($len < 8 || $len > 100) {
        $_SESSION['login'] = $data['login'];
        $_SESSION['phone'] = $data['phone'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['messagePassword'] = "Длина пароля должна быть от 8 до 100 символов. Пароль должен быть без пробелов";
        header('Location: ../index.php');
        die();
    }
}

// функция для проверки длины логина
function validationLogin($login, $data){
    $len = strlen($login);
    if ($len < 2 || $len > 100) {
        $_SESSION['login'] = $data['login'];
        $_SESSION['phone'] = $data['phone'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['messageLogin'] = "Длина логина должна быть от 2 до 100 символов. Логин должен быть без пробелов";
        header('Location: ../index.php');
        die();
    }
}

// функция для проверки корректности эл. почты
function validationEmail($email, $data) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login'] = $data['login'];
        $_SESSION['phone'] = $data['phone'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['messageEmail'] = "Некорректная эл. почта";
        header('Location: ../index.php');
        die();
    }
}

// функция для вывода сообщений об ошибках. Здесь сохраняются данные о логине, пароле и телефоне, чтобы можно было их вернуть в поле input 
function validationError($key, $message, $data) {
    $_SESSION['login'] = $data['login'];
    $_SESSION['phone'] = $data['phone'];
    $_SESSION['email'] = $data['email'];
    $_SESSION[$key] = $message;
    header('Location: ../index.php');
}

?>