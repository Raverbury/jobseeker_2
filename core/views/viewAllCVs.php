<div class="container">
  <h1 class="py-2">View all CVs</h1>
  <p>This page lists all CVs.</p>
  <!-- <div class="input-group">
    <input id="myInput" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
    <button type="button" class="btn btn-outline-primary">Search</button>
  </div> -->
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
      // for ($i = 0; $i < count($IDs); $i++) {
      foreach ($allCvs as $cv) {
        echo '<tr>
          <td>' . $cv['name'] . '</td>
          <td>' . $cv['username'] . '</td>
          <td><a href="cv/view/' . $cv['id'] . '"><u>View</u></a></td>
          <td><a href="cv/edit/' . $cv['id'] . '"><u>Edit</u></a></td>
        </tr>';
      }
      ?>
    </tbody>
  </table>
  <a class="btn btn-primary m-1" href="cv/create">Create your CV</a>
</div>