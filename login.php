<?php 
session_start();
// если пользователь уже авторизован, то перенаправляем его на главную страницу
if ($_SESSION['user_id']) {
    header('Location: /main.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
    <title>Авторизация</title>
</head>

<body>

    <a href="index.php">Регистрация</a>

    <h1>Авторизация</h1>

    <div>
        <?php 
            // если пользователь попал на эту страницу после регистрации, то выводим сообщение об успешной регистрации
            if ($_SESSION['messageRegistr']) {
                echo '<p style="color: red">' . $_SESSION['messageRegistr'] . '</p>';
                unset($_SESSION['messageRegistr']);
            }
            
        ?>
        <form action="models/auth.php" method="post">

            <fieldset>
                <legend>Авторизация</legend>

                <p>
                    <input type="text" name="phoneEmail" value="<?php echo $_SESSION['phoneEmail'] ?? '' ?>">
                    <!-- если значения на этой странице не прошли валидацию, то они сохраняются и возвращаются в поля через $_SESSION,
                а затем удаляются из $_SESSION -->
                    <?php unset($_SESSION['phoneEmail']) ?>
                    <label for="phoneEmail"><span style="color: red">*</span>Номер телефона или эл. почта</label>
                </p>
                <?php 
                // если значение в поле phoneEmail не пройдет валидацию, то будет сообщение об ошибке $_SESSION['wrongEmailPhone']
                if ($_SESSION['wrongEmailPhone']) {
                    echo '<p style="color: red">' . $_SESSION['wrongEmailPhone'] . '</p>';
                    unset($_SESSION['wrongEmailPhone']);
                }
                
                ?>
                <p>
                    <input type="password" name="password">
                    <label for="password"><span style="color: red">*</span>Пароль</label>
                </p>
                <?php 
                // если значение в поле password не пройдет валидацию, то будет сообщение об ошибке $_SESSION['wrongPassword']
                if ($_SESSION['wrongPassword']) {
                    echo '<p style="color: red">' . $_SESSION['wrongPassword'] . '</p>';
                    unset($_SESSION['wrongPassword']);
                }
                
                ?>
                <p>
                    <button type="submit">Войти</button>
                </p>
                <?php 
                // если поля были пустыми, то выводится сообщение об ошибке
                if ($_SESSION['messageEmpty']) {
                    echo '<p style="color: red">' . $_SESSION['messageEmpty'] . '</p>';
                    unset($_SESSION['messageEmpty']);
                }
                
                ?>
                <div
                id="captcha-container"
                class="smart-captcha"
                data-sitekey="<ключ_клиента>"
                >
                    <input type="hidden" name="smart-token" value="">
                
                </div>
                <?php 
                // если не была поставлена галочка "я не робот", то выводится сообщение об ошибке
                if ($_SESSION['messageToken']) {
                    echo '<p style="color: red">' . $_SESSION['messageToken'] . '</p>';
                    unset($_SESSION['messageToken']);
                }
                
                ?>
            </fieldset>
    
        </form>
    </div>

</body>

</html>