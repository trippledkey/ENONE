<?php
require_once 'config.php';
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENONE - Онлайн школа Английского языка</title>
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

                <?php if (isLoggedIn()): ?>
                    <li><a href="profile.php">Профиль</a></li>
                    <li><a href="logout.php">Выйти</a></li>
                <?php else: ?>
                    <li><a href="login.php">Войти</a></li>
                    <li><a href="register.php">Регистрация</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Добро пожаловать в ENONE!</h1>
            <p>Изучайте английский язык с профессионалами.</p>
            <a href="courses.php" class="button">Начать обучение</a>
        </section>

        <section class="featured-courses">
            <h2>Популярные курсы</h2>
            <div class="course-grid">
              <?php
              $courses = getCourses();
              $count = 0;
              foreach ($courses as $course) {
                if ($count >= 3) break; // Выводим только первые 3 курса
                echo '<div class="course-item">';
                echo '<h3>' . htmlspecialchars($course['course_name']) . '</h3>';
                echo '<p>' . htmlspecialchars(substr($course['description'], 0, 100)) . '...</p>'; // Краткое описание
                echo '<p>Преподаватель: ' . htmlspecialchars($course['first_name'] . ' ' . $course['last_name']) . '</p>';
                echo '<a href="#" class="button">Подробнее</a>'; // Замените '#' на ссылку на страницу курса
                echo '</div>';
                $count++;
              }
              ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 ENONE. Все права защищены.</p>
    </footer>

</body>
</html>
