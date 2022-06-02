<div class="container">
  <h1 class="py-2">View all CVs</h1>
  <p>This page lists all CVs.</p>
  <table class="table table-responsive-md table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">CV</th>
        <th scope="col">Owner</th>
        <th scope="col">View</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      for ($i = 0; $i < count($IDs); $i++) {
        echo '<tr>
          <td>' . $names[$i] . '</td>
          <td>' . $owners[$i] . '</td>
          <td><a href="cv/view/' . $IDs[$i] . '"><u>View</u></a></td>
          <td><a href="cv/edit/' . $IDs[$i] . '"><u>Edit</u></a></td>
        </tr>';
      }
      ?>
    </tbody>
  </table>
  <a class="btn btn-primary m-1" href="cv/create">Create your CV</a>
</div>