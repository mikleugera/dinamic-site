<?php include "../../path.php";
      include "../../app/controllers/comments.php";
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
                <div class="row title-table">
                    <h2>Редагування коментаря</h2>
                </div>
                <div class="row add-post">
                    <div class="mb-12 col-12 col-md-12 err">
                        <?php include '../../app/helps/errorinfo.php';?>
                    </div>
                    <form action="edit.php" method="post">
                        <input name='id' value="<?= $id;?>" type="hidden">
                        <div class="col mb-4">
                            <input name='email' value="<?= $email?>" readonly type="text" class="form-control" placeholder="Email" aria-label="Email">
                        </div>   
                        <div class="col">
                            <label for="editor" class="form-label">Коменатрій</label>
                            <textarea id="editor" name='content' class="form-control" rows="6"><?= $content?></textarea>
                        </div> 
                        <div class="form-check">
                            <?php if(empty($publish) && $publish == 0): ?> 
                                <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Publish
                                </label>
                            <?php else: ?>
                                <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    Publish
                                </label>
                            <?php endif;?>         
                        </div> 
                        <div class="col col-6">
                            <button name='edit_comment' class="btn btn-primary" type="submit">Зберегти запис</button>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("../../app/include/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4541a3e9d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script> -->
</body>
</html>