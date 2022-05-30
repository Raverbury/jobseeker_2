<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.tiny.cloud/1/g71eys72jwsqlq94poocl0kmxrk6aukoj5cwnllluhsgyat9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        readonly: 1
    }).then(() => {
        setTimeout(400)
        tinymce.get("editor").setContent(document.getElementById("jobdes").value);
    });
</script>

<div class="container">
    <h1 class="py-2">Your post</h2>
        <form class="form-horizontal">
            <label class="control-label col-sm-2">Your company name</label></br>
            <input type="text" class="form-control" name="companyname" id="companyname" value=<?php
                                                                                                echo $this->result['data']['companyname']
                                                                                                ?> readonly></br>

            <label class="control-label col-sm-2">Job title/position</label></br>
            <input type="text" class="form-control" placeholder="Engineer, Tester..." name="title" id="title" value=<?php
                                                                                                                    echo $this->result['data']['title']
                                                                                                                    ?> readonly></br>

            <label class="control-label col-sm-2">Years of experience</label></br>
            <input type="text" class="form-control" placeholder="Years of experience" name="expyear" id="expyear" value=<?php
                                                                                                                        echo $this->result['data']['expyear']
                                                                                                                        ?> readonly></br>

            <label class="control-label col-sm-2">Salary offered</label></br>
            <input type="text" class="form-control" placeholder="Salary" name="salary" id='salary' value=<?php
                                                                                                            echo $this->result['data']['salary']
                                                                                                            ?> readonly></br>

            <label>Job description</label>
            <div class="form-group">
                <textarea id="editor"></textarea>
            </div></br>

            <input type="text" class="form-control" name="jobdes" id='jobdes' hidden="true" value=<?php
                                                                                                    echo $this->result['data']['jobdes']
                                                                                                    ?>></br>
        </form class="form-horizontal">
</div>