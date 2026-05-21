<?php
require_once 'config.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <title>Запись на обучение</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f3f5fb; }
    .form-container {
      max-width: 400px;
      margin: 50px auto;
      background: white;
      padding: 24px;
      border-radius: 10px;
      box-shadow: 0 4px 12px #0001;
    }
    label { margin-top: 10px; font-weight: bold; display: block; }
    input, select, textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 14px;
      border-radius: 5px;
      border: 1px solid #bfc4db;
      font-size: 1em;
      box-sizing: border-box;
    }
    button {
      background: #567be8;
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 7px;
      font-size: 1em;
      cursor: pointer;
      font-weight: bold;
      margin-top: 8px;
    }
    .hidden { display: none; }
  </style>
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

  <div class="form-container">
    <form action="save_form.php" method="POST" autocomplete="off">
      <label for="name">Имя</label>
      <input type="text" id="name" name="name" required>

      <label for="surname">Фамилия</label>
      <input type="text" id="surname" name="surname" required>
      
      <label for="contact_method">Как с вами связаться?</label>
      <select id="contact_method" name="contact_method" required onchange="contactFieldSwitch()">
        <option value="">Выберите способ...</option>
        <option value="phone">Номер телефона</option>
        <option value="email">Почта</option>
      </select>

      <div id="phone_div" class="hidden">
        <label for="phone">Номер телефона</label>
        <input type="tel" id="phone" name="phone">
      </div>
      <div id="email_div" class="hidden">
        <label for="email">Почта</label>
        <input type="email" id="email" name="email">
      </div>

      <label for="age">Возраст</label>
      <input type="number" id="age" name="age" min="5" max="120" required>
      
      <label for="course">Желаемый курс</label>
      <select id="course" name="course" required>
        <option value="">Выберите курс...</option>
        <option value="Пробный">Пробный</option>
        <option value="Начальный">Начальный</option>
        <option value="Средний">Средний</option>
        <option value="Продвинутый">Продвинутый</option>
      </select>

      <label for="purpose">Для чего вы хотите изучить английский?</label>
      <textarea id="purpose" name="purpose" rows="3" required></textarea>

      <button type="submit">Отправить</button>
    </form>
  </div>

  <script>
    function contactFieldSwitch() {
      var method = document.getElementById('contact_method').value;
      if (method === 'phone') {
        document.getElementById('phone_div').style.display = 'block';
        document.getElementById('phone').required = true;
        document.getElementById('email_div').style.display = 'none';
        document.getElementById('email').required = false;
      } else if (method === 'email') {
        document.getElementById('email_div').style.display = 'block';
        document.getElementById('email').required = true;
        document.getElementById('phone_div').style.display = 'none';
        document.getElementById('phone').required = false;
      } else {
        document.getElementById('phone_div').style.display = 'none';
        document.getElementById('email_div').style.display = 'none';
        document.getElementById('phone').required = false;
        document.getElementById('email').required = false;
      }
    }
  </script>
</body>
</html>

