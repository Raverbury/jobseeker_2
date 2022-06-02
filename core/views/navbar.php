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