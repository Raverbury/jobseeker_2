<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.tiny.cloud/1/g71eys72jwsqlq94poocl0kmxrk6aukoj5cwnllluhsgyat9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#editor',
    readonly: 1
  }).then(() => {
    setTimeout(400)
    tinymce.get("editor").setContent(document.getElementById("job_des").value);
  });
</script>

<div class="container">
  <h1 class="py-2">Job post</h2>
    <form class="form-horizontal">
      <label class="control-label col-sm-2">Company's name</label></br>
      <input type="text" class="form-control" name="company_name" id="company_name" value=<?php
                                                                                          echo $jd['company_name'];
                                                                                          ?> readonly></br>

      <label class="control-label col-sm-2">Job title/position</label></br>
      <input type="text" class="form-control" placeholder="Engineer, Tester..." name="title" id="title" value=<?php
                                                                                                              echo $jd['title']
                                                                                                              ?> readonly></br>

      <label class="control-label col-sm-2">Years of experience</label></br>
      <input type="text" class="form-control" placeholder="Years of experience" name="exp_year" id="exp_year" value=<?php
                                                                                                                    echo $jd['exp_year']
                                                                                                                    ?> readonly></br>

      <label class="control-label col-sm-2">Salary offered</label></br>
      <input type="text" class="form-control" placeholder="Salary" name="salary" id="salary" value=<?php
                                                                                                    echo $jd['salary']
                                                                                                    ?> readonly></br>

      <label>Job description</label>
      <div class="form-group">
        <textarea id="editor"></textarea>
      </div></br>

      <input type="text" class="form-control" name="job_des" id='job_des' hidden="true" value=<?php
                                                                                              echo $jd['job_description']
                                                                                              ?>></br>
    </form class="form-horizontal">

    <?php if ($_SESSION['isLoggedIn'] && $_SESSION['role'] == 'candidate') {
      echo '
    <!-- Button trigger modal -->
    <a href="recruit/apply/' . $jd['id'] . '" class="btn btn-primary">
      Apply for this position
    </a>';
    } ?>
</div>