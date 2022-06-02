<!DOCTYPE html>
<html lang="en">

<head>
	<base href="/ass.localhost" />
	<meta charset="UTF-8" />
	<title><?= 'Jobseeker' ?></title>
	<meta name="description" content="<?= 'A CV matching web app' ?>" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link ref="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/g71eys72jwsqlq94poocl0kmxrk6aukoj5cwnllluhsgyat9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	
	<script>
		tinymce.init({
			selector: 'textarea#editor',
			menubar: false
		});
	</script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js'></script><script  src="./Template/script.js"></script>
</head>

<body>

	<header>
		<nav class="navbar navbar-expand-md navbar-light bg-secondary p-2 sticky-top" id="navbar">
			<!--Static home button-->
			<div class="">
				<ul class="navbar-nav ms-2">
					<li class="nav-item">
						<a class="nav-link text-light" href="/home">JobSeeker</a>
					</li>
				</ul>
			</div>
			<!--Responsive, collapsible list of other buttons-->
			<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar_to_collapse" aria-controls="navbar_to_collapse" aria-expanded="false" aria-label="Toggle nav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar_to_collapse">
				<ul class="navbar-nav ms-2">
					<li class="nav-item">
						<?php
						if ($_SESSION['isLoggedIn']) {
							echo '<a class="nav-link text-light" href="/logout">Log out</a>';
						} else {
							echo '<a class="nav-link text-light" href="/login">Log in</a>';
						}
						?>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="/info">Info</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="/recruit">Recruit</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="/cv">CV</a>
					</li>
					<?php
					if ($_SESSION['isLoggedIn']) {
						echo '<li class="nav-item">
	        		<a class="nav-link text-light">Logged in as ' . $_SESSION['username'] . ' (#' . $_SESSION['id'] . ': ' . $_SESSION['role'] . ')</a>
      			</li>';
            if ($_SESSION['role'] == 'admin') {
            echo '<li class="nav-item">
            <a class="nav-link text-light" href="/admin">Admin</a>
      			</li>';
            }
					}
					?>
				</ul>
			</div>
		</nav>
	</header>

  
    <?php
	    if (isset($_SESSION['showMessage'])) {
        if ($_SESSION['showMessage']) {
			echo '<div class="container mt-3" id="messageBox"><div class="alert alert-'.$_SESSION['messageType'].'">' . $_SESSION['message'] . '</div></div>';
          $_SESSION['showMessage'] = false;
        }
	    }
	  ?>
  

	<article class="container mt-2 mb-4">
		<?php $this->controller->renderView(); ?>
	</article>

	<footer>
		<div class="container-fluid bg-dark text-light mt-1 p-2" id="footer">
			<h2 class="ms-5 mt-1">JobSeeker&trade; 2022</h2>
			<div class="container">
				<div class="row">
					<div class="col-6 ps-0 text-start">
						<b>Site authors:</b><br>
						Nguyễn Hoàng Cát - 1952587<br>
						Tạ Minh Huy - 1952268<br>
						Đỗ Đăng Khoa - 1952295<br>
						Huỳnh Phước Thiện - 1952463<br>
					</div>
				</div>
			</div>
		</div>
	</footer>

</body>

</html>