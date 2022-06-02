<div class="container-fluid">
  <h3 class="mt-1">Sitemap</h3>
  <div class="row container">
    <div class="col-3 ps-0 text-start">
      <h4>Main</h4>
      <a class="link-info" href="home">Home</a><br>
      <a class="link-info" href="login">Login</a><br>
      <a class="link-info" href="register">Register</a><br>
    </div>
    <div class="col-3 ps-0 text-start">
      <h4>CV</h4>
      <a class="link-info" href="cv/all">View all CVs</a><br>
      <a class="link-info" href="cv/create">Create a CV</a><br>
    </div>
    <div class="col-3 ps-0 text-start">
      <h4>JD</h4>
      <a class="link-info" href="recruit/all">View all JDs</a><br>
      <a class="link-info" href="recruit/create">Create a JD</a><br>
    </div>
    <div class="col-3 ps-0 text-start">
      <h4>Special</h4>
      <?php if (isset($_SESSION)) {
        if ($_SESSION['isLoggedIn']) {
          echo '<a class="link-info" href="user/view/'.$_SESSION['id'].'">View your profile</a><br>';
        }
        if ($_SESSION['isLoggedIn'] && $_SESSION['role'] == 'admin') {
          echo '<a class="link-info" href="admin">Manage users</a><br>';
        }
      }
      ?>
    </div>
  </div>
</div>