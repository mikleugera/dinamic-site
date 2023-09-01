<?php include "path.php"; 
      include "app/controllers/users.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Roboto&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include ("app/include/header.php"); ?>
    <div class="container reg_form">
        <form class="row justify-content-md-center" method="post" action="log.php">
            <h2 class="col-12">Авторизація</h2>
            <div class="mb-12 col-12 col-md-12 err">
                <?php include 'app/helps/errorinfo.php';?>
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <label for="formGroupExampleInput" class="form-label">Ваш почта</label>
                <input name="email" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введіть ваш email...">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <button type="submit" name='button-log' class="btn btn-secondary">Увійти</button>
                <a href="<?php echo BASE_URL . 'reg.php' ?>">Реєстрація</a>
            </div>
          </form>
    </div>
    <?php include("app/include/footer.php"); ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4541a3e9d7.js" crossorigin="anonymous"></script>
</body>  
</html>  