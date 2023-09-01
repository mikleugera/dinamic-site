<?php include "../../path.php";
        include '../../app/controllers/users.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>

<body>
    <?php include("../../app/include/header-admin.php"); ?>

    <div class="container">
        <div class="row">
            <?php include '../../app/include/sidebar-admin.php'; ?> 
            <div class="posts col-9">
            <div class="row button">
                    <a href="<?=BASE_URL . 'admin/users/create.php'?>" class="col-2 btn btn-success">Добавити</a>
                    <span class="col-1"></span>
                    <a href="<?=BASE_URL . 'admin/users/index.php'?>" class="col-2 btn btn-warning">Список</a>
                </div>
                <div class="row title-table">
                    <h2>Створити користувача</h2>
                </div>
                <div class="row add-post">
                    <div class="mb-12 col-12 col-md-12 err">
                        <?php include '../../app/helps/errorinfo.php'?>
                    </div>
                    <form action="create.php" method="post">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Ваш логін</label>
                            <input name="login" value="<?= $login?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введіть ваш логін">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input name="email" value="<?= $email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input name="password_first" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Повторіть пароль</label>
                            <input name="password_second" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-check">
                            <input name="rule" class="form-check-input" type="checkbox" id="flexCheckChecked" value="1">
                            <label class="form-check-label" for="flexCheckChecked">
                                Admin?
                            </label>
                        </div> 
                        <div class="col">
                            <button name="user-create" class="btn btn-primary" type="submit">Створити</button>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("../../app/include/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4541a3e9d7.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script> -->
</body>

</html>