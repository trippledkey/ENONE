<?php
require_once '../config.php'; // Подключение к базе данных
require_once '../functions.php'; // Функции

// Проверка, является ли пользователь администратором
if (!isAdmin()) {
    header("Location: ../index.php"); // Перенаправление на главную страницу, если не админ
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Подключение к стилям -->
</head>
<body>
    <header>
        <div class="logo">
            <h1>Админ Панель</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="manage_courses.php">Курсы</a></li>
                <li><a href="manage_teachers.php">Преподаватели</a></li>
                <li><a href="../logout.php">Выйти</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="admin-main">
            <h2>Добро пожаловать в админ панель!</h2>
            <p>Здесь вы можете управлять контентом сайта.</p>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> ENONE. Все права защищены.</p>
    </footer>
</body>
</html>
