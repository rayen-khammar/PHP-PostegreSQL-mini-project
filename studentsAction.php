<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'autoload.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit();
}

$repo   = new StudentsRepository();
$action = $_POST['action'];

if ($action == 'add') {
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $ext      = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $filename = 'img/' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['img']['tmp_name'], $filename);
    } else {
        $filename = 'img/unknown.png';
    }

    $repo->create([
        'name'    => $_POST['name'],
        'date'    => $_POST['date'],
        'img'     => $filename,
        'section' => $_POST['section']
    ]);
    echo json_encode(['success' => true]);

} else if ($action == 'edit') {
    $repo->update($_POST['id'], [
        'name'    => $_POST['name'],
        'date'    => $_POST['date'],
        'section' => $_POST['section']
    ]);
    echo json_encode(['success' => true]);

} else if ($action == 'delete') {
    // get the image path before deleting
    $student = $repo->findById($_POST['id']);
    
    // delete the image file if it exists and is not the default
    if ($student && $student->img && $student->img != 'img/unknown.png') {
        if (file_exists($student->img)) {
            unlink($student->img);
        }
    }

    $repo->delete($_POST['id']);
    echo json_encode(['success' => true]);
}
?>