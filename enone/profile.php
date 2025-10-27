<?php
require_once 'config.php';
require_once 'functions.php';

// Проверяем, авторизован ли пользователь
if (!isLoggedIn()) {
    header("Location: login.php"); // Перенаправляем на страницу логина, если не авторизован
    exit();
}

// Получаем информацию о пользователе
$user = getUserById($_SESSION['user_id']);

// Если пользователь не найден (что маловероятно, если isLoggedIn() вернул true)
if (!$user) {
    echo "Ошибка: Пользователь не найден.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль - ENONE</title>
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
                <li><a href="profile.php">Профиль</a></li>
                <li><a href="logout.php">Выйти</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="profile">
            <h2>Профиль пользователя</h2>
            <p><strong>Имя:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
            <p><strong>Фамилия:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

            <h3>Активные курсы:</h3>
            <?php
            // Здесь нужно реализовать логику получения активных курсов для пользователя.
            // Это потребует дополнительной таблицы в базе данных, связывающей пользователей и курсы.
            // Пока что просто выведем заглушку.
            echo "<p>У вас пока нет активных курсов.</p>";
            ?>

            <h3>Ваш преподаватель:</h3>
            <?php
            // Здесь нужно реализовать логику получения преподавателя для пользователя (если он есть).
            // Это также потребует дополнительной таблицы или логики.
            // Пока что просто выведем заглушку.
            echo "<p>Преподаватель не назначен.</p>";
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 ENONE. Все права защищены.</p>
    </footer>

</body>
</html>
