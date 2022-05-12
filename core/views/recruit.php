<div class="container">
    <h1 class="py-2">Recruit</h2>
        <p>This is where employer can recruit people</p>
        <h2>Enter your requirements</h2>
        <form class="form-horizontal" action="./models/RecruitController.php">
            <label class="control-label col-sm-2">Job title/position</label></br>
            <input type="text" class="form-control" placeholder="Engineer, Tester..."></br>

            <label class="control-label col-sm-2">Years of experience</label></br>
            <input type="text" class="form-control" placeholder="From">
            <input type="text" class="form-control" placeholder="To"></br>

            <label class="control-label col-sm-2">Salary offered</label></br>
            <input type="text" class="form-control" placeholder="Salary"></br>

            <label>Describe the job in detail</label>
            <div class="form-group">
                <textarea id="editor"></textarea>
            </div></br>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form class="form-horizontal">
</div>