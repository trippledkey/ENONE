<?php
require_once 'config.php';
require_once 'functions.php';

$error = ''; // Переменная для хранения сообщения об ошибке

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = escape($_POST['first_name']);
    $last_name = escape($_POST['last_name']);
    $email = escape($_POST['email']);
    $password = $_POST['password'];

    // Проверяем, заполнены ли поля
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $error = "Пожалуйста, заполните все поля.";
    } else {
        // Проверяем, существует ли пользователь с таким email
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $error = "Пользователь с таким email уже зарегистрирован.";
        } else {
            // Хешируем пароль
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Добавляем пользователя в базу данных
            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                header("Location: login.php"); // Перенаправляем на страницу логина после успешной регистрации
                exit();
            } else {
                $error = "Ошибка при регистрации: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - ENONE</title>
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
        <section class="register">
            <h2>Регистрация</h2>
            <?php if ($error): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="register.php" method="post">
                <label for="first_name">Имя:</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">Фамилия:</label>
                <input type="text" id="last_name" name="last_name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Зарегистрироваться</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 ENONE. Все права защищены.</p>
    </footer>

</body>
</html>
