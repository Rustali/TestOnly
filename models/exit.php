<?php
session_start();

// удаляем из $_SESSION данные об авторизованном пользователе
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['user_id']) {
        $_SESSION['user_id'] = '';
        header('Location: ../login.php');
    }
} else {
    header('Location: ../main.php');
}