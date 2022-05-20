<div class="container">
    <h1 class="py-2">Recruit</h2>
        <p>This is where employer can recruit people</p>
        <h2>Enter your requirements</h2>
        <form class="form-horizontal" action="create" method="post">
            <label class="control-label col-sm-2">Your company name</label></br>
            <input type="text" class="form-control" id="companyname"></br>

            <label class="control-label col-sm-2">Job title/position</label></br>
            <input type="text" class="form-control" placeholder="Engineer, Tester..." id="title"></br>

            <label class="control-label col-sm-2">Years of experience</label></br>
            <input type="text" class="form-control" placeholder="From" id="expyear">

            <label class="control-label col-sm-2">Salary offered</label></br>
            <input type="text" class="form-control" placeholder="Salary" id='salary'></br>

            <label>Benefits included</label>
            <div class="form-group" id="benefits">
                <textarea id="editor"></textarea>
            </div></br>

            <label>Describe the job in detail</label>
            <div class="form-group" id="jobdes">
                <textarea id="editor" name="jobdes"></textarea>
            </div></br>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form class="form-horizontal">
</div>