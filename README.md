# TestOnly
Для корректной работы Yandex SmartCaptcha необходимо:
- в файле login.php строка 79, прописать data-sitekey="<ключ_клиента>" (<ключ_клиента> получить в личном кабинете Yandex SmartCaptcha);
- в файле models/auth.php строка 8б определить переменную $serverKey = '<ключ_сервера>' (<ключ_сервера> также получить в личном кабинете Yandex SmartCaptcha).
Также необходимо:
- в файле models/connect.php прописать свои $servername, $username и $password для подключения к базе данных;
- импортировать себе базу test_only_db.sql (кодировка utf8).

В проекте использовал PHP 7.2
