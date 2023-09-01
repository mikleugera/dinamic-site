<?php include ("path.php"); 
      include 'app/controllers/topics.php';
      $post = selectPostFromPosts('posts', 'users', $_GET['post']);
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
            <div class="main-content col-md-9 col-12">
                <h2><?= $post['title']?></h2>
                <div class="single_post row">
                    <div class="img col-12">
                        <img src="<?= BASE_URL . 'assets/images/posts/' . $post['image']?>" alt="" class="img-thumbnail">
                    </div>
                    <div class="info">
                        <i class="fa-solid fa-user"> <?= $post['username']?></i>
                        <i class="fa-solid fa-calendar"> <?= $post['create_date']?></i>
                    </div>
                    <div class="single_post_text col-12">
                        <?= $post['content']?> 
                    </div>
                    <?php include ("app/include/comments.php"); ?>
                </div>
            </div>
            <div class="sidebar col-md-3 col-12">
                <div class="section search">
                    <h3>Пошук</h3>
                    <form action="/" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Пошук...">
                    </form>
                </div>
                <div class="section topics">
                    <h3>Категорія</h3>
                    <ul>
                    <?php foreach ($topics as $key => $value): ?>
                        <li><a href="<?= BASE_URL . 'category.php?id=' . $value['id'];?>"><?=$value['name'];?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
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