<?php 
session_start();

if ($_SESSION['user_id']) {
    header('Location: /main.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Форма регистрации</title>
</head>

<body>

    <a href="login.php">Авторизация</a>

    <h1>Форма регистрации</h1>

    <div>
        <form action="models/register.php" method="post">
            <!-- значения $_SESSION['login'], $_SESSION['email'], $_SESSION['phone'] будут вставлены в value в случае, если какое-то из 
            полей не пройдет валидацию -->

            <fieldset>
                <legend>Форма регистрации</legend>
                <p>
                    <input type="text" name="login" value="<?php echo $_SESSION['login'] ?? '' ?>">
                    <label for="login"><span style="color: red">*</span> Имя пользователя (от 2 до 100 символов, без пробелов)</label>
                </p>
                <?php 
                // если значение в поле login не пройдет валидацию, то будет сообщение об ошибке $_SESSION['messageLogin']
                if ($_SESSION['messageLogin']) {
                    echo '<p style="color: red">' . $_SESSION['messageLogin'] . '</p>';
                    unset($_SESSION['messageLogin']);
                }
                // удаляем занчение login из сессии
                unset($_SESSION['login']);
                ?>
                <p>
                    <input type="tel" name="phone"pattern="[0-9]+" value="<?php echo $_SESSION['phone'] ?? '' ?>">
                    <label for="phone"><span style="color: red">*</span>Номер телефона (введите только цифры)</label>
                </p>
                <?php 
                // удаляем занчение phone из сессии
                unset($_SESSION['phone']);
                ?>
                <p>
                    <input type="email" name="email" value="<?php echo $_SESSION['email'] ?? '' ?>">
                    <label for="email"><span style="color: red">*</span>Эл. почта</label>
                </p>
                <?php 
                // если значение в поле email не пройдет валидацию, то будет сообщение об ошибке $_SESSION['messageEmail']
                if ($_SESSION['messageEmail']) {
                    echo '<p style="color: red">' . $_SESSION['messageEmail'] . '</p>';
                    unset($_SESSION['messageEmail']);
                }
                // удаляем занчение email из сессии
                unset($_SESSION['email']);
                ?>
                <p>
                    <input type="password" name="password">
                    <label for="password"><span style="color: red">*</span>Пароль (от 8 до 100 символов, без пробелов)</label>
                </p>
                <?php 
                // если значение в поле password не пройдет валидацию, то будет сообщение об ошибке $_SESSION['messagePassword']
                if ($_SESSION['messagePassword']) {
                    echo '<p style="color: red">' . $_SESSION['messagePassword'] . '</p>';
                    unset($_SESSION['messagePassword']);
                }
                
                ?>
                <p>
                    <input type="password" name="confirmPassword">
                    <label for="confirmPassword"><span style="color: red">*</span>Подтверждение пароля</label>
                </p>
                
                <?php 
                // если значение в поле password не пройдет валидацию, то будет сообщение об ошибке $_SESSION['messageConfirmPassword']
                if ($_SESSION['messageConfirmPassword']) {
                    echo '<p style="color: red">' . $_SESSION['messageConfirmPassword'] . '</p>';
                    unset($_SESSION['messageConfirmPassword']);
                }
                
                ?>
                <p>
                    Поля отмеченные <span style="color: red">*</span> обязательны для заполнения
                </p>
                <p>
                    <button type="submit">Зарегистрироваться</button>
                </p>
                <?php 
                // если какое-то из полей не заполнено, то будет сообщение об ошибке $_SESSION['messageEmpty']
                // или если введенные почта, логин или телефон уже есть в базе данных, то будет сообщение об ошибке $_SESSION['messageError']
                if ($_SESSION['messageEmpty']) {
                    echo '<p style="color: red">' . $_SESSION['messageEmpty'] . '</p>';
                    unset($_SESSION['messageEmpty']);
                } elseif ($_SESSION['messageError']) {
                    echo '<p style="color: red">' . $_SESSION['messageError'] . '</p>';
                    unset($_SESSION['messageError']);
                }
                
                ?>
                
            </fieldset>
    
        </form>
    </div>

</body>

</html>