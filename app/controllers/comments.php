<?php
include_once SITE_ROOT . '/app/database/db.php';
$commentsForAdm = selectAll('comments');

$page = isset($_GET['post']) ? $_GET['post'] : '';
$email = '';
$comment = '';
$errMSG = [];
$status = 0;
$comments = [];

//Код для форми створення коментарія
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {

    $email = trim($_POST['email']);    
    $comment = trim($_POST['comment']);    

    if($email === '' || $comment === '') {
        array_push($errMSG, 'Не всі поля заповнені');
    } elseif(mb_strlen($comment, 'UTF8') < 50) {
        array_push($errMSG, 'Коментарій має бути більше 50 символів');  
    } else {
        $user = selectOne('users', ['email' => $email]);
        if ($user['email'] == $email && $user['admin'] == 1) {
            $status = 1;            
        }

        $comment = [
            'status' => $status,
            'page' => $page,
            'email' => $email, 
            'comment' => $comment,
        ];

        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['page' => $page, 'status' => 1]);    
    }
} else {
    $email = '';
    $comment = ''; 
    $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}

//Видалення коментаря
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    delete('comments', $_GET['delete_id']);
    header('location: ' . BASE_URL . 'admin/comments/index.php'); 
}  

//Публікація коментаря
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('comments', $id, ['status' => $publish]); 
    header('location: ' . BASE_URL . 'admin/comments/index.php');
    exit();
}  

 //Редагування коментаря
 if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $comment = selectOne('comments', ['id' => $_GET['id']]);

    $id = $comment['id'];
    $email = $comment['email'];
    $content = $comment['comment'];
    $publish = $comment['status'];
}  

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {

    $email = trim($_POST['email']);    
    $content = trim($_POST['content']);       
    $publish = isset($_POST['publish']) ? 1 : 0; 

    if($content === '') {
        array_push($errMSG, 'Не всі поля заповнені');
    } elseif(mb_strlen($content, 'UTF8') < 50) {
        array_push($errMSG, 'Коментар має бути більше 50 символів');  
    } else {
        $comment = [
            'comment' => $content, 
            'status' => $publish,
        ];

        $comment = update('comments', $_POST['id'], $comment);  
        header('location: ' . BASE_URL . 'admin/comments/index.php');
    }
}