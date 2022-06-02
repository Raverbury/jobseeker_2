<div class="container">
  <h1><?php echo $_SESSION['username']; ?>'s profile</h1>
  <h2>UID: <?php echo $_SESSION['id']; ?></h2>
  <h2>Role: <?php echo $_SESSION['role']; ?></h2>
  <p>Here you can see all the information related to your account.</p>
  <h2>Your CVs</h2>
  <table class="table table-responsive-md table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">Names</th>
        <th scope="col">View</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      for ($i = 0; $i < count($cv['cvNames']); $i++) {
        echo '<tr>
        <td>' . $cv['cvNames'][$i] . '</td>
        <td><a href="cv/view/' . $cv['cvIDs'][$i] . '"><u>View</u></a></td>
        <td><a href="cv/edit/' . $cv['cvIDs'][$i] . '"><u>Edit</u></a></td>
      </tr>';
      }
      ?>
    </tbody>
  </table>
  <h2>Your JDs</h2>
  <table class="table table-responsive-md table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">Titles</th>
        <th scope="col">View</th>
      </tr>
    </thead>
    <tbody>
      <?php
      for ($i = 0; $i < count($jd['jdTitles']); $i++) {
        echo '<tr>
        <td>' . $jd['jdTitles'][$i] . '</td>
        <td><a href="recruit/view/' . $jd['jdIDs'][$i] . '"><u>View</u></a></td>
      </tr>';
      }
      ?>
    </tbody>
  </table>
  <h2>Change username</h2>
  <p></p>
  <form name="changeUNForm" class="bg-light p-2" onsubmit="return validateForm1()" action="user/changeUsername/<?php echo $_SESSION['id']; ?>" method="post">
    <div class="m-1 form-group">
      <label for="username">New username:</label>
      <input type="text" id="username" class="form-control" name="username">
    </div>
    <input class="btn btn-primary m-1" type="submit">
  </form>
  <h2>Change password</h2>
  <p></p>
  <form name="changePWForm" class="bg-light p-2" onsubmit="return validateForm2()" action="user/changePassword/<?php echo $_SESSION['id']; ?>" method="post">
    <div class="m-1 form-group">
      <label for="oldPassword">Old password:</label>
      <input type="password" id="oldPassword" class="form-control" name="oldPassword">
    </div>
    <div class="m-1 form-group">
      <label for="newPassword">New password:</label>
      <input type="password" id="newPassword" class="form-control" name="newPassword">
    </div>
    <div class="m-1 form-group">
      <label for="retypePassword">Retype your new password:</label>
      <input type="password" id="retypePassword" class="form-control" name="retypePassword">
    </div>
    <input class="btn btn-primary m-1" type="submit">
  </form>
</div>

<script>
  function validateForm1() {
    let usn = document.forms["changeUNForm"]["username"].value;
    if (usn.length <= 0) {
      alert("Username cannot be empty.");
      return false;
    }
    return true;
  }

  function validateForm2() {
    let oldPassword = document.forms["changePWForm"]["oldPassword"].value;
    let newPassword = document.forms["changePWForm"]["newPassword"].value;
    let repw = document.forms["changePWForm"]["retypePassword"].value;
    if (oldPassword.length <= 0) {
      alert("Old password cannot be empty.");
      return false;
    }
    if (newPassword.length <= 0) {
      alert("New password cannot be empty.");
      return false;
    }
    if (repw.length <= 0) {
      alert("Repeat password cannot be empty.");
      return false;
    }
    return true;
  }
</script>