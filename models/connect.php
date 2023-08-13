<?php
function connectToDatabase() {
    $servername = "localhost"; // Имя сервера
    $username = "root"; // Имя пользователя базы данных
    $password = ""; // Пароль пользователя базы данных
    $dbname = "test_only_db"; // Имя базы данных

    // Создаем подключение
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    // Проверяем соединение
    if (!$connection) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // возвращаем подключение
    return $connection;
}
?>