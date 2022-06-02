<div class="container-fluid">
  <h3 class="mt-1">Sitemap</h3>
  <div class="row container">
    <div class="col-3 ps-0 text-start">
      <h4>Main</h4>
      <a href="home">Home</a><br>
      <a href="login">Login</a><br>
      <a href="register">Register</a><br>
    </div>
    <div class="col-3 ps-0 text-start">
      <h4>CV</h4>
      <a href="cv/all">View all CVs</a><br>
      <a href="cv/create">Create a CV</a><br>
    </div>
    <div class="col-3 ps-0 text-start">
      <h4>JD</h4>
      <a href="recruit/all">View all JDs</a><br>
      <a href="recruit/create">Create a JD</a><br>
    </div>
    <div class="col-3 ps-0 text-start">
      <h4>Special</h4>
      <?php if (isset($_SESSION)) {
        if ($_SESSION['isLoggedIn']) {
          echo '<a href="user/view/'.$_SESSION['id'].'">View your profile</a><br>';
        }
        if ($_SESSION['isLoggedIn'] && $_SESSION['role'] == 'admin') {
          echo '<a href="admin">Manage users</a><br>';
        }
      }
      ?>
    </div>
  </div>
</div>