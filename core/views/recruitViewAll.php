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
      for ($i = 0; $i < count($this->result['data'][0]); $i++) {
        echo '<tr>
          <td>' . $this->result['data'][2][$i] . '</td>
          <td>' . $this->result['data'][3][$i] . '</td>
          <td>' . $this->result['data'][4][$i] . ' year(s)</td>
          <td><a href="recruit/view/' . $this->result['data'][0][$i] . '"><u>View</u></a></td>
        </tr>';
      }
      ?>
    </tbody>
  </table>
  <a href="/recruit/create" class="btn btn-primary m-1">Create Post</a>
</div>