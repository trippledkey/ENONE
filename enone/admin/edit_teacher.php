<?php
require_once '../config.php';
require_once '../functions.php';

if (!isAdmin()) {
    header("Location: ../index.php");
    exit();
}

$error = '';
$success = '';

// Получаем ID преподавателя из GET параметра
if (isset($_GET['id'])) {
    $teacher_id = escape($_GET['id']);

    // Получаем информацию о преподавателе из базы данных
    $sql = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $teacher = $result->fetch_assoc();
    } else {
        echo "Преподаватель не найден.";
        exit();
    }
} else {
    echo "Не указан ID преподавателя.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = escape($_POST['first_name']);
    $last_name = escape($_POST['last_name']);
    $experience = escape($_POST['experience']);

    // Обработка загрузки нового файла (если он был загружен)
    if ($_FILES['photo']['name']) {
        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $photo_path = '../images/' . $photo;
        move_uploaded_file($photo_tmp, $photo_path);
    } else {
        // Если новый файл не загружен, используем старое имя файла
        $photo = $teacher['photo'];
    }


    if (empty($first_name) || empty($last_name) || empty($experience)) {
        $error = "Пожалуйста, заполните все поля.";
    } else {
        $sql = "UPDATE teachers SET first_name = '$first_name', last_name = '$last_name', experience = '$experience', photo = '$photo' WHERE teacher_id = '$teacher_id'";
        if ($conn->query($sql) === TRUE) {
            $success = "Преподаватель успешно обновлен.";

            // Обновляем информацию о преподавателе после успешного обновления
            $sql = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows == 1) {
                $teacher = $result->fetch_assoc();
            }


        } else {
            $error = "Ошибка при обновлении преподавателя: " . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать преподавателя</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Редактировать преподавателя</h1>
        </div>
        <nav>
