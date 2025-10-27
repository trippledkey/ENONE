<?php
require_once 'config.php';
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Курсы - ENONE</title>
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
        <section class="courses">
            <h2>Наши курсы</h2>
            <div class="course-grid">
                <?php
                $courses = getCourses();
                foreach ($courses as $course) {
                    echo '<div class="course-item">';
                    echo '<h3>' . htmlspecialchars($course['course_name']) . '</h3>';
                    echo '<p>' . htmlspecialchars($course['description']) . '</p>';
                    echo '<p>Преподаватель: ' . htmlspecialchars($course['first_name'] . ' ' . $course['last_name']) . '</p>';
                    echo '<a href="#" class="button">Подробнее</a>'; // Замените '#' на ссылку на страницу курса
                    echo '</div>';
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
