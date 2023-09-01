<?php include "../../path.php";
      include '../../app/controllers/topics.php';
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
                    <a href="<?=BASE_URL . 'admin/topics/create.php'?>" class="col-2 btn btn-success">Добавити</a>
                    <span class="col-1"></span>
                    <a href="<?=BASE_URL . 'admin/topics/index.php'?>" class="col-2 btn btn-warning">Список</a>
                </div>
                <div class="row title-table">
                    <h2>Створити категорію</h2>
                </div>
                <div class="row add-post">
                    <div class="mb-12 col-12 col-md-12 err">
                        <?php include '../../app/helps/errorinfo.php';?>
                    </div>
                    <form action="create.php" method="post">
                        <div class="col">
                            <input name='name' value="<?=$name;?>" type="text" class="form-control" placeholder="Назва категорії" aria-label="Назва категорії">
                        </div>   
                        <div class="col">
                            <label for="content" class="form-label">Опис категорії</label>
                            <textarea name='description' class="form-control" id="content" rows="6"><?=$description;?></textarea>
                        </div> 
                        <div class="col">
                            <button name='topic-create' class="btn btn-primary" type="submit">Створити категорію</button>
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