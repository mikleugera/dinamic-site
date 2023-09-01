<?php include "../../path.php";
      include "../../app/controllers/posts.php";
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
    <?php include "../../app/include/header-admin.php"; ?>

    <div class="container">
        <div class="row">
            <?php include '../../app/include/sidebar-admin.php'; ?>           
            <div class="posts col-9">
                <div class="row button">
                    <a href="<?=BASE_URL . 'admin/posts/create.php'?>" class="col-2 btn btn-success">Добавити</a>
                    <span class="col-1"></span>
                    <a href="<?=BASE_URL . 'admin/posts/index.php'?>" class="col-2 btn btn-warning">Список</a>
                </div>
                <div class="row title-table">
                    <h2>Управління записами</h2>
                    <div class="col-1">ID</div>
                    <div class="col-5">Назва</div>
                    <div class="col-2">Автор</div>
                    <div class="col-4">Дія</div>
                </div>
                <?php foreach($postsADM as $key => $value): ?>
                    <div class="row post">
                        <div class="id col-1"><?= $key + 1?></div>
                        <div class="title col-5"><?= substr($value['title'], 0, 40) . '...'?></div>
                        <div class="author col-2"><?= $value['username']?></div>
                        <div class="edit col-1"><a href="edit.php?id=<?=$value['id']?>">edit</a></div>
                        <div class="delete col-1"><a href="edit.php?delete_id=<?=$value['id']?>">delete</a></div>
                        <?php if($value['status']): ?> 
                            <div class="status col-2"><a href="edit.php?publish=0&pub_id=<?=$value['id']?>">unpublish</a></div>
                        <?php else: ?>
                            <div class="status col-2"><a href="edit.php?publish=1&pub_id=<?=$value['id']?>">publish</a></div>
                        <?php endif ?>        
                    </div>
                <?php endforeach?>
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