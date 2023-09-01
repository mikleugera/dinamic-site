<?php 
    include SITE_ROOT . '/app/database/db.php';
    if(!$_SESSION) {
        header('locetion ' . BASE_URL . 'log.php');
    }

    $errMSG = [];

    //Список постів
    $posts = selectAll('posts');
    $topics = selectAll('topics');
    $postsADM = selectAllFromPostsWithUsers('posts', 'users');

    //Додавання поста в БД
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post-create'])) {

        if(!empty($_FILES['image']['name'])) {
            $imgName = time() . '_' . $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileType = $_FILES['image']['type'];
            $destination = ROOT_PATH . '/assets/images/posts//' . $imgName;

            if (strpos($fileType, 'image') === false) {
                array_push($errMSG, 'Можна завантажувати тільки зображення');
            } elseif (filesize($fileTmpName) > 130000) {
                array_push($errMSG, 'Зображення більше 5 мегабайтів');
            } elseif (getimagesize($fileTmpName)[0] > 500 && getimagesize($fileTmpName)[1] > 500) {
                array_push($errMSG, 'Зображення поширині або повисоті більше 500 пікселів');          
            } else { 
                $result = move_uploaded_file($fileTmpName, $destination);

                if($result) {
                    $_POST['image'] = $imgName;
                } else {
                    array_push($errMSG, 'Помилка загрузки зображення на сервер');
                }
            }
        } else {
            array_push($errMSG, 'Помилка отримання зображення');       
        }

        $title = trim($_POST['title']);    
        $content = trim($_POST['content']);    
        $topic = trim($_POST['topic']);    

        $publish = isset($_POST['publish']) ? 1 : 0; 

        if($title === '' || $content === '' || $topic === '') {
            array_push($errMSG, 'Не всі поля заповнені');
        } elseif(mb_strlen($title, 'UTF8') < 7) {
            array_push($errMSG, 'Назва запису має бути більше семи символів');  
        } else {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'image' => $_POST['image'],
                'content' => $content, 
                'status' => $publish,
                'id_topic' => $topic, 
            ];

            $id = insert('posts', $post);
            $post = selectOne('posts', ['id' => $id]);    
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    } else {
       $id = ''; 
       $title = '';
       $content = '';
       $publish = '';
       $topic = '';
    }

    //Редагування поста
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $post = selectOne('posts', ['id' => $_GET['id']]);
        $id = $post['id'];
        $title = $post['title'];
        $content = $post['content'];
        $topic = $post['id_topic'];
        $publish = $post['status'];
    }  
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post-edit'])) {

        $title = trim($_POST['title']);    
        $content = trim($_POST['content']);    
        $topic = trim($_POST['topic']);    

        $publish = isset($_POST['publish']) ? 1 : 0; 

        if(!empty($_FILES['image']['name'])) {
            $imgName = time() . '_' . $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileType = $_FILES['image']['type'];
            $destination = ROOT_PATH . '/assets/images/posts//' . $imgName;

            if (strpos($fileType, 'image') === false) {
                array_push($errMSG, 'Можна завантажувати тільки зображення');
            } elseif (filesize($fileTmpName) > 130000) {
                array_push($errMSG, 'Зображення більше 5 мегабайтів');
            } elseif (getimagesize($fileTmpName)[0] > 500 && getimagesize($fileTmpName)[1] > 500) {
                array_push($errMSG, 'Зображення поширині або повисоті більше 500 пікселів');          
            } else { 
                $result = move_uploaded_file($fileTmpName, $destination);

                if($result) {
                    $_POST['image'] = $imgName;
                } else {
                    array_push($errMSG, 'Помилка загрузки зображення на сервер');
                }
            }
        } else {
            array_push($errMSG, 'Помилка отримання зображення');       
        }

        if($title === '' || $content === '' || $topic === '') {
            array_push($errMSG, 'Не всі поля заповнені');
        } elseif(mb_strlen($title, 'UTF8') < 7) {
            array_push($errMSG, 'Назва запису має бути більше семи символів');  
        } else {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'image' => $_POST['image'],
                'content' => $content, 
                'status' => $publish,
                'id_topic' => $topic, 
            ];

            $id = update('posts', $_POST['id'], $post);  
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
        $id = $_GET['pub_id'];
        $publish = $_GET['publish'];

        $postId = update('posts', $id, ['status' => $publish]); 
        header('location: ' . BASE_URL . 'admin/posts/index.php');
        exit();
    }  

    //Видалення поста
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
        delete('posts', $_GET['delete_id']);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }  
