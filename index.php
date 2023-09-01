<?php include "path.php"; 
      include 'app/controllers/topics.php';
      $page = isset($_GET['page']) ? $_GET['page'] : 1; 
      $limit = 2; 
      $offset = $limit * ($page - 1);
      $total = round(countRow('posts') / $limit, 0);
      $posts = selectAllFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset);
      $toptopics = selectTopTopicsFromPostsOnIndex('posts');
;?>

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
        <div class="row">
            <h2 class="slider-title">Tоп публікації</h2>
        </div>
        <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-inner">
                <?php foreach($toptopics as $key => $post):?>
                    <div class="carousel-item <?php if($key == 0): ?> active <?php endif?>">
                        <img src="<?= BASE_URL . 'assets/images/posts/' . $post['image'] ?>" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><a href="<?= BASE_URL . 'single.php?post=' . $post['id'] ?>"><?= $post['title'] ?></a></h5>
                        </div>
                    </div>
                <?php endforeach ?>
                </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container">
        <div class="content row">
            <div class="main-content col-md-9 col-12">
                <h2>Остання публікація</h2>
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
                <?php include ('app/include/pagination.php')?>
            </div>
            <div class="sidebar col-md-3 col-12"> 
                <div class="section search">
                    <h3>Пошук</h3>
                    <form action="search.php" method="post">
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