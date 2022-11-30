<div class="container">
  <h1 class="py-2">All job descriptions</h2>
  <p>This page lists all JDs.</p>
  <table class="table table-responsive-md table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">Company</th>
        <th scope="col">Title</th>
        <th scope="col">Minimum experience</th>
        <th scope="col">View</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($allJDs as $jd) {
        echo '<tr>
          <td>' . $jd['company_name'] . '</td>
          <td>' . $jd['title'] . '</td>
          <td>' . $jd['exp_year'] . '</td>
          <td><a href="recruit/view/' . $jd['id'] . '"><u>View</u></a></td>
        </tr>';
      }
      ?>
    </tbody>
  </table>
  <a href="/recruit/create" class="btn btn-primary m-1">Create Post</a>
</div>