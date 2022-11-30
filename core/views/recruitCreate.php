<div class="container">
  <h1 class="py-2">Recruit</h2>
    <p>This is where employer can recruit people.</p>
    <h2>Enter your requirements</h2>
    <form class="form-horizontal" action="recruit/create" method="post" onsubmit=transfer()>
      <label class="control-label col-sm-2">Your company's name</label></br>
      <input type="text" class="form-control" name="company_name" id="company_name"></br>

      <label class="control-label col-sm-2">Job title/position</label></br>
      <input type="text" class="form-control" placeholder="Engineer, tester..." name="title" id="title"></br>

      <label class="control-label col-sm-2">Years of experience</label></br>
      <input type="text" class="form-control" placeholder="Years of experience" name="exp_year" id="exp_year"></br>

      <label class="control-label col-sm-2">Salary offered</label></br>
      <input type="text" class="form-control" placeholder="Salary" name="salary" id='salary'></br>


      <label>Describe the job and benefits in details</label>
      <div class="form-group">
        <textarea id="editor"></textarea>
      </div></br>

      <input type="text" class="form-control" name="job_des" id='job_des' hidden="true"></br>


      <button type="submit" class="btn btn-primary">Submit</button>
    </form class="form-horizontal">

</div>
<script>
  function transfer() {
    document.getElementById("job_des").value = tinymce.get('editor').getContent();
    return true;
  }
</script>