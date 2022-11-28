<link rel="stylesheet" href="./Template/style.css">
<div>
  <div class="border resume-wrapper">
    <form name="cvForm" class="bg-light p-2" action="cv/create" method="post">
      

      <section class="profile section-padding">
        <div class="container">
          <div class="picture-resume-wrapper">
            <div class="picture-resume">

              <div class="name-wrapper">
                <h1><input name="name" style="height:50px;font-size:14pt;" type="text" value="THIEN HUYNH"></h1> <!-- YOUR NAME AND LAST NAME  -->
              </div>
              <div class="clearfix"></div>
              <div class="contact-info clearfix">
                <ul class="list-titles">
                  <li>Phone</li>
                  <li>Mail</li>
                  <li>Website</li>
                  <li>Address</li>
                </ul>
                <ul class="list-content ">
                  <li><input name="phone" type="text" value="+123-45-678"></li> <!-- YOUR PHONE NUMBER  -->
                  <li><input name="mail" type="text" value="abc@gmail.com"></li> <!-- YOUR EMAIL -->
                  <li><input name="web" type="text" value="abcd.com"></li> <!-- YOUR WEBSITE  -->
                  <li><input name="place" type="text" value="Washington DC, US"></li> <!-- YOUR STATE AND COUNTRY  -->
                </ul>
              </div>
              <div class="description">
                <ul class="description-type">
                  <li>About Me</li>

                </ul>
              </div>
              <div class="contact-presentation">
                <!-- YOUR PRESENTATION RESUME  -->
                <textarea name="about" cols="50" rows="10"></textarea>
              </div>

            </div>
      </section>

      <section class="experience section-padding">
        <div class="container">
          <h3 class="experience-title">Experience</h3>

          <div class="experience-wrapper">
            <div class="company-wrapper clearfix">
              <div class="experience-title"><input name="company1" type="text" value="Company Name"></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
              <div class="time"><input name="period1" type="text" value="Nov 2021 - Present"></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
            </div>

            <div class="job-wrapper clearfix">
              <div class="experience-title"><input name="role1" type="text" value="Front End Developer"></div> <!-- JOB TITLE  -->
              <div class="company-description">
                <textarea name="companydes1" cols="40" rows="5" value="Company Description"></textarea>
              </div>
            </div>

            <div class="company-wrapper clearfix">
              <div class="experience-title"><input name="company2" type="text" value="Company Name"></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
              <div class="time"><input name="period2" type="text" value="Nov 2021 - Present"></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
            </div>

            <div class="job-wrapper clearfix">
              <div class="experience-title"><input name="role2" type="text" value="Front End Developer"></div> <!-- JOB TITLE  -->
              <div class="company-description">
                <textarea name="companydes2" cols="40" rows="5" value="Company Description"></textarea>
              </div>
            </div>

            <div class="company-wrapper clearfix">
              <div class="experience-title"><input name="company3" type="text" value="Company Name"></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
              <div class="time"><input name="period3" type="text" value="Nov 2021 - Present"></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
            </div>

            <div class="job-wrapper clearfix">
              <div class="experience-title"><input input name="role3" type="text" value="Front End Developer"></div> <!-- JOB TITLE  -->
              <div class="company-description">
                <textarea name="companydes3" cols="40" rows="5" value="Company Description"></textarea>
              </div>
            </div>

          </div>
          <!--Skill experience-->

          <div class="section-wrapper clearfix">
            <h3 class="section-title">Skills</h3> <!-- YOUR SET OF SKILLS  -->
            <ul>
              <li><input name="skill1" type="text" value="HTML"></li>
              <input name="slide1" type="range">
              <li><input name="skill2" type="text" value="CSS"></li>
              <input name="slide2" type="range">
              <li><input name="skill3" type="text" value="PYTHON"></li>
              <input name="slide3" type="range">
              <li><input name="skill4" type="text" value="JAVASCRIPT"></li>
              <input name="slide4" type="range">
              <li><input name="skill5" type="text" value="REACT"></li>
              <input name="slide5" type="range">
              <li><input name="skill6" type="text" value="NODEJS"></li>
              <input name="slide6" type="range">

            </ul>

          </div>

          <div class="section-wrapper clearfix">
            <h3 class="section-title">Hobbies</h3> <!-- DESCRIPTION OF YOUR HOBBIES -->
            <textarea name="hobbies" cols="40" rows="10" value="Description of your hobbies"></textarea>
          </div>

        </div>
      </section>

      <div class="clearfix"></div>
      <br>
      <input class="btn btn-primary m-1" type="submit">
    </form>
  </div>

</div>