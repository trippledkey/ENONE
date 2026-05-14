<?php
session_start(); // Запускаем сессию в начале каждого файла где нужна работа с сессиями

// Функция для безопасного экранирования данных  для защиты от SQL-инъекций
    function escape($string) {
        global $conn;
        return $conn->real_escape_string($string);
    }


// Функция для проверки, авторизован ли пользователь
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Функция для получения информации о пользователе по ID
function getUserById($user_id) {
    global $conn;
    $user_id = escape($user_id);
    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Функция для проверки является ли пользователь админом
function isAdmin() {
    return (isLoggedIn() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1);
}

// Функция для получения списка курсов
function getCourses() {
    global $conn;
    $sql = "SELECT courses.*, teachers.first_name, teachers.last_name FROM courses LEFT JOIN teachers ON courses.teacher_id = teachers.teacher_id";
    $result = $conn->query($sql);
    $courses = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
    }
    return $courses;
}

// Функция для получения списка преподов
function getTeachers() {
    global $conn;
    $sql = "SELECT * FROM teachers";
    $result = $conn->query($sql);
    $teachers = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $teachers[] = $row;
        }
    }
    return $teachers;
}


?>
