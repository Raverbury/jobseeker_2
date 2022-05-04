<div class="container">
  <h1>Administration - Users management</h1>
  <div class="container">
    <h2>Add a user</h2>
    <form name="registerForm" class="bg-light p-2" onsubmit="return validateForm()" action="admin/addUser" method="post">
		<div class="m-1 form-group">
			<label for="username">Username:</label>
			<input type="text" id="username" class="form-control" name="username">
		</div>
		<div class="m-1 form-group">
			<label for="password">Password:</label>
			<input type="password" id="password" class="form-control" name="password">
		</div>
		<div class="m-1 form-group">
			<label for="retypePassword">Retype your password:</label>
			<input type="password" id="retypePassword" class="form-control" name="retypePassword">
		</div>
		<div class="m-1 form-group">
			<label for="role">Role:</label>
			<select id="role" class="form-select" name="role">
				<option value="candidate">Candidate</option>
				<option value="employer">Employer</option>
        <option value="admin">Admin</option>
			</select>
		</div>
		<input class="btn btn-primary m-1" type="submit">
	</form>
  </div>
  <div class="container">
    <h2>Users</h2>
    <table class="table table-responsive-md table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Role</th>
        </tr>
      </thead>
      <tbody>
        <?php
        for ($i = 0; $i < count($users[0]); $i++) {
          echo '<tr>
            <td>' . $users[0][$i] . '</td>
            <td>' . $users[1][$i] . '</td>
            <td>' . $users[2][$i] . '</td>
            </tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
      <?php
      if ($currentPage == 1) echo '<li class="page-item disabled">';
      else echo '<li class="page-item">';
      ?>
      <a class="page-link" href="admin/viewAllUsers?page=<?php echo $currentPage - 1 ?>" tabindex="-1">Previous</a>
      </li>
      <?php
      $minCells = $numOfPages;
      if ($minCells > 5) $minCells = 5;
      $leftDist = $currentPage - 1;
      $rightDist = $numOfPages - $currentPage;
      $leftHalf = floor($minCells / 2);
      $rightHalf = $minCells - $leftHalf;
      if ($leftDist >= $leftHalf) {
        $startPage = $currentPage - $leftHalf;
      } else {
        $startPage = $currentPage - $leftDist;
        $rightHalf = $rightHalf + ($leftHalf - $leftDist);
      }
      if ($rightDist >= $rightHalf) {
      } else {
        $startPage = $startPage - ($rightHalf - $rightDist);
      }
      $start = $currentPage - floor($minCells / 2) - ceil($minCells / 2);
      for ($i = $startPage + 1; $i <= $minCells; $i++) {
        if ($i == $currentPage)
          echo '<li class="page-item disabled"><a class="page-link" href="admin/viewAllUsers?page=' . $i . '">' . $i . '</a></li>';
        else
          echo '<li class="page-item"><a class="page-link" href="admin/viewAllUsers?page=' . $i . '">' . $i . '</a></li>';
      }
      ?>
      <?php
      if ($currentPage == $numOfPages) echo '<li class="page-item disabled">';
      else echo '<li class="page-item">';
      ?>
      <a class="page-link" href="admin/viewAllUsers?page=<?php echo $currentPage + 1 ?>">Next</a>
      </li>
    </ul>
  </nav>
</div>

<script>
	function validateForm() {
		let usn = document.forms["registerForm"]["username"].value;
		let psw = document.forms["registerForm"]["password"].value;
    let repw = document.forms["registerForm"]["retypePassword"].value;
    if (usn.length <= 0) {
			alert("Username cannot be empty.");
			return false;
		}
		if (psw.length <= 0) {
			alert("Password cannot be empty.");
			return false;
		}
    if (repw.length <= 0) {
			alert("Repeat password cannot be empty.");
			return false;
		}
		return true;
	}
</script>