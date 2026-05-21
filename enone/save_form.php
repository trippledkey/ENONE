<?php


require_once 'config.php';
require_once 'functions.php';


$host = "localhost";         // имя сервера базы данных
$user = "root";              // логин MySQL (по умолчанию root)
$password = "";              // пароль MySQL (обычно пустой в XAMPP)
$database = "enone"; // имя вашей базы

$mysqli = new mysqli($host, $user, $password, $database);

// Добавьте проверку соединения:
if ($mysqli->connect_errno) {
    die("Ошибка подключения к MySQL: " . $mysqli->connect_error);
}
// Проверяем, что форма отправлена методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем и очищаем все поля
    $name = htmlspecialchars(trim($_POST['name']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $contact_method = $_POST['contact_method'];
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $age = intval($_POST['age']);
    $course = $_POST['course'];
    $purpose = htmlspecialchars(trim($_POST['purpose']));
    
    // Проверка обязательных полей
    if (
        !$name || !$surname || !$contact_method || !$age || !$course || !$purpose ||
        ($contact_method === 'phone' && !$phone) ||
        ($contact_method === 'email' && !$email)
    ) {
        echo "Пожалуйста, заполните все обязательные поля.";
        exit();
    }
    // Пример: просто покажем на экране
    echo "<h2>Спасибо за вашу заявку!</h2>";
    echo "<strong>Имя:</strong> " . $name . "<br>";
    echo "<strong>Фамилия:</strong> " . $surname . "<br>";
    echo "<strong>Как связаться:</strong> " . ($contact_method === 'phone' ? "Телефон" : "Почта") . "<br>";
    if ($contact_method === 'phone') {
        echo "<strong>Телефон:</strong> " . $phone . "<br>";
    } else {
        echo "<strong>Почта:</strong> " . $email . "<br>";
    }
    echo "<strong>Возраст:</strong> " . $age . "<br>";
    echo "<strong>Желаемый курс:</strong> " . $course . "<br>";
    echo "<strong>Ваша цель:</strong> " . nl2br($purpose) . "<br>";

    // 2. Получение данных из формы (как делали ранее)
$name = $_POST['name'];
$surname = $_POST['surname'];
$contact_method = $_POST['contact_method'];
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$age = intval($_POST['age']);
$course = $_POST['course'];
$purpose = $_POST['purpose'];

// 3. Запись в базу данных (используем подготовленный запрос)
$stmt = $mysqli->prepare("INSERT INTO form_submissions 
    (name, surname, contact_method, phone, email, age, course, purpose) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisss", $name, $surname, $contact_method, $phone, $email, $age, $course, $purpose);

if ($stmt->execute()) {
    echo "Ваша заявка успешно сохранена!";
} else {
    echo "Ошибка при сохранении: " . $stmt->error;
}
$stmt->close();
$mysqli->close();
}   

