<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/jobseeker.localhost"/>
  <meta charset="UTF-8" />
  <title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $description; ?>" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link ref="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/g71eys72jwsqlq94poocl0kmxrk6aukoj5cwnllluhsgyat9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script src='//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js'></script>
  <script>
    tinymce.init({
      selector: 'textarea#editor',
      menubar: false
    });
  </script>
</head>

<body>

  <header>
    <?php require('navbar.php') ?>
  </header>

  <?php require('messageBox.php'); ?>

  <article class="container mt-2 mb-4">
    <?php $this->controller->renderView(); ?>
  </article>

  <footer>
    <div class="container-fluid bg-dark text-light mt-1 p-2" id="footer">
      <?php require('credits.php'); ?>
      <?php require('sitemap.php'); ?>
    </div>
  </footer>

</body>

</html>