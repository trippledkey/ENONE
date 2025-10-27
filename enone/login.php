<?php
require_once 'config.php';
require_once 'functions.php';

$error = ''; // Переменная для хранения сообщения об ошибке

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = escape($_POST['email']);
    $password = $_POST['password'];

    // Проверяем, заполнены ли поля
    if (empty($email) || empty($password)) {
        $error = "Пожалуйста, заполните все поля.";
    } else {
        // Ищем пользователя с таким email
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Проверяем пароль
            if (password_verify($password, $user['password'])) {
                // Авторизация успешна
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['is_admin'] = $user['is_admin']; // Сохраняем информацию о том, является ли пользователь админом
                header("Location: index.php"); // Перенаправляем на главную страницу
                exit();
            } else {
                $error = "Неверный пароль.";
            }
        } else {
            $error = "Пользователь с таким email не найден.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация - ENONE</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <div class="logo">
            <h1>EN<span style="color: #007bff;">ONE</span></h1>
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="courses.php">Курсы</a></li>
                <li><a href="teachers.php">Преподаватели</a></li>
                <li><a href="contact.php">Контакты</a></li>
                <li><a href="about.php">О нас</a></li>
                 <li><a href="login.php">Войти</a></li>
                 <li><a href="register.php">Регистрация</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="login">
            <h2>Авторизация</h2>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="login.php" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Войти</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 ENONE. Все права защищены.</p>
    </footer>

</body>
</html>




