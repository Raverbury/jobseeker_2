<div class="container">
  <h1 class="py-2">Apply for a job</h1>
  <p>This page allows you to apply one of your CVs to this JD.</p>
  <table class="table table-responsive-md table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">CV</th>
        <th scope="col">Apply</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($cvs as $cv) {
        echo '<tr>
          <td>' . $cv['name'] . '</td>';
        if ($cv['id'] == $applied) {
          echo '<td><button class="btn btn-danger" onclick="apply(\'delete\')">Withdraw</button></td>
        </tr>';
        } else {
          echo '<td><button class="btn btn-primary" onclick="apply(' . $cv['id'] . ')" ' . $cv['id'] . '">Apply</button></td>
        </tr>';
        }
      }
      ?>
    </tbody>
  </table>
</div>

<script>
  function apply(cvId) {
    let form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', 'recruit/apply/<?php echo $jdId; ?>');

    const uid = document.createElement("input");
    uid.setAttribute('type', "text");
    uid.setAttribute('name', "uid");
    uid.value = '<?php echo $_SESSION['id']; ?>'

    const cvid = document.createElement("input");
    cvid.setAttribute('type', "text");
    cvid.setAttribute('name', "cvId");
    cvid.value = cvId;

    const jdid = document.createElement("input");
    jdid.setAttribute('type', "text");
    jdid.setAttribute('name', "jdId");
    jdid.value = <?php echo $jdId; ?>;

    const s = document.createElement("input");
    s.setAttribute('type', "submit");
    s.setAttribute('value', "Submit");

    form.appendChild(uid);
    form.appendChild(cvid);
    form.appendChild(jdid);
    form.appendChild(s);

    document.body.appendChild(form);

    form.submit();
  }
</script>