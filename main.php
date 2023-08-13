<?php
session_start();
require_once 'models/connect.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Страница пользователя</title>
</head>

<body>

    <h1>Страница пользователя</h1>

    <?php
    // подключаемся к БД и запрашиваем данные об авторизованном пользователе, затем заполняем поля о пользователе на странице
    $connection = connectToDatabase();
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM `users` WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param( 's', $user_id );
    $stmt->execute();
    $user = $stmt->get_result();
    $rowUser = $user->fetch_row();
    $_SESSION['rowUser'] = $rowUser;
    // var_dump($rowUser);
    $stmt->close();
    $connection->close();
    ?>

    <?php 
    // если пользователь авторизован
    if ($_SESSION['user_id']) {
    ?>
    <table>
        <tr>
            <th></th>
            <th>Данные пользователя</th>
        </tr>
        <tr>
            <td>Логин:</td>
            <td><?=$rowUser[1]?></td>
            <td><form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?=$rowUser[0]?>">
                <button type="submit" name="field" value="login">Изменить</button>
            </form></td>
            
        </tr>
        <tr>
            <td>Телефон:</td>
            <td><?=$rowUser[2]?></td>
            <td><form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?=$rowUser[0]?>">
                <button type="submit" name="field" value="phone">Изменить</button>
            </form></td>
            
        </tr>
        <tr>
            <td>Почта:</td>
            <td><?=$rowUser[3]?></td>
            <td><form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?=$rowUser[0]?>">
                <button type="submit" name="field" value="email">Изменить</button>
            </form></td>
            
        </tr>
        <tr>
            <td>Пароль:</td>
            <td>********</td>
            <td><form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?=$rowUser[0]?>">
                <button type="submit" name="field" value="password">Изменить</button>
            </form></td>
            
        </tr>
    </table>
    <form action="models/exit.php" method="POST">
        <button type="submit">Выход</button>
    </form>
    <?php } else {
        // если пользоавтель не авторизован и попал на эту страницу
    ?>
    <p>Вы не авторизованы. Авторизуйтесь или зарегистрируйтесь</p>
    <a href="login.php">Авторизация</a>
    <br>
    <a href="index.php">Регистрация</a>
    <?php } ?>

</body>

</html>