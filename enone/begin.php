<?php
require_once 'config.php';
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас - ENONE</title>
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
    <section id="beginner" class="course">
        <div class="course-content">
            <img src="images/eng-book.png" alt="Начальный курс">
            <div class="course-description">
                <h2>Begginer course</h2>
                <p>Наш начальный курс предназначен для тех, кто только начинает изучать английский язык. В ходе обучения вы освоите основы грамматики, фонетику и базовой лексики. Уроки включают в себя: простые диалоги, изучение алфавита, числа, дни недели и базовые фразы. Курс подходит для всех возрастов и не требует предварительной подготовки.</p>
                <a href="back.php" class="button">Записаться</a>
            </div>
        </div>
    </section>

    <section id="intermediate" class="course">
        <div class="course-content">
            <img src="images/inter.png" alt="Средний курс">
            <div class="course-description">
                <h2>Intermediate course</h2>
                <p>Средний курс предназначен для студентов, которые уже имеют базовые знания английского. Мы углубляем понимание грамматики, развиваем навыки чтения и письма, а также учим построению предложений различной сложности. Курс включает в себя обсуждение различных тем, прослушивание аудиоматериалов и взаимодействие в групповых заданиях.</p>
                <a href="back.php" class="button">Записаться</a>
            </div>
        </div>
    </section>

    <section id="advanced" class="course">
        <div class="course-content">
            <img src="images/advanced.png" alt="Продвинутый курс">
            <div class="course-description">
                <h2>Advanced course</h2>
                <p>Наш продвинутый курс для тех, кто желает улучшить свои навыки владения языком на более высоком уровне. Вы сосредоточитесь на сложных аспектах грамматики и расширении словарного запаса. Курс включает в себя анализ литературы, написание эссе и участие в дебатах. Это идеальный этап для подготовки к экзаменам и улучшения свободного общения.</p>
                <a href="back.php" class="button">Записаться</a>
            </div>
        </div>
    </section>
</main>


    <footer>
        <p>&copy; 2025 ENONE. Все права защищены.</p>
    </footer>

</body>
</html>
