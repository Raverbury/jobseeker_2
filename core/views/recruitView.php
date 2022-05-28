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

        </form class="form-horizontal">

</div>
<script>
    tinymce.init({
        selector: "editor",
        setup: function(editor) {
            editor.on('init', function(e) {
                //this gets executed AFTER TinyMCE is fully initialized
                editor.setContent('<p>This is content set via the init function</p>');
            });
        }
    });
</script>