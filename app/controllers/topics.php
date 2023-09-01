<?php 
    include SITE_ROOT . '/app/database/db.php';

    $errMSG = [];

    //Додавання категорії в БД
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])) {

        $name = trim($_POST['name']);    
        $description = trim($_POST['description']);    
        
        if($name === '' || $description === '') {
            array_push($errMSG, 'Не всі поля заповнені');
        } elseif(mb_strlen($name, 'UTF8') < 2) {  
            array_push($errMSG, 'Категорія має бути більше двох символів');
        } else {
            $existence = selectOne('topics', ['name' => $name]);
            if($existence['name'] === $name) {
                array_push($errMSG, 'Така категорія в базі вже є');                   
            } else {
                $topic = [
                    'name' => $name,
                    'description' => $description, 
                ];
                $id = insert('topics', $topic);
                $topic = selectOne('topics', ['id' => $id]);    
                header('location: ' . BASE_URL . 'admin/topics/index.php');
            }
        }
    } else {
       $name = '';
       $description = '';
    }

    //Список категорій
    $topics = selectAll('topics');

    //Редагування категорії
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $topic = selectOne('topics', ['id' => $id]);
        $id = $topic['id'];
        $name = $topic['name'];
        $description = $topic['description'];
    }  
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) {

        $name = trim($_POST['name']);    
        $description = trim($_POST['description']);    
        
        if($name === '' || $description === '') {
            array_push($errMSG, 'Не всі поля заповнені');
        } elseif(mb_strlen($name, 'UTF8') < 2) {
            array_push($errMSG, 'Категорія має бути більше двох символів');  
        } else {
            $topic = [
                'name' => $name,
                'description' => $description, 
            ];
            $id = update('topics', $_POST['id'], $topic);   
            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
    }

    //Видалення категорії
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        delete('topics', $id);
        header('location: ' . BASE_URL . 'admin/topics/index.php');
    }  
