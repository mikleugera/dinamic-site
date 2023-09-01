<?php
    include SITE_ROOT . '/app/database/db.php'; 

    function sessionAuth($value) {
        $_SESSION['id'] = $value['id'];
        $_SESSION['login'] = $value['username'];
        $_SESSION['admin'] = $value['admin'];

        if($_SESSION['admin']){
            header('location: ' . BASE_URL . 'admin/posts/index.php'); 
        } else {
            header('location: ' . BASE_URL);
        }  
    }; 

    $errMSG = [];
    $regStatus = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
        $login = trim($_POST['login']);    
        $email = trim($_POST['email']);    
        $passF = trim($_POST['pass_first']);  
        $passS = trim($_POST['pass_second']);  
        $admin = 0; 
        
        if($login === '' || $email === '' || $passF === '') {
            array_push($errMSG, 'Не всі поля заповнені');
        } elseif(mb_strlen($login, 'UTF8') < 2) {
            array_push($errMSG, 'Логін має бути більше двох символів');  
        } elseif ($passF !== $passS) {
            array_push($errMSG, 'Паролі не співпадають'); 
        } else {
            $existence = selectOne('users', ['email' => $email]);
            if($existence['email'] === $email) {
                array_push($errMSG, 'Користувач з такою почтою вже зареєстрований');     
            } else {
                $pass = password_hash($passF, PASSWORD_DEFAULT);
                $post = [
                    'admin' => $admin,
                    'username' => $login, 
                    'email' => $email,
                    'password' => $pass
                ];
                $id = insert('users', $post);
                $user = selectOne('users', ['id' => $id]);              
                sessionAuth($user);
            }
        }
    } else {
       $login = '';
       $email = '';
    }

    //Код для форми авторизації
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
        $email = trim($_POST['email']);    
        $pass = trim($_POST['password']);

        if(!isset($_SESSION['attempt'])){
			$_SESSION['attempt'] = 0;
		}


        if ($email === '' || $pass === '') {
            array_push($errMSG, 'Не всі поля заповнені');           
        } else {
            $existence = selectOne('users', ['email' => $email]);  
            if($existence && password_verify($pass, $existence['password'])) {
                sessionAuth($existence);
                unset($_SESSION['attempt']);
            } else {
                array_push($errMSG, 'Почта або пароль введені невірно'); 
                $_SESSION['attempt'] += 1; 
                if($_SESSION['attempt'] == 3){
                    $_SESSION['attempt_again'] = time() - 30;
                    exit();
                }  
            } 
        }    
    } else {
        $email = '';
    }
    
    //Додавання користувача в адмін панелі 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user-create'])) {

        $login = trim($_POST['login']);    
        $email = trim($_POST['email']);    
        $passF = trim($_POST['password_first']);  
        $passS = trim($_POST['password_second']);  
        $admin = 0;
        
        if($login === '' || $email === '' || $passF === '') {
            array_push($errMSG, 'Не всі поля заповнені');
        } elseif(mb_strlen($login, 'UTF8') < 2) {
            array_push($errMSG, 'Логін має бути більше двох символів');  
        } elseif ($passF !== $passS) {
            array_push($errMSG, 'Паролі не співпадають'); 
        } else {
            $existence = selectOne('users', ['email' => $email]);
            if($existence['email'] === $email) {
                array_push($errMSG, 'Користувач з такою почтою вже зареєстрований');     
            } else {
                $pass = password_hash($passF, PASSWORD_DEFAULT);
                if(isset($_POST['rule'])) $admin = 1;
                $user = [
                    'admin' => $admin,
                    'username' => $login, 
                    'email' => $email,
                    'password' => $pass
                ];
                $id = insert('users', $user);
                $user = selectOne('users', ['id' => $id]);              
                sessionAuth($user);
            }
        }
    } else {
       $login = '';
       $email = '';
    }

    //Список всіх користувачів
    $users = selectAll('users');

    //Видалення користувача
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
        delete('users', $_GET['delete_id']);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    } 

    //Редагування користувача
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $user = selectOne('users', ['id' => $_GET['id']]);

        $id = $user['id'];
        $username = $user['username'];
        $email = $user['email'];
        $admin = $user['admin'];
    }  
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user-update'])) {

        $id = $_POST['id'];
        $username = trim($_POST['username']);    
        $email = trim($_POST['email']);    
        $passF = trim($_POST['password_first']);    
        $passS = trim($_POST['password_second']);    
        $admin = isset($_POST['admin']) ? 1 : 0; 

        if($username === '') {
            array_push($errMSG, 'Не всі поля заповнені');
        } elseif(mb_strlen($username, 'UTF8') < 7) {
            array_push($errMSG, 'Логін має бути більше семи символів');  
        } elseif ($passF !== $passS) {
            array_push($errMSG, 'Паролі не співпадають'); 
        } else {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if(isset($_POST['rule'])) $admin = 1;
            $user = [
                'admin' => $admin,
                'username' => $username, 
                'password' => $pass
            ];

            $user = update('users', $_POST['id'], $user);  
            header('location: ' . BASE_URL . 'admin/users/index.php');
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
        $id = $_GET['pub_id'];
        $publish = $_GET['publish'];

        $postId = update('posts', $id, ['status' => $publish]); 
        header('location: ' . BASE_URL . 'admin/posts/index.php');
        exit();
    }  