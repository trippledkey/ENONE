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
        <div class="wrapper">
    <h1>ENONE</h1>
    <div class="tagline">Онлайн-школа английского языка нового поколения</div>
    <div class="about">
      ENONE — это ваша дверь в современный, живой английский.<br>
      Мы делаем обучение лёгким, гибким и персонализированным. Каждое занятие — шаг навстречу мечте учиться, работать и путешествовать без языковых барьеров.<br>
      С нами прогресс заметен уже после первых уроков!
    </div>
    <div class="benefits">
      <div class="card"><strong>Гибкая система обучения —</strong> выберите комфортный формат: индивидуально, в мини-группе или полностью в своём ритме.</div>
      <div class="card"><strong>Сильные преподаватели —</strong> опытные специалисты и носители языка, которые знают, как вдохновить на результат.</div>
      <div class="card"><strong>Современная платформа —</strong> всё обучение — онлайн: интерактив, домашки, прогресс в вашем смартфоне.</div>
      <div class="card"><strong>Персональные программы —</strong> учим тому, что важно именно вам: путешествия, работа, экзамены, хобби.</div>
      <div class="card"><strong>Душевная атмосфера —</strong> английский без стресса, с поддержкой и лёгким настроением.</div>
    </div>
    <a href="courses.php" class="cta-btn">Попробовать бесплатно</a>
  </div>
    </main>

    <footer>
        <p>&copy; 2025 ENONE. Все права защищены.</p>
    </footer>

</body>
</html>
