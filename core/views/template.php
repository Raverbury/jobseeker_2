<div class="resume-wrapper">
  <section class="profile section-padding">
    <div class="container">
      <div class="picture-resume-wrapper">
        <div class="picture-resume">
          <label>
            <img src="./Template/IMAGE.png" />
          </label>
          <svg version="1.1" viewBox="0 0 350 350">

            <defs>
              <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="8" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -9" result="cm" />
              </filter>
            </defs>


          </svg>
        </div>

        <div class="clearfix"></div>

      </div>

      <div class="name-wrapper">
        <h1><input style="height:50px;font-size:14pt;" type="text" placeholder="THIEN HUYNH"></h1> <!-- YOUR NAME AND LAST NAME  -->
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
          <li><input type="text" placeholder="+123-45-678"></li> <!-- YOUR PHONE NUMBER  -->
          <li><input type="text" placeholder="abc@gmail.com"></li> <!-- YOUR EMAIL -->
          <li><input type="text" placeholder="abcd.com"></li> <!-- YOUR WEBSITE  -->
          <li><input type="text" placeholder="Washington DC, US"></li> <!-- YOUR STATE AND COUNTRY  -->
        </ul>
      </div>
      <div class="description">
        <ul class="description-type">
          <li>About Me</li>

        </ul>
      </div>
      <div class="contact-presentation">
        <!-- YOUR PRESENTATION RESUME  -->
        <textarea name="paragraph_text" cols="50" rows="10"></textarea>
      </div>

    </div>
  </section>

  <section class="experience section-padding">
    <div class="container">
      <h3 class="experience-title">Experience</h3>

      <div class="experience-wrapper">
        <div class="company-wrapper clearfix">
          <div class="experience-title"><input type="text" placeholder="Company Name"></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input type="text" placeholder="Nov 2021 - Present"></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
        </div>

        <div class="job-wrapper clearfix">
          <div class="experience-title"><input type="text" placeholder="Front End Developer"></div> <!-- JOB TITLE  -->
          <div class="company-description">
            <textarea name="paragraph_text" cols="50" rows="5" placeholder="Company Description"></textarea>
          </div>
        </div>

        <div class="company-wrapper clearfix">
          <div class="experience-title"><input type="text" placeholder="Company Name"></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input type="text" placeholder="Nov 2021 - Present"></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
        </div>

        <div class="job-wrapper clearfix">
          <div class="experience-title"><input type="text" placeholder="Front End Developer"></div> <!-- JOB TITLE  -->
          <div class="company-description">
            <textarea name="paragraph_text" cols="50" rows="5" placeholder="Company Description"></textarea>
          </div>
        </div>

        <div class="company-wrapper clearfix">
          <div class="experience-title"><input type="text" placeholder="Company Name"></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input type="text" placeholder="Nov 2021 - Present"></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
        </div>

        <div class="job-wrapper clearfix">
          <div class="experience-title"><input type="text" placeholder="Front End Developer"></div> <!-- JOB TITLE  -->
          <div class="company-description">
            <textarea name="paragraph_text" cols="50" rows="5" placeholder="Company Description"></textarea>
          </div>
        </div>

      </div>
      <!--Skill experience-->

      <div class="section-wrapper clearfix">
        <h3 class="section-title">Skills</h3> <!-- YOUR SET OF SKILLS  -->
        <ul>
          <li><input type="text" placeholder="HTML"></li>
          <input type="range">
          <li><input type="text" placeholder="CSS"></li>
          <input type="range">
          <li><input type="text" placeholder="PYTHON"></li>
          <input type="range">
          <li><input type="text" placeholder="JAVASCRIPT"></li>
          <input type="range">
          <li><input type="text" placeholder="REACT"></li>
          <input type="range">
          <li><input type="text" placeholder="NODEJS"></li>
          <input type="range">

        </ul>

      </div>

      <div class="section-wrapper clearfix">
        <h3 class="section-title">Hobbies</h3> <!-- DESCRIPTION OF YOUR HOBBIES -->
        <textarea name="paragraph_text" cols="50" rows="10" placeholder="Description of your hobbies"></textarea>
      </div>

    </div>
  </section>

  <div class="clearfix"></div>
</div>
<!-- partial -->
<script src='//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js'></script>
<script src="./Template/script.js"></script>