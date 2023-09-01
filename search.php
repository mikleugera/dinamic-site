<?php include "path.php"; 
      include SITE_ROOT . '/app/database/db.php';
      if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])) {
        $posts = search($_POST['search-term'], 'posts', 'users');  
      }
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
    <div class="container">
        <div class="content row">
            <div class="main-content col-12">
                <h2>Результат пошуку</h2>
                <?php foreach($posts as $post): ?>
                    <div class="post row">
                        <div class="img col-12 col-md-4">
                            <img src="<?= BASE_URL . 'assets/images/posts/' . $post['image'] ?>" alt="" class="img-thumbnail">
                        </div> 
                        <div class="post_text col-12 col-md-8">
                            <h3>
                                <a href="<?= BASE_URL . 'single.php?post=' . $post['id'] ?>">
                                        <?php if(strlen(substr($post['title'], 0, 80)) < 80): ?> 
                                            <?= $post['title'] ?> 
                                        <?php else: ?> 
                                            <?= substr($post['title'], 0, 80) . '...' ?>
                                        <?php endif ?>
                                </a>
                            </h3>
                            <i class="fa-solid fa-user"> <?= $post['username'] ?></i>
                            <i class="fa-solid fa-calendar"> <?= $post['create_date'] ?></i>
                            <p class="preview-text">
                                <?= substr($post['content'], 0, 55) . '...' ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach?>
            </div>
        </div>
    </div>
    <?php include("app/include/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4541a3e9d7.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script> -->
</body>

</html>