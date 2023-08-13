<?php
session_start();
require_once 'models/connect.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Страница изменения данных</title>
</head>

<body>

    <a href="main.php">Назад</a>

    <h1>Страница изменения данных</h1>

    <p>Внесите изменения</p>

    <?php
    // если попали на эту страницу через заполненную форму, то проверяем, какое значение необходимо изменить, и выводим определенную форму
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['id'];
    $field = $_POST['field'];
    if ($field == 'login') { ?>
    <p>Измените логин</p>
    <form action="models/updateForm.php" method="post">
        <p>Введите новый логин</p>
        <input type="hidden" name="id" value="<?=$user_id?>">
        <input type="text" name="login">
        <button type="submit">Изменить</button>
    </form>
    <?php } elseif ($field == 'phone') { ?>
    <p>Измените телефон</p>
    <form action="models/updateForm.php" method="post">
        <p>Введите новый номер телефона</p>
        <input type="hidden" name="id" value="<?=$user_id?>">
        <input type="tel" name="phone" pattern="[0-9]+">
        <button type="submit">Изменить</button>
    </form>
    <?php } elseif ($field == 'email') { ?>
    <p>Измените почту</p>
    <form action="models/updateForm.php" method="post">
        <p>Введите новую эл. почту</p>
        <input type="hidden" name="id" value="<?=$user_id?>">
        <input type="email" name="email">
        <button type="submit">Изменить</button>
    </form>
    <?php } elseif ($field == 'password') { ?>
    <p>Измените пароль</p>
    <form action="models/updateForm.php" method="post">
        <p>Введите новый пароль</p>
        <input type="hidden" name="id" value="<?=$user_id?>">
        <input type="password" name="password">
        <p>Подтвердите новый пароль</p>
        <input type="password" name="confirmPassword">
        <button type="submit">Изменить</button>
        
    </form>
    <?php }
    } else {
        // если попали на страницу не через заполненную форму
        header('Location: /main.php');
    } ?>

</body>

</html>